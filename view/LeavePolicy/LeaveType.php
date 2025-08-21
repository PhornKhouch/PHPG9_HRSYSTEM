<?php
include("../../Config/conect.php");
?>

    <table id="LeaveTypeTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="width: 150px"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLeaveTypeModal">Add</button></th>
                <th>Leave Code</th>
                <th>Leave Type </th>
                <th>Is Probation</th>
                <th>Is Deduction</th>
                <th>Is OverBalance</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php
                $sql = "SELECT * FROM lmleavetype";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                    <tr data-id="<?php echo $row['Code']; ?>">
                        <td>
                            <button class="btn btn-primary btn-sm edit-leave-type-btn" 
                                    data-code="<?php echo $row['Code']; ?>"
                                    data-name="<?php echo $row['LeaveType']; ?>"
                                    data-is-deduction="<?php echo $row['IsDeduct']; ?>"
                                    data-is-overbalance="<?php echo $row['IsOverBalance']; ?>"
                                    data-is-probation="<?php echo $row['IsProbation']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm delete-leave-type-btn" data-code="<?php echo $row['Code']; ?>">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                        <td><?php echo $row['Code']; ?></td>
                        <td><?php echo $row['LeaveType']; ?></td>
                        <td>
                            <center>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" <?php echo $row['IsProbation'] == 1 ? 'checked' : ''; ?> disabled>
                                </div>
                            </center>
                        </td>
                        <td>
                            <center>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" <?php echo $row['IsDeduct'] == 1 ? 'checked' : ''; ?> disabled>
                                </div>
                            </center>
                        </td>
                        <td>
                            <center>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" <?php echo $row['IsOverBalance'] == 1 ? 'checked' : ''; ?> disabled>
                                </div>
                            </center>
                        </td>
                    </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>

<!-- Add Modal -->
<div class="modal fade" id="addLeaveTypeModal" tabindex="-1" aria-labelledby="addLeaveTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Add New Leave Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLeaveTypeForm">
                    <div class="mb-3">
                        <label for="code" class="form-label">Leave Code</label>
                        <input type="text" class="form-control" id="LeaveCode" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Leave Type</label>
                        <input type="text" class="form-control" id="LeaveType" required>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsProbation">
                            <label class="form-check-label" for="IsProbation">Is Probation</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsDeduction">
                            <label class="form-check-label" for="IsDeduction">Is Deduction</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsOverBalance">
                            <label class="form-check-label" for="IsOverBalance">Is OverBalance</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveLeaveType">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editLeaveTypeModal" tabindex="-1" aria-labelledby="editLeaveTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLeaveTypeModalLabel">Edit Leave Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editLeaveTypeForm">
                    <input type="hidden" id="edit_leave_code">
                    <div class="mb-3">
                        <label for="edit_leave_type" class="form-label">Leave Type</label>
                        <input type="text" class="form-control" id="edit_leave_type" required>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="edit_is_probation">
                            <label class="form-check-label" for="edit_is_probation">Is Probation</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="edit_is_deduction">
                            <label class="form-check-label" for="edit_is_deduction">Is Deduction</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="edit_is_over_balance">
                            <label class="form-check-label" for="edit_is_over_balance">Is OverBalance</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateLeaveType">Update</button>
            </div>
        </div>
    </div>
