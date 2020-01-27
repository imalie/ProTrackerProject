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

<body class="">
  <div class="wrapper">
    <!-- Navbar -->
      <?php include('mainHead.php') ?>
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
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./userReport.php">
              <i class="material-icons">person</i>
              <p>User Report</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./projectList.php">
              <i class="material-icons">content_paste</i>
              <p>Project Report</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./stage_report.php">
              <i class="material-icons">library_books</i>
              <p>Stage Report</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./notifications.html">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./ReportCenter.php">
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
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>

                  <h3 class="card-title">User
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">exit_to_app</i>
                    <a href="/Pro_Tracker/src/UserReport.php">View More User details..</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-bg-secondary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">peoplealt</i>
                  </div>
                  <!-- <p class="card-category">Customer</p> -->
                  <h3 class="card-title">Customer</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">exit_to_app</i>
                    <a href="CustReport.php"> view More Customer details..</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
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
                    <a href="/Pro_Tracker/src/projectList.php"> view More Project details..</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">view_list</i>
                  </div>
                  <!-- <p class="card-category">Followers</p> -->
                  <h3 class="card-title">Stage</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">exit_to_app</i>
                    <a href="/Pro_Tracker/src/stage_report.php"> view More Stage details..</a>
                  </div>
                </div>
              </div>
            </div>
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
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assessment</i>
                  </div>

                  <h3 class="card-title">Progress</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">exit_to_app</i>
                    <a href="/Pro_Tracker/src/progress.php"> view More Progress details..</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
                    <div class="container-fluid">
                        <?php include('mainFooter.php') ?>
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