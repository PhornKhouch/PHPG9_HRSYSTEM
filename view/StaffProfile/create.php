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
                <form action="../../action/StaffProfile/create.php" method="POST" id="staffForm">
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
                        </div>
                    </div>

                    <!-- Family Information Tab -->
                    <div class="tab-pane fade" id="familyInfo">
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Family Members</h6>
                                <button type="button" class="btn btn-success btn-sm" id="addFamilyMember">
                                    <i class="fas fa-plus"></i> Add Member
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="familyMembersTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Relation Type</th>
                                                <th>Gender</th>
                                                <th>Is Tax</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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


    <!-- Family Member Modal -->
    <div class="modal fade" id="familyMemberModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Family Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="familyMemberForm">
                        <input type="hidden" id="familyMemberIndex" value="">
                        <div class="mb-3">
                            <label for="relationName" class="form-label  ">Name</label>
                            <input type="text" class="form-control" id="relationName">
                        </div>
                        <div class="mb-3">
                            <label for="relationType" class="form-label  ">Relation Type</label>
                            <select class="form-select" id="relationType">
                                <option value="">Select Relation</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Child">Child</option>
                                <option value="Parent">Parent</option>
                                <option value="Sibling">Sibling</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="relationGender" class="form-label  ">Gender</label>
                            <select class="form-select" id="relationGender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="isTax">
                                <label class="form-check-label" for="isTax">Include in Tax Calculation</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveFamilyMember">Save</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        var listFamily = [];
        var Familypopup = document.getElementById('familyMemberModal');
        var familyMemberModal = new bootstrap.Modal(Familypopup);
        // Add family member button click
        $('#addFamilyMember').click(function() {
            $('#familyMemberIndex').val('');
            $('#familyMemberForm')[0].reset();
            familyMemberModal.show();
        });
        $("#saveFamilyMember").click(function() {
            var name = $("#relationName").val();
            var retype = $("#relationType").val();
            var gender = $("#relationGender").val();
            var istax = $("#isTax").is(":checked");
            const index = $('#familyMemberIndex').val();
           
            if (index === '') {
                // Add new member
                listFamily.push({
                    name: name,
                    retype: retype,
                    gender: gender,
                    istax: istax
                });
            } else {
                // Update existing member
                listFamily[parseInt(index)] = {
                    name: name,
                    retype: retype,
                    gender: gender,
                    istax: istax
                };
            }
            DisplayFamily(listFamily);
        });


        function DisplayFamily(Listitem) {
            var html = "";
            for (var i in Listitem) {
                html += `
                    <tr>
                        <td>${Listitem[i].name}</td>
                        <td>${Listitem[i].retype}</td>
                        <td>${Listitem[i].gender}</td>
                        <td>${Listitem[i].istax}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary edit-family" data-index="${i}">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger btndelete"  data-index="${i}">Delete</button>
                        </td>
                    </tr>
                `;
            }
            const tbody = $('#familyMembersTable tbody');
            tbody.empty();
            tbody.append(html);

            familyMemberModal.hide();
        }

        $(document).on("click", ".btndelete", function() {
            var index = $(this).data("index");

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
                    listFamily.splice(index, 1); //index remove
                    DisplayFamily(listFamily);
                    Toast.fire({
                        icon: 'success',
                        title: 'Family member removed'
                    });
                }
            });
        })


            // Edit family member
        $(document).on('click', '.edit-family', function() {
            
            const index = $(this).data('index');
            const member = listFamily[index];

            $('#familyMemberIndex').val(index);
            $('#relationName').val(member.name);
            $('#relationType').val(member.retype);
            $('#relationGender').val(member.gender);
            $('#isTax').prop('checked', member.istax === 1);

            familyMemberModal.show();
        });













// Form submission
    $('#staffForm').submit(function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        // Add family members data
        formData.append('familyMembers', JSON.stringify(listFamily));
        $.ajax({
            url: '../../action/StaffProfile/create.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                 console.log('Success Response:', response);
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Error creating staff profile',
                        icon: 'error'
                    });
                }
            },
           
        });
    });






    })
</script>

</html>