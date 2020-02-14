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
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>
                    <!--<button type="button" class="btn btn-outline-secondary"><a href="custAdd.php">
                            <i class="material-icons">account_circle</i>Add Customer</a></button>-->
                    <h3>
                        <u>Customer List</u>
                    </h3>

                    

                        <table class="table table-hover table-striped table-responsive-sm">
                            <thead class="thead-dark">
                                <tr class="">
                                    <th class=""> User ID</th>
                                    <th class="">First Name</th>
                                    <th class="">Last Name</th>
                                    <th class="">Address</th>
                                    <th class="">Telephone Number</th>
                                    <th class="">Nic</th>
                                    <th class="">Occupation</th>
                                    <th class="">Email</th>
                                    <th class="">User Type</th>
                                    <th class="">Registered date</th>
                                    <th class="">Option</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../controllers/config.inc.php';

                                $dbQuery = "SELECT * FROM `customer`;";
                                if ($result = mysqli_query($conn, $dbQuery)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['first_name'] . '</td>
                                    <td>' . $row['last_name'] . '</td>
                                    <td>' . $row['address'] . '</td>                                    
                                    <td>' . $row['tel_no'] . '</td>
                                    <td>' . $row['nic'] . '</td>
                                    <td>' . $row['occupation'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['user_type'] . '</td>
                                    <td>' . $row['user_registered'] . '</td>
                                    <td><a href="custView.php?id=' . $row['id'] . '"><input class="btn btn-outline-info" type="button" value="View"></a> </td>

                                  </tr>';
                                        }
                                    } else {
                                        echo '<tr>
                                <td style="color: #ff0000">0 result</td>
                              </tr>';
                                    }
                                }
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
       
       
            