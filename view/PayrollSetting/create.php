<?php
    include("../../root/Header.php");
    include("../../Config/conect.php");
?>

<!-- Add SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="../../Style/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<div class="container-fluid mt-3">
    <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_GET['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5>Pay Policy</h5>
        </div>
        <div class="card-body">
            <form id="payrollForm" action="../../action/PayrollSetting/create.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fromDate" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="toDate" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h6>Working Day</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-2">
                                        <input type="checkbox" class="form-check-input" id="mon" name="mon" value="1">
                                        <label class="form-check-label" for="mon">Monday</label>
                                    </div>
                                    <select class="form-select" name="monHours" style="width: 80px;" required>
                                        <?php for($i=1; $i<=24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-2">
                                        <input type="checkbox" class="form-check-input" id="tue" name="tue" value="1">
                                        <label class="form-check-label" for="tue">Tuesday</label>
                                    </div>
                                    <select class="form-select" name="tueHours" style="width: 80px;" required>
                                        <?php for($i=1; $i<=24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-2">
                                        <input type="checkbox" class="form-check-input" id="wed" name="wed" value="1">
                                        <label class="form-check-label" for="wed">Wednesday</label>
                                    </div>
                                    <select class="form-select" name="wedHours" style="width: 80px;" required>
                                        <?php for($i=1; $i<=24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-2">
                                        <input type="checkbox" class="form-check-input" id="thu" name="thu" value="1">
                                        <label class="form-check-label" for="thu">Thursday</label>
                                    </div>
                                    <select class="form-select" name="thuHours" style="width: 80px;" required>
                                        <?php for($i=1; $i<=24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-2">
                                        <input type="checkbox" class="form-check-input" id="fri" name="fri" value="1">
                                        <label class="form-check-label" for="fri">Friday</label>
                                    </div>
                                    <select class="form-select" name="friHours" style="width: 80px;" required>
                                        <?php for($i=1; $i<=24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-2">
                                        <input type="checkbox" class="form-check-input" id="sat" name="sat" value="1">
                                        <label class="form-check-label" for="sat">Saturday</label>
                                    </div>
                                    <select class="form-select" name="satHours" style="width: 80px;" required>
                                        <?php for($i=1; $i<=24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-2">
                                        <input type="checkbox" class="form-check-input" id="sun" name="sun" value="1">
                                        <label class="form-check-label" for="sun">Sunday</label>
                                    </div>
                                    <select class="form-select" name="sunHours" style="width: 80px;" required>
                                        <?php for($i=1; $i<=24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h6>Working Hour</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="hourPerDay" class="form-label">Hour per Day</label>
                                <input type="number" class="form-control" id="hourPerDay" name="hourPerDay" required min="0" max="24" step="0.5" value="8">
                            </div>
                            <div class="col-md-6">
                                <label for="workDay" class="form-label">Work Days</label>
                                <input type="number" class="form-control" id="workDay" name="workDay" required min="0" max="168" step="0.5" value="26">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
</style>

<script>
$(document).ready(function() {
    $('#payrollForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
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
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error'
                });
            }
        });
    });
});
</script>