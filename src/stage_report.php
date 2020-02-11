
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
    <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
    <script type="text/javascript" src="../res/ad/bootstrap.js"></script>

  
    
</head>
 <!-- Navbar -->
 <?php include('mainHead.php') ?>
    <!-- End Navbar -->
<body class="">
    <div class="wrapper">
        <div class="sidebar" data-color="green" style="margin-top: 80px;"  data-background-color="green" data-image="../assets/img/sidebar-1.jpg">
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
           
            <div class="content">
                <div class="container-fluid">
                    <h2>Stage  List Report</h2>
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>
                    <!--<button type="button" class="btn btn-outline-secondary"><a href="./stages.php">Add Stage</a></button>-->

                    <table class="table table-hover table-striped table-responsive-sm" >
                        <thead class="thead-dark">
                                <tr class="">
                                    <th class="">Project ID</th>
                                    <th class="">Project Name</th>
                                    <th class="">Approximated Budget</th>
                                    <th class="">Release Date</th>
                                    <th class="">Release User</th>
                                    <th class="">Option</th>

                                </tr>
                            </thead>
                            <?php
                            include '../controllers/config.inc.php';

                            $dbQuery = "SELECT stages.pro_id,project.pro_name,SUM(stages.approx_budget),stages.release_date,stages.release_user 
                            FROM stages JOIN project ON stages.pro_id = project.id GROUP BY stages.pro_id;";
                            if ($result = mysqli_query($conn, $dbQuery)) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $dbSelectQueryPro = "SELECT users.email FROM users WHERE users.id='".$row['release_user']."';";
                                        $dbResultPro = mysqli_query($conn, $dbSelectQueryPro);
                                        $rowPro = mysqli_fetch_assoc($dbResultPro);
                                        echo '<tr>
                                    <td>' . $row['pro_id'] . '</td>
                                    <td>' . $row['pro_name'] . '</td>
                                    <td>' . $row['SUM(stages.approx_budget)'] . '</td>
                                    <td>' . $row['release_date'] . '</td>                                    
                                    <td>' . $rowPro['email'] . '</td>
                                    <td class="btn btn-outline-info"><a href="stage-viewer.php?id=' . $row['pro_id'] . '">View</a></td>
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
        </div>
        <footer class="footer">
            <div class="container-fluid">

            </div>
        </footer>
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


</body>

</html>