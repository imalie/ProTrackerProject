<?php
session_start();
include_once '../controllers/config.inc.php';

$id = $proOwnerId = $proName = $approxBudget = "";



?>

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
                        <a class="nav-link" href="./custAdd.php">
                            <i class="material-icons">person</i>
                            <p>Customer Creation</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./custReport.php">
                            <i class="material-icons">content_paste</i>
                            <p>Customer Report</p>
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
                   
            <div class="col-lg-12 col-md-6 col-sm-6">
              <div class="card card-stats">
                   <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>

                  <h3 class="card-title">Project Approval
                  </h3>
                </div>

            
                <div class="card-header card-header-warning card-header-icon">
                  


<br>
<br>
  

                    <form class="form-group" method="get">
                    <div class="form-row">
                            <div class="form-group col-md-6">
                                <label id = "bold">Project Name:</label>
                                <br>
                                <input class="form-control" type="text" value="" placeholder="Disabled project Name..." disabled>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label  id = "bold">Project Owner :</label>
                                <br>
                                <input class="form-control" type="text" value="" placeholder="Disabled project  Owner Name..." disabled>
                            </div>
                    </div>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label>Approximated Budget</label>
                                <br>
                                    <input type="text" class="form-control" name="approx_budget" placeholder="Disabled Approximate budget" Disabled>


                                </div>
                            </div>
                       </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label id="bold">Check Investigation Report submitted:</label>
                                    <br>
                                    <a href="investigation.php?id=' . $row['id'] . '"><input class="btn btn-info" type="button" value="View Investigation "></a>
<!--                                    <button type="submit" name="submit" value="submit" class="btn btn-info">Investigation Report</button>-->
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status:</label>
                                <div class="form-row">
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="approval" id="lineRadio_approve" value="approved">Approve
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio_reject" value="reject">Reject
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                            </div>
                        </div>
                      
                        <div class="col-md-12">
                            <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
                            <?php
                            if (isset($SubmitStatus['dbStatus'])) {
                                echo '<div class="">
                                <span class="text-success">  Updated successfully</span>
                             </div>';
                            }
                            ?>
                        </div>
                    </div>
    </form>
</div>
        <div class="card-footer">
          <div class="stats">
        <footer class="footer">
                            <div class="container-fluid">
                                <?php include('mainFooter.php') ?>
                            </div>
                    </footer>
        </div>
        </div>

</body>
</html>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap-material-design.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

