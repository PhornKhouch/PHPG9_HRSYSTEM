<?php
include("../../Config/conect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Career History</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Career History CSS -->
    <link href="../../style/career.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Create Overtime</h4>
                            <a href="index.php" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="overtimeForm" action="../../action/PROvertime/create.php" method="POST" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employeeID" class="form-label required">Employee ID</label>
                                        <select class="form-select" id="employeeID" name="employeeID" required>
                                            <option value="">Select Employee</option>
                                            <?php
                                            $sql = "SELECT EmpCode, EmpName FROM hrstaffprofile WHERE Status = 'Active' ORDER BY EmpName";
                                            $result = $con->query($sql);
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($row['EmpCode']) . "'>" . 
                                                     htmlspecialchars($row['EmpCode'] . ' - ' . $row['EmpName']) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="company" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" class="form-control" id="department" readonly>
                                        <input type="hidden" name="department" id="department_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <input type="text" class="form-control" id="position" readonly>
                                        <input type="hidden" name="positionTitle" id="position_code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="overtimeDate" class="form-label required">Overtime Date</label>
                                        <input type="date" class="form-control" id="overtimeDate" name="overtimeDate" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="overtimeType" class="form-label required">Overtime Type</label>
                                        <select class="form-select" id="overtimeType" name="overtimeType" required>
                                            <option value="">Select Overtime Type</option>
                                            <option value="OFF">Day Off</option>
                                            <option value="OT">Overtime</option>
                                            <option value="PH">PH Holiday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="overtimeDate" class="form-label required">From Time</label>
                                        <input type="time" class="form-control" id="fromTime" name="fromTime" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="mb-3">
                                        <label for="overtimeDate" class="form-label required">To Time</label>
                                        <input type="time" class="form-control" id="toTime" name="toTime" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                               
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="overtimeDate" class="form-label required">Reason</label>
                                       <textarea name="reason" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#employeeID').select2({
                theme: 'bootstrap-5',
                placeholder: 'Search for an employee...',
                allowClear: true
            });

              // Handle employee selection
            $('#employeeID').on('change', function() {
                const empCode = $(this).val();//get empcodefrom selection box 
                if (empCode) {
                    $.ajax({
                        url: '../../action/CareerHistory/getEmployee.php',
                        data: {
                            "empCode": empCode,
                            "action": 'getDetails'
                        },
                        method: 'GET',
                        success: function(response) {
                            const data = JSON.parse(response);//convert json to object
                            console.log(data);
                            $('#company').val(data.CompanyName);
                            $('#department').val(data.DepartmentName);
                            $('#department_code').val(data.Department);
                            $('#position').val(data.PositionName);
                            $('#position_code').val(data.Position);
                            
                        }
                    });
                } else {
                    // Clear all fields
                    $('#company, #department, #department_code, #position, #position_code, #division, #level').val('');
                }
            });

            // Check for error message in URL
            const urlParams = new URLSearchParams(window.location.search);
            const errorMsg = urlParams.get('error');
            if (errorMsg) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: decodeURIComponent(errorMsg)
                });
            }
        });
    </script>
</body>
</html>