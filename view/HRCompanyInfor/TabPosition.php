<?php
include("../../Config/conect.php");
?>

    <table id="PositionTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="width: 150px"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPositionModal">Add</button></th>
                <th>Position Code</th>
                <th>Position Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php
            $sql = "SELECT * FROM hrposition";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr data-id="<?php echo $row['Code']; ?>">
                        <td>
                            <button class="btn btn-primary btn-sm edit-position-btn" 
                                    data-code="<?php echo $row['Code']; ?>"
                                    data-name="<?php echo $row['Description']; ?>"
                                    data-status="<?php echo $row['Status']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm delete-position-btn" data-code="<?php echo $row['Code']; ?>">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                        <td><?php echo $row['Code']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                        <td><?php echo $row['Status']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

<!-- Add Modal -->
<div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPositionModalLabel">Add New Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPositionForm">
                    <div class="mb-3">
                        <label for="code" class="form-label">Position Code</label>
                        <input type="text" class="form-control" id="PositionCode" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Position Name</label>
                        <input type="text" class="form-control" id="PositionName" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="PositionStatus" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePosition">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPositionModal" tabindex="-1" aria-labelledby="editPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPositionModalLabel">Edit Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPositionForm">
                    <input type="hidden" id="edit_position_code">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Position Name</label>
                        <input type="text" class="form-control" id="edit_position_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_position_status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updatePosition">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable only if not already initialized
        let positionTable;
        if (!$.fn.DataTable.isDataTable('#PositionTable')) {
            positionTable = $('#PositionTable').DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false
            });
        } else {
            positionTable = $('#PositionTable').DataTable();
        }

        // Add new level
        $('#savePosition').click(function() {
            if (!$('#addPositionForm')[0].checkValidity()) {
                $('#addPositionForm')[0].reportValidity();
                return;
            }

            $.ajax({
                url: "../../action/JobAnalysis/create.php",
                type: "POST",
                data: {
                    type: "Position",
                    code: $('#PositionCode').val(),
                    name: $('#PositionName').val(),
                    status: $('#PositionStatus').val()
                },
                success: function(response) {
                    // Add new row to DataTable
                    positionTable.row.add([
                        `<button class="btn btn-primary btn-sm edit-position-btn" 
                            data-code="${$('#PositionCode').val()}" 
                            data-name="${$('#PositionName').val()}"
                            data-status="${$('#PositionStatus').val()}">
                            <i class="fas fa-edit"></i> Edit
                         </button>
                         <button class="btn btn-danger btn-sm delete-position-btn" data-code="${$('#PositionCode').val()}">
                            <i class="fas fa-trash"></i> Delete
                         </button>`,
                        $('#PositionCode').val(),
                        $('#PositionName').val(),
                        $('#PositionStatus').val()
                    ]).draw(false);

                    // Hide modal and clean up
                    $('#addPositionModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    
                    // Clear form
                    $('#PositionCode').val('');
                    $('#PositionName').val('');
                    $('#PositionStatus').val('Active');

                    showToast('success', response);
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error adding position');
                }
            });
        });

        // Edit button click handler
        $(document).on('click', '.edit-position-btn', function() {
            const code = $(this).data('code');
            const name = $(this).data('name');
            const status = $(this).data('status');

            $('#edit_position_code').val(code);
            $('#edit_position_name').val(name);
            $('#edit_position_status').val(status);

            $('#editPositionModal').modal('show');
        });

        // Update level
        $('#updatePosition').click(function() {
            if (!$('#editPositionForm')[0].checkValidity()) {
                $('#editPositionForm')[0].reportValidity();
                return;
            }

            const code = $('#edit_position_code').val();
            const name = $('#edit_position_name').val();
            const status = $('#edit_position_status').val();

            $.ajax({
                url: "../../action/JobAnalysis/update.php",
                type: "POST",
                data: {
                    "type": "Position",
                    "code": code,
                    "name": name,
                    "status": status
                },
                success: function(response) {
                    const row = positionTable.row($(`tr[data-id="${code}"]`));
                    const rowData = row.data();
                    rowData[0] = `<button class="btn btn-primary btn-sm edit-position-btn" 
                                    data-code="${code}" 
                                    data-name="${name}"
                                    data-status="${status}">
                                    <i class="fas fa-edit"></i> Edit
                                 </button>
                                 <button class="btn btn-danger btn-sm delete-position-btn" data-code="${code}">
                                    <i class="fas fa-trash"></i> Delete
                                 </button>`;
                    rowData[2] = name;
                    rowData[3] = status;
                    row.data(rowData).draw(false);

                    // Hide modal and clean up
                    $('#editPositionModal').modal('hide');
                    setTimeout(() => {
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                    }, 100);

                    showToast('success', response);
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error updating position');
                }
            });
        });

        // Delete button click handler
        $(document).on('click', '.delete-position-btn', function() {
            const row = $(this).closest('tr');
            const code = $(this).data('code');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "../../action/JobAnalysis/delete.php",
                        type: "POST",
                        data: {
                            "type": "Position",
                            "code": code
                        },
                        success: function(response) {
                            positionTable.row(row).remove().draw(false);
                            showToast('success', response);
                        },
                        error: function(xhr) {
                            showToast('error', xhr.responseText || 'Error deleting position');
                        }
                    });
                }
            });
        });

        // Helper function for showing toasts
        function showToast(icon, title) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-right",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                willClose: () => {
                    $('.swal2-container').remove();
                },
                customClass: {
                    popup: 'colored-toast',
                    timerProgressBar: 'timer-progress'
                },
                iconColor: '#fff',
                background: icon === 'success' ? '#4CAF50' : icon === 'error' ? '#F44336' : '#2196F3'
            });
            Toast.fire({ icon, title });
        }
    });
</script>

<style>
.dataTables_wrapper .dataTables_length select {
    width: 60px;
}
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    margin-right: 0.25rem;
}
.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
.modal-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

.colored-toast {
    padding: 16px 24px !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    border-radius: 8px !important;
    font-size: 15px !important;
    font-weight: 500 !important;
    animation: slideInDown 0.3s ease-in-out !important;
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    min-width: 300px !important;
    max-width: 500px !important;
    margin: 0 auto !important;
}

.colored-toast .swal2-icon {
    margin: 0 12px 0 0 !important;
    width: 28px !important;
    height: 28px !important;
    flex-shrink: 0 !important;
}

.colored-toast .swal2-title {
    margin: 0 !important;
    padding: 0 !important;
    color: white !important;
    text-align: left !important;
    flex-grow: 1 !important;
}

.timer-progress {
    background: rgba(255,255,255,0.3) !important;
    height: 3px !important;
}

@keyframes slideInDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>