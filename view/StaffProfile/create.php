<?php
include '../../root/Header.php';
include '../../Config/conect.php'
?>
</head>
<!-- Add SweetAlert2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<body>
    <div class="container-fluid mt-3" style="max-width: 1400px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Staff Profile</h5>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form action="../../action/StaffProfile/create.php" method="post" id="staffForm">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalInfo">
                                <i class="fas fa-user"></i> Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#jobInfo">
                                <i class="fas fa-briefcase"></i> Job Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#contactInfo">
                                <i class="fas fa-address-book"></i> Contact Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#familyInfo">
                                <i class="fas fa-users"></i> Family
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#educationInfo">
                                <i class="fas fa-graduation-cap"></i> Education
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#documentInfo">
                                <i class="fas fa-file-alt"></i> Staff Document
                            </a>
                        </li>
                    </ul>


                    <div class="tab-content">
                        <!-- Personal Information  -->
                        <div class="tab-pane fade show active" id="personalInfo">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="empCode" class="form-label  ">Employee Code</label>
                                    <input type="text" class="form-control" id="empCode" name="empCode">
                                </div>
                                <div class="col-md-6">
                                    <label for="empName" class="form-label  ">Employee Name</label>
                                    <input type="text" class="form-control" id="empName" name="empName">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="gender" class="form-label  ">Gender</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dob" class="form-label  ">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="photo" class="form-label">Profile Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="salary" class="form-label  ">Salary</label>
                                        <input type="number" class="form-control" id="salary" name="salary">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center mt-2">
                                            <div class="img-preview border rounded p-2">
                                                <img id="photoPreview" src="../../assets/images/images.jpg" alt="Profile Preview" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Job Information  -->
                        <div class="tab-pane fade show" id="jobInfo">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="company" class="form-label  ">Company</label>
                                    <!-- <input type="text" class="form-control" id="company" name="company"  > -->
                                    <select class="form-select" id="company" name="company">
                                        <option value="">Select Company</option>
                                        <?php
                                        $SQL = "Select *from hrcompany where Status = 'Active'";
                                        $stmt = $con->query($SQL);
                                        while ($row = $stmt->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="department" class="form-label  ">Department</label>
                                    <!-- <input type="text" class="form-control" id="department" name="department"  > -->
                                    <select class="form-select" id="department" name="department">
                                        <option value="">Select Department</option>
                                        <?php
                                        $stmt = $con->prepare("SELECT Code, Description FROM hrdepartment where Status = 'Active'");
                                        if ($stmt) {
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="position" class="form-label  ">Position</label>
                                    <!-- <input type="text" class="form-control" id="position" name="position"  > -->
                                    <select class="form-select" id="position" name="position">
                                        <option value="">Select Position</option>
                                        <?php
                                        $stmt = $con->prepare("SELECT Code, Description FROM hrposition where Status = 'Active'");
                                        if ($stmt) {
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="division" class="form-label">Division</label>
                                        <!-- <input type="text" class="form-control" id="division" name="division"> -->
                                        <select class="form-select" id="division" name="division">
                                            <option value="">Select Division</option>
                                            <?php
                                            $stmt = $con->prepare("SELECT Code, Description FROM hrdivision where Status = 'Active'");
                                            if ($stmt) {
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="level" class="form-label">Level</label>
                                        <!-- <input type="text" class="form-control" id="level" name="level"> -->
                                        <select class="form-select" id="level" name="level">
                                            <option value="">Select Level</option>
                                            <?php
                                            $stmt = $con->prepare("SELECT Code, Description FROM hrlevel where Status = 'Active'");
                                            if ($stmt) {
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <label for="startDate" class="form-label  ">Start Date</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="probationDate" class="form-label">Probation End Date</label>
                                        <input type="date" class="form-control" id="probationDate" name="probationDate">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="isProb" class="form-label">Probation Status</label>
                                        <select class="form-select" id="isProb" name="isProb">
                                            <option value="1">In Probation</option>
                                            <option value="0">Passed Probation</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telegram" class="form-label">Telegram</label>
                                        <!-- <input type="text" class="form-control" id="telegram" name="telegram"> -->
                                        <select name="telegram" id="telegram" class="form-select">
                                            <option value="">Select Telegram</option>
                                            <option value="">Reqeust Leave</option>
                                        </select>
                                    </div>
                                </div>


                               
                            </div>
                        </div>

                          <!-- Contact Information Tab -->
                    <div class="tab-pane fade" id="contactInfo">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            </div>
                        </div>
                    </div
                    </div>



                        <div class="d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary me-2" name="btnSubmit">Save</button>
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    
                </form>

            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {

    })
</script>

</html>