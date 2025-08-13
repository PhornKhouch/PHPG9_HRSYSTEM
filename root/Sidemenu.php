<!DOCTYPE html>
<html>

<head>
    <?php
    include("header.php");
    ?>
    <!-- Google Fonts - Professional font combination -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Noto+Sans+Khmer:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Style/sidemenu.css">
</head>

<body>
    <div class="menu">
        <div class="menu-search">
            <input type="text" placeholder="Search menu..." class="form-control">
        </div>
        <ul class="list-unstyled components">
           <li>
                    <a href="../view/Dashboard/index.php" target="content">
                        <i class="fa fa-home"></i>Dasborad
                    </a>
                </li>

                <!-- Master Set up -->
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-cog"></i><span lang="km">Setting</span>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="../view/HRCompanyInfor/index.php" target="content">Company Infor</a>
                        </li>
                        <li>
                            <a href="../view/PayrollSetting/index.php" target="content">Payroll</a>
                        </li>
                        <li>
                            <a href="../view/TaxSetting/index.php" target="content">Tax Setting</a>
                        </li>
                        <li>
                            <a href="../view/LeavePolicy/index.php" target="content">Leave Policy</a>
                        </li>
                        <!-- <li>
                            <a href="../view/Menu/index.php" target="content">General Settings</a>
                        </li>
                        <li>
                            <a href="../view/User/index.php" target="content">User Settings</a>
                        </li>
                        <li>
                            <a href="../view/Telegramconfig/index.php" target="content">Telegram config</a>
                        </li>
                        <li>
                            <a href="../view/OTSetting/index.php" target="content">OT Setting</a>
                        </li> -->
                    </ul>
                </li>

                <!-- Employee -->
                <li>
                    <a href="#Order" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-users"></i><span lang="km">Employee</span>
                    </a>
                    <ul class="collapse list-unstyled" id="Order">
                        <li>
                            <a href="../view/StaffProfile/index.php" target="content">Staff Profile</a>
                        </li>
                        <li>
                            <a href="../view/CareerHistory/index.php" target="content">Career History</a>
                        </li>
                    </ul>
                </li>

                <!-- Self Service -->
                <li>
                    <a href="#ESS" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-book"></i><span lang="km">Self Service</span>
                    </a>
                    <ul class="collapse list-unstyled" id="ESS">
                        <li>
                            <a href="../view/SSLeaveRequest/index.php" target="content">Self Request Leave</a>
                        </li>
                        <li>
                            <a href="../view/SSLeaveApproval/index.php" target="content">Leave Approval</a>
                        </li>
                    </ul>
                </li>

                <!-- Leave -->
                <li>
                    <a href="#Leave" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-users"></i><span lang="km">Leave </span>
                    </a>
                    <ul class="collapse list-unstyled" id="Leave">
                        <li>
                            <a href="../view/LeaveBalance/index.php" target="content">Leave Balance</a>
                        </li>
                        <li>
                            <a href="../view/LeaveRequest/index.php" target="content">Leave Request</a>
                        </li>
                        <li>
                            <a href="../view/LeaveApproval/index.php" target="content">Leave Approval</a>
                        </li>
                    </ul>
                </li>

                <!-- Payroll -->
                <li>
                    <a href="#User" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-money-bill"></i><span lang="km">Payroll</span>
                    </a>
                    <ul class="collapse list-unstyled" id="User">
                        <li>
                            <a href="../view/PROvertime/index.php" target="content">Overtime</a>
                        </li>
                        <li>
                            <a href="../view/PRAllowance/index.php" target="content">Allowance</a>
                        </li>
                        <li>
                            <a href="../view/PRBonus/index.php" target="content">Bonus</a>
                        </li>
                        <li>
                            <a href="../view/PRDeduction/index.php" target="content">Deduction</a>
                        </li>
                        <li>
                            <a href="../view/PRGenSalary/generatesalary.php" target="content">Generate Salary</a>
                        </li>
                        <li>
                            <a href="../view/PRPayDetail/paydetail.php" target="content">Pay Detail</a>
                        </li>
                        <li>
                            <a href="../view/PRApproveSalary/index.php" target="content">Salary Approval</a>
                        </li>
                    </ul>
                </li>

                <!-- Recruitment -->
                <li>
                    <a href="#Recruite" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-book"></i><span lang="km">Recruitment</span>
                    </a>
                    <ul class="collapse list-unstyled" id="Recruite">
                        <li>
                            <a href="../view/RecuitmentApplicant/index.php" target="content">Recruitment Applicant</a>
                        </li>
                        <li>
                            <a href="../view/RecuitmentOnboarding/index.php" target="content">Onboarding</a>
                        </li>
                    </ul>
                </li>

                <!-- Report -->
                <li>
                    <a href="#Report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-book"></i><span lang="km">Report</span>
                    </a>
                    <ul class="collapse list-unstyled" id="Report">
                        <li>
                            <a href="../view/Report/EmployeeInOut/index.php" target="content">Employee InOut</a>
                        </li>
                        <li>
                            <a href="../view/Report/EmployeeFamily/index.php" target="content">Employee's Family</a>
                        </li>
                         <li>
                            <a href="../view/Report/ReportMonthlyPay/index.php" target="content">Monthly Salary Details</a>
                        </li>
                        <li>
                            <a href="../view/Report/PaySlip/index.php" target="content">PaySlip</a>
                        </li>
                        <li>
                            <a href="../view/Report/MonthlySummary/index.php" target="content">Monthly Summary</a>
                        </li>
                        <li>
                            <a href="../view/Report/LeaveReport/index.php" target="content">Leave Summary</a>
                        </li>
                    </ul>
                </li>

        </ul>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>

</html>