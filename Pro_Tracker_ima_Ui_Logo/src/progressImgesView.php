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
    <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/mat-icons.css" />
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
    <script type="text/javascript" src="../res/ad/bootstrap.js"></script>
</head>
<body class="">
    <div class="wrapper">
        <div class="sidebar" data-color="green" style="margin-top: 80px;" data-background-color="green" data-image="../assets/img/sidebar-1.jpg">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active  ">
                        <a class="nav-link" href="./dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./stock-adjustment.php">
                            <i class="material-icons">
                                dns
                            </i>
                            <p>Stock Adjustment</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./stock-adjustment.php">
                        <i class="material-icons">
                            show_chart
                            </i>
                            <p>Add Progress</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./projectList.php">
                            <i class="material-icons">
                                assignment
                            </i>
                            <p>Project Report</p>
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

<!--<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
        <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
        <script type="text/javascript" src="../res/ad/bootstrap.js"></script>
        <title>Images</title>
    </head>-->
    <body>
    <div class="container pt-4">
        <h2>Image Gallery</h2>
        <div class="card-columns">
            <?php
            include '../controllers/config.inc.php';

            $stage_id = $_GET['id'];

            $dbQuery = "SELECT stages_img.img,stages_img.release_date,stages.stage_name FROM stages_img JOIN stages ON stages_img.stages_id = stages.stage_id WHERE stages_img.stages_id = '".$stage_id."';";
            if ($result = mysqli_query($conn, $dbQuery)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                    <div class="card" style="width: 20rem">
                    <img class="card-img-top" alt="Card image cap" src="../doc/img/'.$row['img'].'">
                    <div class="card-body">
                    <h5 class="card-title">'.$row['stage_name'].'</h5>
                    <p class="card-text">Release Date: '.$row['release_date'].'</p>
                    </div>
                    </div>';
                    }
                }else {
                    echo '<h4>No Result</h4>';
                }
            }
            ?>
        </div>
    </div>
    </body>
</html>
