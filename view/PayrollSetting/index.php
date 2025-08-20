<?php
    include("../../root/Header.php");
    include("../../Config/conect.php");
?>

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../Style/style.css">
<!-- Add SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">

<style>
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

<?php
    include '../../root/DataTable.php';
?>
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