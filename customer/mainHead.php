
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
        <a href="./cust_dashboard.php" style="color: white; font-weight: bold">
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
          
            <img src ="../assets/img/admin.png" height="30px" , width="40px" style="padding-right: 10px;"> <font > Admin </font>
            <!-- <i style="color: white" class="material-icons">person</i> -->
            <p class="d-lg-none d-md-block">
              Account
            </p>
          </a>
    
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="/Pro_Tracker/src/UserProfile.php">Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../signout.php?signout=true">Log out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>