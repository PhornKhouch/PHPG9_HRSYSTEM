<?php
include("../../Config/conect.php");
session_start();

// Get career history data
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Fetch career history data
$Sql="SELECT ch.*, sp.EmpName, 
                             c.Description as Company, d.Description as DepartmentDes, p.Description as PositionDes,
                             dv.Description as Division, l.Description as Level
                      FROM careerhistory ch 
                      LEFT JOIN hrstaffprofile sp ON ch.EmployeeID = sp.EmpCode 
                      LEFT JOIN hrcompany c ON sp.Company = c.Code
                      LEFT JOIN hrdepartment d ON sp.Department = d.Code
                      LEFT JOIN hrposition p ON sp.Position = p.Code
                      LEFT JOIN hrdivision dv ON sp.Division = dv.Code
                      LEFT JOIN hrlevel l ON sp.Level = l.Code
                      WHERE ch.ID = ?";
$stmt = $con->prepare($Sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$careerHistory = $result->fetch_assoc();
$stmt->close();

if (!$careerHistory) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Career History</title>
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
                            <h4 class="mb-0">Edit Career History</h4>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="careerHistoryForm" action="../../action/CareerHistory/edit.php" method="POST" novalidate>
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employeeID" class="form-label required">Employee ID</label>
                                        <input type="text" class="form-control" id="Code" name="employeeID" value="<?php echo htmlspecialchars($careerHistory['EmployeeID']); ?>" readonly>   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="company" readonly 
                                               value="<?php echo htmlspecialchars($careerHistory['Company'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" class="form-control" id="department" readonly 
                                               value="<?php echo htmlspecialchars($careerHistory[''] ?? ''); ?>">
                                        <input type="hidden" name="department" id="department_code" 
                                               value="<?php echo htmlspecialchars($careerHistory['Department']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <input type="text" class="form-control" id="position" readonly 
                                               value="<?php echo htmlspecialchars($careerHistory['PositionTitle'] ?? ''); ?>">
                                        <input type="hidden" name="positionTitle" id="position_code" 
                                               value="<?php echo htmlspecialchars($careerHistory['PositionTitle']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="division" class="form-label">Division</label>
                                        <input type="text" class="form-control" id="division" readonly 
                                               value="<?php echo htmlspecialchars($careerHistory['Division'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <input type="text" class="form-control" id="level" readonly 
                                               value="<?php echo htmlspecialchars($careerHistory['Level'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="startDate" class="form-label required">Effective Date</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" required 
                                               value="<?php echo htmlspecialchars($careerHistory['StartDate']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="endDate" class="form-label">Resignation Date</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate" 
                                               value="<?php echo htmlspecialchars($careerHistory['EndDate'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="increase" class="form-label">Increase Amount</label>
                                        <input type="number" step="0.01" class="form-control" id="increase" name="increase" 
                                               value="<?php echo htmlspecialchars($careerHistory['Increase'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="careerCode" class="form-label required">Career Code</label>
                                        <select name="careerCode" id="careerCode" class="form-select" required>
                                            <option value="">Select Career Code</option>
                                            <?php
                                            $careerCodes = [
                                                'NEW' => 'New Join',
                                                'PROMOTE' => 'Promote',
                                                'TRANSFER' => 'Transfer',
                                                'RESIGN' => 'Resign',
                                                'INCREASE' => 'Increase Salary'
                                            ];
                                            foreach ($careerCodes as $code => $label) {
                                                $selected = ($code === $careerHistory['CareerHistoryType']) ? 'selected' : '';
                                                $badgeClass = 'badge-' . strtolower($code);
                                                echo "<option value='{$code}' class='{$badgeClass}' {$selected}>{$label}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="remark" class="form-label">Remark</label>
                                        <textarea class="form-control" id="remark" name="remark" rows="3"><?php 
                                            echo htmlspecialchars($careerHistory['Remark'] ?? ''); 
                                        ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
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

</body>
</html>