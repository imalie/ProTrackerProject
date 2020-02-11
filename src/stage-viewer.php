
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
         <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
</head>
  <?php include('mainHead.php') ?>
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
          
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid" >
                    <h2>List Of Stage View</h2>
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
                                <table class="table border rounded">
                                <tr>
                              
                                <tr><td><b>Stage Name: </b> &nbsp; <div style = "background-color:#d5f1f5 ;border-radius:10px; padding-top:8px; padding-bottom:8px; padding-left:10px;">'





                                .$rowStage['stage_name'].'</div></td>

                                <td> <b>Approximate budget</b> <div style = "background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;">'.$rowStage['approx_budget'].'</div></td></tr>


                                <tr><td colspan="2"> <b>Description:</b><div style = "background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;">'.$rowStage['stage_desc'].'</div></td></tr>';

                            $dbQueryStagesItem = "SELECT stages_item.item_id, product.product_name, stages_item.item_cost, stages_item.qty, stages_item.total_amount FROM stages_item JOIN product ON stages_item.item_id = product.id WHERE stages_item.stage_id = '".$rowStage['stage_id']."';";
                            if ($resultStageItem = mysqli_query($conn, $dbQueryStagesItem)){
                                if (mysqli_num_rows($resultStageItem) > 0){
                                    while ($rowStageItem = mysqli_fetch_assoc($resultStageItem)){

                                        echo '</table><div class="border rounded">
                                            <table class="table table-borderless" id="item_table">
                                            <tr>
                                            </tr>
                                            <tr>
                                            <td><b>Material Id:</b><div style = "background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;">'.$rowStageItem['item_id'].'</div></td>

                                            <td><b>Material Name:</b><div style = "background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;">'.$rowStageItem['product_name'].'</div></td>
                                            <td><b>Approximate Budget:</b><div style = "background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;">'.$rowStageItem['item_cost'].'</div></td>

                                            <td><b>Quantity:</b><div style = "background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;">'.$rowStageItem['qty'].'</div></td>

                                            <td><b>Total Amount:</b><div style = "background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;">'.$rowStageItem['total_amount'].'</div></td>
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
    </div>
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
    
   <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
</body>

</html>




