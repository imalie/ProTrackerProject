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
    <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
    <script type="text/javascript" src="../res/ad/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../res/ad/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/mat-icons.css" />
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/demo/demo.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
</head>
 <!-- Navbar -->
 <?php include('mainHead.php') ?>
            <!-- End Navbar -->
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
                    <a class="nav-link" href="./payment.php">
                        <i class="material-icons">
                            dns
                        </i>
                        <p>Payment Creation</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
       
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <h2>Project Payment Details</h2>
                <?php
                include_once '../controllers/config.inc.php';
                $paymentId = $customerId = $customerName = $projectId = $projectName = $amount = $releaseDate = $releaseUser = "";
                $dbQuery = "SELECT payment.id,payment.customer_id,customer.first_name,customer.last_name,payment.project_id,payment.amount,payment.release_date,payment.release_user
                            FROM payment JOIN customer ON payment.customer_id = customer.id WHERE payment.id = '".$_GET['id']."';";

                if ($result = mysqli_query($conn, $dbQuery)){
                    $row = mysqli_fetch_assoc($result);

                    $dbQueryPro = "SELECT project.pro_name FROM project WHERE project.id = '".$row['project_id']."';";
                    $resultPro = mysqli_query($conn, $dbQueryPro);
                    $rowPro = mysqli_fetch_assoc($resultPro);

                    $dbQueryUser = "SELECT users.email FROM users WHERE users.id = '".$row['release_user']."';";
                    $resultUser = mysqli_query($conn, $dbQueryUser);
                    $rowUser = mysqli_fetch_assoc($resultUser);

                    $paymentId = $row['id'];
                    $customerId = $row['customer_id'];
                    $customerName = $row['first_name']. ' '.$row['last_name'];
                    $projectId = $row['project_id'];
                    $projectName = $rowPro['pro_name'];
                    $amount = $row['amount'];
                    $releaseDate = $row['release_date'];
                    $releaseUser = $rowUser['email'];
                }
                ?>

                <style>
                    #box {
                        background-color:#e6e6e6 ;border-radius:10px; padding-top:8px; padding-bottom:8px;padding-left:10px;

                    }
                </style>



                                <div class="border rounded mt-2">
                                <table class="table border rounded">
                                <tr>
                              
                                <tr>

                                <td style="width :30% !important"><b>Payment ID : </b> &nbsp; 
                                <div id = "box">
                                       <?php echo $paymentId;?>
                                </div>
                                </td>
                                 </tr>
                                 <tr>
                                <td> <b>Customer ID:</b> <div id = "box">
                                <?php echo $customerId;?>
                                </div>
                                </td>

                                <td colspan="2"> <b>Customer Name :</b>
                                <div id = "box"> <?php echo $customerName;?>
                                </div>
                                </td>
                               
                                
                                

                                <td> Payment Date
                                <div id = "box"><?php echo $releaseDate;?>
                                </div>
                                </td>
                                </tr>
                                <tr>

                                <td> Project ID
                                <div id = "box"><?php echo $projectId;?>
                                </div>
                                </td>

                                <td> Project Name
                                <div id = "box"><?php echo $projectName;?>
                                </div>
                                </td>
                          
                                <td> Amount
                                <div id = "box">LKR <?php echo $amount;?>
                                </td>

                                <td> Release User
                                <div id = "box"><?php echo $releaseUser;?>
                                </td>                             

                                </tr>

                                </tr>
                                </tr>
                                </table>






                <div class="container p-3">
                    <table class="table table-borderless">
                        <tr>
                            <td colspan="4"><a href="../print/pyament_rec.php?id=<?php echo $_GET['id'];?>" target="_blank" class="btn btn-success float-right">Print</a></td>
                        </tr>
                 <!--        <tr>
                            <td class="w-25"><label> Payment ID<label class="form-control"><?php echo $paymentId;?></label></label></td>
                            <td class="w-25"><label> Customer ID<label class="form-control"><?php echo $customerId;?></label></label></td>
                            <td class="w-50"><label> Customer Name<label class="form-control"><?php echo $customerName;?></label></label></td>
                        </tr>
                        <tr>
                            <td class="w-25"><label>Payment Date<label class="form-control"><?php echo $releaseDate;?></label></label></td>
                            <td class="w-25"><label>Project ID<label class="form-control"><?php echo $projectId;?></label></label></td>
                            <td class="w-25"><label>Project Name<label class="form-control"><?php echo $projectName;?></label></label></td>
                            <td class="w-25"><label>Amount<label class="form-control">LKR <?php echo $amount;?></label></label></td>
                        </tr>
                        <tr>
                            <td class="w-25"><label>Release User<label class="form-control"><?php echo $releaseUser;?></label></label></td>
                        </tr> -->
                    </table>
                </div>
            </div>
        </div>
</body>

 <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

<?php include 'mainFooter.php'; ?>
