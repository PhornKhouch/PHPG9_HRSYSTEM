<?php
include("../../Config/conect.php");
?>

    <table id="PublicHolidayTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="width: 150px"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPublicHolidayModal">Add</button></th>
                <th>Holiday Name</th>
                <th>Description</th>
                <th>Holiday Date</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php
                $sql = "SELECT * FROM public_holidays";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td>
                            <button class="btn btn-primary btn-sm edit-holiday-btn" 
                                    data-id="<?php echo $row['id']; ?>"
                                    data-name="<?php echo $row['holiday_name']; ?>"
                                    data-date="<?php echo $row['holiday_date']; ?>"
                                    data-description="<?php echo $row['description']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm delete-holiday-btn" data-id="<?php echo $row['id']; ?>">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                        <td><?php echo $row['holiday_name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['holiday_date'])); ?></td>
                    </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>

<!-- Add Public Holiday Modal -->
<div class="modal fade" id="addPublicHolidayModal" tabindex="-1" aria-labelledby="addPublicHolidayModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPublicHolidayModalLabel">Add New Public Holiday</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPublicHolidayForm">
                    <div class="mb-3">
                        <label for="holiday_name" class="form-label">Holiday Name</label>
                        <input type="text" class="form-control" id="holiday_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="holiday_date" class="form-label">Holiday Date</label>
                        <input type="date" class="form-control" id="holiday_date" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePublicHoliday">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Public Holiday Modal -->
<div class="modal fade" id="editPublicHolidayModal" tabindex="-1" aria-labelledby="editPublicHolidayModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPublicHolidayModalLabel">Edit Public Holiday</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPublicHolidayForm">
                    <input type="hidden" id="edit_holiday_id">
                    <div class="mb-3">
                        <label for="edit_holiday_name" class="form-label">Holiday Name</label>
                        <input type="text" class="form-control" id="edit_holiday_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_holiday_date" class="form-label">Holiday Date</label>
                        <input type="date" class="form-control" id="edit_holiday_date" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updatePublicHoliday">Update</button>
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
        // Initialize DataTable
        let holidayTable;
        if (!$.fn.DataTable.isDataTable('#PublicHolidayTable')) {
            holidayTable = $('#PublicHolidayTable').DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false
            });
        } else {
            holidayTable = $('#PublicHolidayTable').DataTable();
        }

        // Add new holiday
        $('#savePublicHoliday').click(function() {
            if (!$('#addPublicHolidayForm')[0].checkValidity()) {
                $('#addPublicHolidayForm')[0].reportValidity();
                return;
            }

            $.ajax({
                url: "../../action/LeavePolicy/create.php",
                type: "POST",
                data: {
                    type: "PublicHoliday",
                    holiday_name: $('#holiday_name').val(),
                    description: $('#description').val(),
                    holiday_date: $('#holiday_date').val()
                },
                success: function(response) {
                    const newId = response.id || Date.now(); // Fallback to timestamp if no ID returned
                    
                    holidayTable.row.add([
                        `<button class="btn btn-primary btn-sm edit-holiday-btn" 
                            data-id="${newId}" 
                            data-name="${$('#holiday_name').val()}"
                            data-date="${$('#holiday_date').val()}"
                            data-description="${$('#description').val()}">
                            <i class="fas fa-edit"></i> Edit
                         </button>
                         <button class="btn btn-danger btn-sm delete-holiday-btn" data-id="${newId}">
                            <i class="fas fa-trash"></i> Delete
                         </button>`,
                        $('#holiday_name').val(),
                        $('#description').val(),
                        new Date($('#holiday_date').val()).toLocaleDateString('en-GB')
                    ]).draw(false);

                    // Hide modal and clean up
                    $('#addPublicHolidayModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    
                    // Clear form
                    $('#holiday_name').val('');
                    $('#description').val('');
                    $('#holiday_date').val('');

                    showToast('success', 'Public holiday added successfully');
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error adding public holiday');
                }
            });
        });

        // Edit button click handler
        $(document).on('click', '.edit-holiday-btn', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const date = $(this).data('date');
            const description = $(this).data('description');

            $('#edit_holiday_id').val(id);
            $('#edit_holiday_name').val(name);
            $('#edit_description').val(description);
            $('#edit_holiday_date').val(date);

            $('#editPublicHolidayModal').modal('show');
        });

        // Update holiday
        $('#updatePublicHoliday').click(function() {
            if (!$('#editPublicHolidayForm')[0].checkValidity()) {
                $('#editPublicHolidayForm')[0].reportValidity();
                return;
            }

            const id = $('#edit_holiday_id').val();
            const name = $('#edit_holiday_name').val();
            const description = $('#edit_description').val();
            const date = $('#edit_holiday_date').val();

            $.ajax({
                url: "../../action/LeavePolicy/update.php",
                type: "POST",
                data: {
                    type: "PublicHoliday",
                    id: id,
                    holiday_name: name,
                    description: description,
                    holiday_date: date
                },
                success: function(response) {
                    const row = holidayTable.row($(`tr[data-id="${id}"]`));
                    const rowData = [
                        `<button class="btn btn-primary btn-sm edit-holiday-btn" 
                            data-id="${id}" 
                            data-name="${name}"
                            data-date="${date}"
                            data-description="${description}">
                            <i class="fas fa-edit"></i> Edit
                         </button>
                         <button class="btn btn-danger btn-sm delete-holiday-btn" data-id="${id}">
                            <i class="fas fa-trash"></i> Delete
                         </button>`,
                        name,
                        description,
                        new Date(date).toLocaleDateString('en-GB')
                    ];
                    row.data(rowData).draw(false);

                    // Hide modal and clean up
                    $('#editPublicHolidayModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    showToast('success', 'Public holiday updated successfully');
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error updating public holiday');
                }
            });
        });

        // Delete button click handler
        $(document).on('click', '.delete-holiday-btn', function() {
            const row = $(this).closest('tr');
            const id = $(this).data('id');

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
                        url: "../../action/LeavePolicy/delete.php",
                        type: "POST",
                        data: {
                            type: "PublicHoliday",
                            id: id
                        },
                        success: function(response) {
                            try {
                                const jsonResponse = JSON.parse(response);
                                if (jsonResponse.status === 'success') {
                                    holidayTable.row(row).remove().draw(false);
                                    showToast('success', jsonResponse.message || 'Public holiday deleted successfully');
                                } else {
                                    showToast('error', jsonResponse.message || 'Error deleting public holiday');
                                }
                            } catch (e) {
                                // If response is not JSON, treat it as plain text
                                if (response.toLowerCase().includes('success')) {
                                    holidayTable.row(row).remove().draw(false);
                                    showToast('success', 'Public holiday deleted successfully');
                                } else {
                                    showToast('error', response || 'Error deleting public holiday');
                                }
                            }
                        },
                        error: function(xhr) {
                            showToast('error', xhr.responseText || 'Error deleting public holiday');
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