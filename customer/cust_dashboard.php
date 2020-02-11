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
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>
  <?php
  include_once '../controllers/config.inc.php';
  ?>

  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top" style="background-color: rgb(113,173,225) !important;padding-top: 0px !important ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#pablo"></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" style="display: block !important;">
       <h4 class="logo" style="float: left;float: left;  width: 10vw; text-align: center; border-bottom: 2px solid gray;">
        <a href="./dashboard.php" style="color: white; font-weight: bold">
          <img src="../assets/img/logo.png " height="60px" width="140px">
        </a>
      </h4>
      <ul class="navbar-nav" style="float: right">
        <!-- <li class="nav-item dropdown" style="cursor: pointer">
          <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i style="color: white" class="material-icons">notifications</i>
            <span class="notification">5</span>
            <p class="d-lg-none d-md-block">
              Some Actions
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Mike John responded to your email</a>
            <a class="dropdown-item" href="#">You have 5 new tasks</a>
            <a class="dropdown-item" href="#">You're now friend with Andrew</a>
            <a class="dropdown-item" href="#">Another Notification</a>
            <a class="dropdown-item" href="#">Another One</a>
          </div>
        </li> -->
        <li class="nav-item dropdown" style="cursor: pointer">


   

          <a class="nav-link" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-left: 10px; padding-top: 30px">
          
            <img src ="../assets/img/admin.png" height="30px" , width="40px" style="padding-right: 10px;"> <font > Customer </font>
            <!-- <i style="color: white" class="material-icons">person</i> -->
            <p class="d-lg-none d-md-block">
              Account
            </p>
          </a>
    
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="/Pro_Tracker/src/custProfile.php">Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../signout.php?signout=true">Log out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<body class="">
  <div class="wrapper">
    <!-- Navbar -->
     
      <!-- End Navbar -->
    <div class="sidebar" data-color="green" style="margin-top: 80px;" data-background-color="green" data-image="../assets/img/sidebar-1.jpg">
      <!-- <div class="logo">
        <a href="#" class="simple-text logo-normal">
          Pro Tracker
        </a>
      </div> -->
     
      <div class="sidebar-wrapper" >
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="../customer/cust_dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="../src/projectList.php">
              <i class="material-icons">content_paste</i>
              <p>Project Report</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="./notifications.html">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./reportCenter.php">
              <i class="material-icons">
                account_balance
              </i>
              <p>Report Center</p>
            </a>
          </li>

          
        </ul>
      </div>
    </div>
    <div class="main-panel">
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">monetization_on</i>
                  </div>
                  <!-- <p class="card-category">Followers</p> -->
                  <h3 class="card-title">Payment</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">exit_to_app</i>
                    <a href="/Pro_Tracker/src/payment-report.php"> view More Payment details..</a>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="card card-stats">
                      <div class="card-header card-header-danger card-header-icon">
                          <div class="card-icon">
                              <i class="material-icons">description</i>
                          </div>
                          <!-- <p class="card-category">Fixed Issues</p> -->
                          <h3 class="card-title">Project</h3>
                      </div>
                      <div class="card-footer">
                          <div class="stats">
                              <i class="material-icons">exit_to_app</i>
                              <a href="projectList.php"> view More Project details..</a>
                          </div>
                      </div>
                  </div>
              </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assessment</i>
                  </div>

                  <h3 class="card-title">Progress</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">exit_to_app</i>
                    <a href="/Pro_Tracker/src/project-cus-view.php"> view More Progress details..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="#">
                                Pro Tracker
                        </li>

                    </ul>

                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>  Provide by University Of Moratuwa
                </div>
            </div>
        </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
</body>
<!-- Test -->
</html>