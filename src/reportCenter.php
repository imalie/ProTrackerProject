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
<?php include('mainHead.php')  ?>
<body class="">
    

    <style>
        #pad{padding-left: 20px;}
    </style>
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
<!-- toogle start -->

        <div class="panel-group" id="accordion-home">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="padding-left: 20px; padding-top: 20px">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-home" href="#ww">
                       
                            <i class="material-icons">person</i>
                            <p>Table Reports</p>
                        </a>
                        
                    </h4>
                        </div>
                        <div id="ww" class="panel-collapse collapse">
                            <div class="panel-body">
                                     
                                 <a class="nav-link " href="report_project_count.php">
                                    <i class="material-icons">content_paste</i>
                                    <p>Project Count</p></a>
                         
                         
                                 <a class="nav-link" href="./custReport.php">
                                    <i class="material-icons">content_paste</i>
                                     <p>Cash Inflow</p></a>
                         
                          
                                 <a class="nav-link" href="./custReport.php">
                                    <i class="material-icons">content_paste</i>
                                     <p>Project stage wise Report</p></a>
                            

                              </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title" style="padding-left: 20px; padding-top: 20px">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-home" href="#youtube">
                                       
                                            <i class="material-icons">content_paste</i>
                                            <p>Chart Reports</p>
                                        </a>
                                        
                                    </h4>
                                </div>
                                <div id="youtube" class="panel-collapse collapse">
                                    <div class="panel-body">
                                             
                                                 <a class="nav-link" href="./custReport.php">
                                            <i class="material-icons">content_paste</i>
                                            <p>Chart Reports</p></a>
                                         
                                         
                                                 <a class="nav-link" href="./project_Count.php">
                                                    <i class="material-icons">content_paste</i>
                                                    <p>Project Count</p></a>
                                         
                                          
                                                 <a class="nav-link" href="./custReport.php">
                                                    <i class="material-icons">content_paste</i>
                                                     <p>Project stage wise Report</p></a>
                                            

                                              </div>
                                </div>
                            </div>
                        </div>



                </ul>
            </div>
        </div>
        <!-- toogle end -->

        <!-- 
                    <li class="nav-item ">
                        <a class="nav-link" href="./custAdd.php" >
                            <i class="material-icons">person</i>
                            <p>Table Reports</p>
                        </a>
                            
                            <li class=" " id="pad">
                                 <a class="nav-link " href="report_project_count.php">
                                    <i class="material-icons">content_paste</i>
                                    <p>Project Count</p></a>
                             </li>
                             <li class=" " id="pad">
                                 <a class="nav-link" href="./custReport.php">
                                    <i class="material-icons">content_paste</i>
                                     <p>Cash Inflow</p></a>
                             </li>
                              <li class=" " id="pad">
                                 <a class="nav-link" href="./custReport.php">
                                    <i class="material-icons">content_paste</i>
                                     <p>Project stage wise Report</p></a>
                             </li>
                          
                         
                       
                    </li> -->
                    <!-- <li class="nav-item ">
                        <a class="nav-link" href="./custReport.php">
                            <i class="material-icons">content_paste</i>
                            <p>Chart Reports</p>
                             <ul class="subnav">
                            <li class="subnav-item ">
                                 <a class="nav-link" href="./project_Count.php">
                                    <i class="material-icons">content_paste</i>
                                    <p>Project Count</p>
                             </li>
                             <li class="subnav-item ">
                                 <a class="nav-link" href="./custReport.php">
                                    <i class="material-icons">content_paste</i>
                                     <p>Cash Inflow</p>
                             </li>
                              <li class="subnav-item ">
                                 <a class="nav-link" href="./custReport.php">
                                    <i class="material-icons">content_paste</i>
                                     <p>Project stage wise Report</p>
                             </li>
                          
                            </ul>
                        </a>

                    </li> -->

        <div class="main-panel">
            <!-- Navbar -->
            
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>
                    <!--<button type="button" class="btn btn-outline-secondary"><a href="custAdd.php">
                            <i class="material-icons">account_circle</i>Add Customer</a></button>-->

                    
                    
                       

                        <h4>Cash Inflow</h4>
                        <table class="table table-hover table-striped table-responsive-sm">
                            <thead class="thead-dark">
                                <tr class="">
                                    <th class=""> Month</th>
                                    <th class="">Invoiced Amount</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../controllers/config.inc.php';

                            
                                ?>
                                 </tbody>
                        </table>
                             <h4>Project Stage wise Report</h4>
                        <table class="table table-hover table-striped table-responsive-sm">
                            <thead class="thead-dark">
                                <tr class="">
                                    <th class=""> Project Name</th>
                                    <th class="">Current stage</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../controllers/config.inc.php';

                               
                                ?>
                                
                            </tbody>
                        </table>
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

</html>
       
       
            