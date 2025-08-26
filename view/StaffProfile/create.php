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
                    </div>
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
    $(document).ready(function(){
 
    })
</script>
</html>