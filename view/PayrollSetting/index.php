<?php
    include("../../root/Header.php");
    include("../../Config/conect.php");
?>

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

<!-- Add SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">

<style>
/* Table Styling */
.table {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
}

.table thead th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    color: #495057;
    font-weight: 600;
    padding: 12px;
    text-align: left;
    white-space: nowrap;
}

.table tbody td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* DataTables Specific */
.dataTables_wrapper .dataTables_length select {
    padding: 4px 24px 4px 8px;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    background-color: #fff;
}

.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 6px 12px;
    margin-left: 8px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 6px 12px;
    margin-left: 4px;
    border-radius: 4px;
    border: 1px solid #dee2e6;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #0d6efd;
    border-color: #0d6efd;
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #e9ecef;
    border-color: #dee2e6;
    color: #0d6efd !important;
}

/* Button Styling */
.btn-success {
    background-color: #198754;
    border-color: #198754;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
}

.btn-success:hover {
    background-color: #157347;
    border-color: #146c43;
}

/* Icons */
.fas.fa-check {
    color: #198754;
    font-size: 1rem;
}

.fas.fa-times {
    color: #dc3545;
    font-size: 1rem;
}

/* Card Styling */
.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,.05);
    margin-bottom: 24px;
}

.card-body {
    padding: 24px;
}

/* Action Buttons */
.btn-sm {
    padding: 4px 8px;
    font-size: 0.875rem;
    border-radius: 4px;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

/* Alert Styling */
.alert {
    border-radius: 8px;
    padding: 12px 20px;
    margin-bottom: 24px;
}

.alert-success {
    background-color: #d1e7dd;
    border-color: #badbcc;
    color: #0f5132;
}

/* Container Spacing */
.container-fluid {
    padding: 24px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding: 16px;
    }
    
    .card-body {
        padding: 16px;
    }
    
    .table thead th {
        padding: 8px;
    }
    
    .table tbody td {
        padding: 8px;
    }
}
</style>

<div class="container-fluid mt-3">
    <?php if (isset($_GET['success'])): ?>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start mb-3">
                <a href="create.php" class="btn btn-success me-2">
                    <i class="fas fa-plus"></i> ADD
                </a>
            </div>
            <table class="table table-bordered" id="payrollSettingTable">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Working Days</th>
                        <th>Hour Per Day</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th>Sun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM prpaypolicy ORDER BY id DESC";
                    $result = $con->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>
                                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-sm btn-secondary me-1'><i class='fas fa-edit'></i></a>
                                    <button type='button' class='btn btn-sm btn-danger delete-btn' data-id='" . $row['id'] . "'><i class='fas fa-trash'></i></button>
                                  </td>";
                            echo "<td>" . htmlspecialchars($row['code']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['workday']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['hourperday']) . "</td>";
                            echo "<td>
                                " . ($row['mon'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") . "
                              </td>";
                            echo "<td>
                                " . ($row['tues'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") . "
                              </td>";
                            echo "<td>
                                " . ($row['wed'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") . "
                              </td>";
                            echo "<td>
                                " . ($row['thur'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") . "
                              </td>";
                            echo "<td>
                                " . ($row['fri'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") . "
                              </td>";
                            echo "<td>
                                " . ($row['sat'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") . "
                              </td>";
                            echo "<td>
                                " . ($row['sun'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") . "
                              </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Add SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Toast notification
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

    // Initialize DataTable
    let table = $('#payrollSettingTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        order: [[1, 'desc']] // Sort by Code column by default
    });

    // Delete button click handler
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        const button = $(this);
        const row = button.closest('tr');
        
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
                const id = button.data('id');
                $.ajax({
                    url: "../../action/PayrollSetting/delete.php",
                    type: "POST",
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Remove row from table
                            table.row(row).remove().draw();
                            Toast.fire({
                                icon: 'success',
                                title: 'Policy deleted successfully'
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message || 'Error deleting policy',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Delete error:', error);
                        Swal.fire(
                            'Error!',
                            'Error deleting policy: ' + (error || 'Unknown error'),
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Show success message with Toast if URL has success parameter
    <?php if (isset($_GET['success'])): ?>
    Toast.fire({
        icon: 'success',
        title: 'Payroll policy saved successfully!'
    });
    <?php endif; ?>
});
</script>