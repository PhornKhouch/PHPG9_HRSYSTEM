<?php
include '../../root/Header.php';
?>
<link rel="stylesheet" href="../../Style/style.css">
<title>Document</title>
</head>

<body>
    <br>
    <div class="container-fluid" style="margin-left: 10px;overflow:hidden;">

        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="Company-tab" data-bs-toggle="tab" data-bs-target="#Company" type="button" role="tab" aria-controls="Company" aria-selected="true">Company </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Department-tab" data-bs-toggle="tab" data-bs-target="#Department" type="button" role="tab" aria-controls="Department" aria-selected="false">Department</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Division-tab" data-bs-toggle="tab" data-bs-target="#Division" type="button" role="tab" aria-controls="Division" aria-selected="false">Division</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Level-tab" data-bs-toggle="tab" data-bs-target="#Level" type="button" role="tab" aria-controls="Level" aria-selected="false">Level</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Position-tab" data-bs-toggle="tab" data-bs-target="#Position" type="button" role="tab" aria-controls="Position" aria-selected="false">Position</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Company" role="tabpanel" aria-labelledby="Company-tab">
                    <?php
                    include 'TabCompany.php';
                    ?>

                </div>
                <div class="tab-pane fade" id="Department" role="tabpanel" aria-labelledby="Department-tab">Department</div>
                <div class="tab-pane fade" id="Division" role="tabpanel" aria-labelledby="Division-tab">Disivion</div>
                <div class="tab-pane fade" id="Level" role="tabpanel" aria-labelledby="Level-tab">Level</div>
                <div class="tab-pane fade" id="Position" role="tabpanel" aria-labelledby="Position-tab">Position</div>
            </div>
        </div>
    </div>

    
</body>

</html>