</div>
<?php
    include '../../root/DataTable.php';
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable only if not already initialized
        let leavetypeTable;
        if (!$.fn.DataTable.isDataTable('#LeaveTypeTable')) {
            leavetypeTable = $('#LeaveTypeTable').DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false
            });
        } else {
            leavetypeTable = $('#LeaveTypeTable').DataTable();
        }

        // Add new leave type
        $('#saveLeaveType').click(function() {
            if (!$('#addLeaveTypeForm')[0].checkValidity()) {
                $('#addLeaveTypeForm')[0].reportValidity();
                return;
            }

            var isded = $('#IsDeduction').is(':checked');//0 ,1
            var isOverBalance = $('#IsOverBalance').is(':checked');
            var isProbation = $('#IsProbation').is(':checked');
            // Convert boolean to 'on'/'off' string for PHP
            isded = isded ? 'on' : 'off';
            isOverBalance = isOverBalance ? 'on' : 'off';
            isProbation = isProbation ? 'on' : 'off';

            $.ajax({
                url: "../../action/LeavePolicy/create.php",
                type: "POST",
                data: {
                    type: "LeaveType",
                    code: $('#LeaveCode').val(),
                    leaveType: $('#LeaveType').val(),
                    isded: isded,
                    isOverBalance: isOverBalance,
                    isProbation: isProbation
                },
                success: function(response) {
                    // Add new row to DataTable with numeric values for checkboxes
                    leavetypeTable.row.add([
                        `<button class="btn btn-primary btn-sm edit-leave-type-btn" 
                            data-code="${$('#LeaveCode').val()}" 
                            data-name="${$('#LeaveType').val()}"
                            data-is-deduction="${isded === 'on' ? 1 : 0}"
                            data-is-overbalance="${isOverBalance === 'on' ? 1 : 0}"
                            data-is-probation="${isProbation === 'on' ? 1 : 0}">
                            <i class="fas fa-edit"></i> Edit
                         </button>
                         <button class="btn btn-danger btn-sm delete-leave-type-btn" data-code="${$('#LeaveCode').val()}">
                            <i class="fas fa-trash"></i> Delete
                         </button>`,
                        $('#LeaveCode').val(),
                        $('#LeaveType').val(),
                        `<center>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" ${isProbation === 'on' ? 'checked' : ''} disabled>
                            </div>
                        </center>`,
                        `<center>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" ${isded === 'on' ? 'checked' : ''} disabled>
                            </div>
                        </center>`,
                        `<center>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" ${isOverBalance === 'on' ? 'checked' : ''} disabled>
                            </div>
                        </center>`
                    ]).draw(false);

                    // Hide modal and clean up
                    $('#addLeaveTypeModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    
                    // Clear form
                    $('#LeaveCode').val('');
                    $('#LeaveType').val('');
                    $('#IsProbation').prop('checked', false);
                    $('#IsDeduction').prop('checked', false);
                    $('#IsOverBalance').prop('checked', false);

                    showToast('success', response);
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error adding leave type');
                }
            });
        });

        // Edit button click handler
        $(document).on('click', '.edit-leave-type-btn', function() {
            const code = $(this).data('code');
            const name = $(this).data('name');
            const isDeduction = parseInt($(this).data('is-deduction'));
            const isOverBalance = parseInt($(this).data('is-overbalance'));
            const isProbation = parseInt($(this).data('is-probation'));

            $('#edit_leave_code').val(code);
            $('#edit_leave_type').val(name);
            $('#edit_is_probation').prop('checked', isProbation === 1);
            $('#edit_is_deduction').prop('checked', isDeduction === 1);
            $('#edit_is_over_balance').prop('checked', isOverBalance === 1);

            $('#editLeaveTypeModal').modal('show');
        });

        // Update leave type
        $('#updateLeaveType').click(function() {
            if (!$('#editLeaveTypeForm')[0].checkValidity()) {
                $('#editLeaveTypeForm')[0].reportValidity();
                return;
            }

            const code = $('#edit_leave_code').val();
            const leaveType = $('#edit_leave_type').val();
            
            // Convert checkbox states to 'on'/'off' for PHP processing
            const isProbation = $('#edit_is_probation').is(':checked') ? 'on' : 'off';
            const isDeduction = $('#edit_is_deduction').is(':checked') ? 'on' : 'off';
            const isOverBalance = $('#edit_is_over_balance').is(':checked') ? 'on' : 'off';

            $.ajax({
                url: "../../action/LeavePolicy/update.php",
                type: "POST",
                data: {
                    type: "LeaveType",
                    code: code,
                    leaveType: leaveType,
                    isded: isDeduction,
                    isOverBalance: isOverBalance,
                    isProbation: isProbation
                },
                success: function(response) {
                    // Convert 'on'/'off' to 1/0 for UI display
                    const isProbationNum = isProbation === 'on' ? 1 : 0;
                    const isDeductionNum = isDeduction === 'on' ? 1 : 0;
                    const isOverBalanceNum = isOverBalance === 'on' ? 1 : 0;

                    const row = leavetypeTable.row($(`tr[data-id="${code}"]`));
                    const rowData = row.data();
                    rowData[0] = `<button class="btn btn-primary btn-sm edit-leave-type-btn" 
                                    data-code="${code}" 
                                    data-name="${leaveType}"
                                    data-is-deduction="${isDeductionNum}"
                                    data-is-overbalance="${isOverBalanceNum}"
                                    data-is-probation="${isProbationNum}">
                                    <i class="fas fa-edit"></i> Edit
                                 </button>
                                 <button class="btn btn-danger btn-sm delete-leave-type-btn" data-code="${code}">
                                    <i class="fas fa-trash"></i> Delete
                                 </button>`;
                    rowData[2] = leaveType;
                    rowData[3] = `<center>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" ${isProbationNum === 1 ? 'checked' : ''} disabled>
                                    </div>
                                </center>`;
                    rowData[4] = `<center>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" ${isDeductionNum === 1 ? 'checked' : ''} disabled>
                                    </div>
                                </center>`;
                    rowData[5] = `<center>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" ${isOverBalanceNum === 1 ? 'checked' : ''} disabled>
                                    </div>
                                </center>`;
                    row.data(rowData).draw(false);

                    // Hide modal and clean up
                    $('#editLeaveTypeModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    showToast('success', 'Leave type updated successfully');
                },
                error: function(xhr) {
                    showToast('error', xhr.responseText || 'Error updating leave type');
                }
            });
        });

        // Delete button click handler
        $(document).on('click', '.delete-leave-type-btn', function() {
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
                        url: "../../action/LeavePolicy/delete.php",
                        type: "POST",
                        data: {
                            type: "LeaveType",
                            code: code
                        },
                        success: function(response) {
                            try {
                                const jsonResponse = JSON.parse(response);
                                if (jsonResponse.status === 'success') {
                                    leavetypeTable.row(row).remove().draw(false);
                                    showToast('success', jsonResponse.message || 'Leave type deleted successfully');
                                } else {
                                    showToast('error', jsonResponse.message || 'Error deleting leave type');
                                }
                            } catch (e) {
                                // If response is not JSON, treat it as plain text
                                if (response.toLowerCase().includes('success')) {
                                    leavetypeTable.row(row).remove().draw(false);
                                    showToast('success', 'Leave type deleted successfully');
                                } else {
                                    showToast('error', response || 'Error deleting leave type');
                                }
                            }
                        },
                        error: function(xhr) {
                            showToast('error', xhr.responseText || 'Error deleting leave type');
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

.form-switch-custom {
    padding: 0.5rem 0;
}

.form-switch-custom .form-check.form-switch {
    padding-left: 2.5em;
    margin: 0;
}

.form-switch-custom .form-check-input {
    width: 2.5em;
    height: 1.25em;
    margin-left: -2.5em;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
    background-position: left center;
    border-radius: 2em;
    transition: background-position .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.form-switch-custom .form-check-input:checked {
    background-position: right center;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-switch-custom .form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    border-color: #86b7fe;
}

.form-switch-custom .form-check-label {
    cursor: pointer;
    padding-left: 0.5rem;
    user-select: none;
}
</style>