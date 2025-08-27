<?php
    include '../../root/Header.php';
    include '../../Config/conect.php'
    
?>
</head>
<body>
    <?php
        if(isset($_GET['message'])){
            echo $_GET['message'];
            
        }

    ?>
    <div class="container-fluid mt-3">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <a href="create.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add New Staff
                    </a>
                </div>
                    
            </div>
       
        </div>
    </div>
</body>
<?php
    include '../../root/DataTable.php'
    ?>
</html>