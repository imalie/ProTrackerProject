<?php session_start(); ?>
            <div class="content">
                <div class="container-fluid">
                    <?php
                    include_once '../controllers/config.inc.php';

                    $validateError = array();
                    $SubmitStatus = array();

                    if (isset($_POST['submit'])) {
                        if (empty($_POST['uom_code'])) {
                            $validateError['uom_code'] = "UOM is empty";
                        } else {
                            $uomCode = $_POST['uom_code'];
                        }
                        $uomDesc = $_POST['uom_desc'];

                        if ($_POST['allow_decimal'] == 0 or $_POST['allow_decimal'] == 1) {
                            $allow_decimal = $_POST['allow_decimal'];
                        } else {
                            $validateError['allow_decimal'] = "allow decimal is empty";
                        }

                        if (0 === count($validateError)) {
                            $dbQuery = "INSERT INTO uom(uom_code,uom_desc,allow_decimal,release_user) VALUES ('" . $uomCode . "','" . $uomDesc . "','" . $allow_decimal . "','" . $_SESSION['userID'] . "');";

                            if (mysqli_query($conn, $dbQuery)) {
                                $SubmitStatus['dbStatus'] = "Submit success";
                            } else {
                                $SubmitStatus['dbError'] = "Update error to database";
                            }
                        }
                    }
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
                            <p>Material Creation</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./productUom.php">
                            <i class="material-icons">library_books</i>
                            <p>Add New Material UOM</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>
                    <div class="container">
            <h1>Construction Material Unit Of Measure</h1>
            <form class="form-group" method="post">
                    <div>
                        <h4>Add  New Material Measurement </h4>
                    </div>
                    <div>
                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <label>Enter unit Of Measure :</label>
                                                <input type="text"  class="form-control" name="uom_code"
                                                placeholder="Enter Unit of Measure Code" required>
                                        </div>
                        </div>
                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <label>Enter Description:</label>
                                                <textarea required="required"  name="uom_desc" class="form-control"
                                                placeholder="Enter product Description in detail"></textarea>
                                        </div>
                        </div>
                        <div class="form-row">
                       
                                <div class="form-group col-md-6">
                                <label>Availability of Product:</label>
                                </div>
                                <div class="form-group col-md-3">
                                <select name="allow_decimal" class="custom-select mb-3">
                                <option value="1">Allow</option>
                                <option value="0">Not Allow</option>
                                </select>
                                                                    
                                </div>
                        </div>
                    </div>
                    <div class="">
                                <button type="submit" name="submit" value="submit" class="btn btn-success">Create Unit Of Measure</button>
                 </div>
                
            </form>
                    
                    
                        <?php
                        if (!(0 === count($validateError))) {
                            foreach ($validateError as $error) {
                                showSubmitValidationMsg("Warning", $error);
                            }
                        }
                        if (!(0 === count($SubmitStatus))) {
                            foreach ($SubmitStatus as $status) {
                                showSubmitValidationMsg("Status", $status);
                            }
                        }
                        function showSubmitValidationMsg($validationHeader, $validationBody)
                        {
                            echo '<div class="">
            <span class="">' . $validationHeader . ':&nbsp;</span>
            <span class="">&nbsp;' . $validationBody . '</span>
          </div>';
                        }
                        ?>
                      
                            <table class="table table-hover table-striped table-responsive-sm">
                             <thead class="thead-dark">
                                <tr class="">
                                    <th class="">UOM Code</th>
                                    <th class="">Description</th>
                                    <th class="">Allow Decimal</th>
                                    <th class="">Release User</th>
                                    <th class="">Create Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dbQuerySelect = "SELECT uom.uom_code,uom.allow_decimal,uom.release_date,uom.uom_desc,users.email FROM uom JOIN users ON uom.release_user = users.id;";
                                if ($result = mysqli_query($conn, $dbQuerySelect)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['allow_decimal'] == 1) {
                                                $allowText = "Allow";
                                            } else {
                                                $allowText = "Not Allow";
                                            }
                                            echo '<tr>
                        <td>' . $row['uom_code'] . '</td>
                        <td>' . $row['uom_desc'] . '</td>
                        <td>' . $allowText . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['release_date'] . '</td>
                      </tr>';
                                        }
                                    } else {
                                        echo '
                  <tr>
                    <td style="color: #ff0000">0 result</td>
                  </tr>';
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>

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