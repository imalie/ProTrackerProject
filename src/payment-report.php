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
            <div class="content">
                <div class="container-fluid">
                    <h4>Payment Report</h4>
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>
                    <!--<button type="button" class="btn btn-outline-secondary"><a href="./stages.php">Add Stage</a></button>-->

                    <table class="table table-hover table-striped table-responsive-sm" >
                        <thead class="thead-dark">
                            
                            <tr class="">
                                <th class="">Payment ID</th>
                                <th class="">Full Name</th>
                                <th class="">Project ID</th>
                                <th class="">Paid Amount</th>
                                <th class="">Release Date</th>
                                <th class="">Release User</th>
                                <th class="">Option</th>
                            </tr>
                            </thead>
                            <tbody>
        <?php
        include '../controllers/config.inc.php';

        $dbQuery = "SELECT payment.id,customer.first_name,customer.last_name,payment.project_id,payment.amount,payment.release_date,payment.release_user
                    FROM payment JOIN customer ON payment.customer_id = customer.id;";
        if ($result = mysqli_query($conn, $dbQuery)){
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $dbQueryUser = "SELECT users.email FROM users WHERE users.id='".$row['release_user']."';";
                    $dbResultUser = mysqli_query($conn, $dbQueryUser);
                    $rowUser = mysqli_fetch_assoc($dbResultUser);

                    $dbQueryPro = "SELECT project.pro_name FROM project WHERE project.id='".$row['project_id']."';";
                    $dbResultPro = mysqli_query($conn, $dbQueryPro);
                    $rowPro = mysqli_fetch_assoc($dbResultPro);

                    echo '<tr>
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                                    <td>'.$rowPro['pro_name'].'</td>
                                    <td>'.$row['amount'].'</td>                                    
                                    <td>'.$row['release_date'].'</td>                                    
                                    <td>'.$rowUser['email'].'</td>
                                    <td><a class="btn btn-outline-info"" target="_blank" href="payment-view.php?id='.$row['id'].'">View</a></td>
                                  </tr>';
                }
            }else {
                echo '<tr>
                                <td style="color: #ff0000">0 result</td>
                              </tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php include 'mainFooter.php'; ?>
