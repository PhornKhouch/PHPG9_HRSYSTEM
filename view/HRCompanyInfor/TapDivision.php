<?php
include("../../Config/conect.php");
?>


    <table id="divisionTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="width: 150px"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDivisionModal">Add</button></th>
                <th>Division Code</th>
                <th>Division Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php
            $sql = "SELECT * FROM hrdivision";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr data-id="<?php echo $row['Code']; ?>">
                        <td>
                            <button class="btn btn-primary btn-sm edit-division-btn" 
                                    data-code="<?php echo $row['Code']; ?>"
                                    data-name="<?php echo $row['Description']; ?>"
                                    data-status="<?php echo $row['Status']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm delete-division-btn" data-code="<?php echo $row['Code']; ?>">
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
<div class="modal fade" id="addDivisionModal" tabindex="-1" aria-labelledby="addDivisionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDivisionModalLabel">Add New Division</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDivisionForm">
                    <div class="mb-3">
                        <label for="code" class="form-label">Division Code</label>
                        <input type="text" class="form-control" id="DivisionCode" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Division Name</label>
                        <input type="text" class="form-control" id="DivisionName" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="DivisionStatus" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveDivision">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editDivisionModal" tabindex="-1" aria-labelledby="editDivisionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDivisionModalLabel">Edit Division</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDivisionForm">
                    <input type="hidden" id="edit_division_code">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Division Name</label>
                        <input type="text" class="form-control" id="edit_division_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_division_status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateDivision">Update</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        const table = $('#divisionTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false
        });

        // Add new department
        $('#saveDivision').click(function() {
            if (!$('#addDivisionForm')[0].checkValidity()) {
                $('#addDivisionForm')[0].reportValidity();
                return;
            }

            $.ajax({
                url: "../../action/CompanyInfor/create.php",
                type: "POST",
                data: {
                    type: "Division",
                    code: $('#DivisionCode').val(),
                    name: $('#DivisionName').val(),
                    status: $('#DivisionStatus').val()
                },
                success: function(response) {
                    if (response != null) {
                            table.row.add([
                            `<button class="btn btn-primary btn-sm edit-division-btn" data-code="${$('#DivisionCode').val()}" data-name="${$('#DivisionName').val()}" data-status="${$('#DivisionStatus').val()}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm delete-division-btn" data-code="${$('#DivisionCode').val()}">
                                <i class="fas fa-trash"></i> Delete
                            </button>`,
                            $('#DivisionCode').val(),
                            $('#DivisionName').val(),
                            $('#DivisionStatus').val()
                        ]).draw(false);

                        // Hide modal and clean up
                        const modal = bootstrap.Modal.getInstance($('#addDivisionModal'));
                        modal.hide();
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        
                        // Clear form
                        $('#DivisionCode').val('');
                        $('#DivisionName').val('');
                        $('#DivisionStatus').val('Active');

                        showToast('success', response);
                    }
                    else{
                        showToast('danger', response); 
                    }
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error adding division');
                }
            });
        });

        // Edit button click handler
        $(document).on('click', '.edit-division-btn', function() {
            const code = $(this).data('code');
            const name = $(this).data('name');
            const status = $(this).data('status');

            $('#edit_division_code').val(code);
            $('#edit_division_name').val(name);
            $('#edit_division_status').val(status);

            $('#editDivisionModal').modal('show');
        });

        // Update company
        $('#updateDivision').click(function() {
            if (!$('#editDivisionForm')[0].checkValidity()) {
                $('#editDivisionForm')[0].reportValidity();
                return;
            }

            const code = $('#edit_division_code').val();
            const name = $('#edit_division_name').val();
            const status = $('#edit_division_status').val();

            $.ajax({
                url: "../../action/CompanyInfor/update.php",
                type: "POST",
                data: {
                    "type": "Division",
                    "code": code,
                    "name": name,
                    "status": status
                },
                success: function(response) {
                    const row = table.row($(`tr[data-id="${code}"]`));
                    const rowData = row.data();
                    rowData[0] = `<button class="btn btn-primary btn-sm edit-btn" data-code="${code}" data-name="${name}" data-status="${status}">
                                    <i class="fas fa-edit"></i> Edit
                                 </button>
                                 <button class="btn btn-danger btn-sm delete-btn" data-code="${code}">
                                    <i class="fas fa-trash"></i> Delete
                                 </button>`;
                    rowData[2] = name;
                    rowData[3] = status;
                    row.data(rowData).draw(false);

                    $('#editDivisionModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    showToast('success', response);
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error updating Division');

                }
            });
        });

        // Delete button click handler
        $(document).on('click', '.delete-division-btn', function() {
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
                        url: "../../action/CompanyInfor/delete.php",
                        type: "POST",
                        data: {
                            "type": "Division",
                            "code": code
                        },
                        success: function(response) {
                            table.row(row).remove().draw(false);
                            showToast('success', response);
                        },
                        error: function(xhr) {
                            showToast('error', xhr.responseText || 'Error deleting company');
                        }
                    });
                }
            });
        });

        // Helper function for showing toasts
        function showToast(icon, title) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
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
</style>