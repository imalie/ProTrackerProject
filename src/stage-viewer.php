
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Pro Tracker
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="../assets/css/mat-icons.css" />
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>
<body class="">
    <div class="wrapper">
        <div class="sidebar" data-color="green" style="margin-top: 10vh;" data-background-color="green" data-image="../assets/img/sidebar-1.jpg">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active  ">
                        <a class="nav-link" href="./dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./stages.php">
                            <i class="material-icons">
                                dns
                            </i>
                            <p>Stage Creation</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./stage_report.php">
                            <i class="material-icons">
                                chrome_reader_mode
                                </i>
                            <p>Stage Report</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./product.php">
                        <i class="material-icons">
                            next_week
                            </i>    
                            <p>Product Creation</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./productUom.php">
                            <i class="material-icons">library_books</i>
                            <p>Add New Product UOM</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include('mainHead.php') ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>
        <div class="container p-3">
            <?php
            if (isset($_GET['id'])){
                $dbQueryStages = "SELECT stages.stage_id,project.pro_name,stages.stage_name,stages.approx_budget,stages.stage_desc FROM stages 
                            JOIN project ON stages.pro_id = project.id WHERE stages.pro_id = '".$_GET['id']."';";
                if ($resultStage = mysqli_query($conn, $dbQueryStages)){
                    if (mysqli_num_rows($resultStage) > 0){
                        while ($rowStage = mysqli_fetch_assoc($resultStage)){
                            echo '<div class="border rounded mt-2">
                                <table class="table table-borderless">
                                <tr><td>Stage Name: '.$rowStage['stage_name'].'</td><td>Aprox Budget: '.$rowStage['approx_budget'].'</td></tr>
                                <tr><td colspan="2">'.$rowStage['stage_desc'].'</td></tr>';

                            $dbQueryStagesItem = "SELECT stages_item.item_id, product.product_name, stages_item.item_cost, stages_item.qty, stages_item.total_amount FROM stages_item JOIN product ON stages_item.item_id = product.id WHERE stages_item.stage_id = '".$rowStage['stage_id']."';";
                            if ($resultStageItem = mysqli_query($conn, $dbQueryStagesItem)){
                                if (mysqli_num_rows($resultStageItem) > 0){
                                    while ($rowStageItem = mysqli_fetch_assoc($resultStageItem)){

                                        echo '</table><div class="border rounded">
                                            <table class="table table-borderless" id="item_table">
                                            <tr>
                                            <td>'.$rowStageItem['item_id'].'</td><td>'.$rowStageItem['product_name'].'</td><td>'.$rowStageItem['item_cost'].'</td>
                                            <td>'.$rowStageItem['qty'].'</td><td>'.$rowStageItem['total_amount'].'</td>
                                            </tr>';

                                    }
                                }
                            }
                            echo '</table></div>';
                        }
                    }
                }
            }
            ?>
        </div>


                
    </div>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="../assets/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="../assets/js/plugins/jquery.validate.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    
   
</body>

</html>




