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
</head>
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
            <!-- Navbar -->
            <?php include('mainHead.php') ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>
            <div class="content">
                <div class="container p-3" style="border: 2px solid red">
                    <div>
                        <h1>Add New Stage </h1>
                    </div>
                    <div class="form-group">
                        <form id="form_01">
                            <div>
                                <h4>Stage information </h4>
                            </div>
                            <table class="table">
                                <tr>
                                    <th width="10%">Project ID</th>
                                    <td class="w-25"><input type="text" id="pro_id" placeholder="Project ID" class="form-control" disabled></td>
                                    <th width="15%">Project Name</th>
                                    <td class="w-75"><input type="text" id="pro_name" placeholder="Project Name" class="form-control"></td>
                                </tr>
                            </table>
                        </form>
                        <form id="form_02">
                            <!-- ===============================================  model form start  ======================================================== -->
                            <div class="border rounded p-1">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="5%">Stage Name</th>
                                        <td class="w-75"><input id="stage_name" type="text" class="form-control" placeholder="Stage Name"></td>
                                        <th width="10%">Approximate Budget</th>
                                        <td class="w-25"><input id="approx_budget" type="text" class="form-control" placeholder="Approximate Budget" disabled></td>
                                    </tr>
                                    <th>Description</th>
                                    <tr>

                                        <td colspan="4">
                                            <textarea id="desc" type="text" class="form-control" placeholder="Description"></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <div class="border rounded">
                                    <table class="table table-borderless" id="item_table">
                                        <tr>
                                        <tr>
                                            <th>Item ID</th>
                                            <th>Item Name</th>
                                            <th>Unit Of Measure</th>
                                            <th>Unit Cost</th>
                                            <th>Quantity</th>
                                            </th>
                                            <th>Total Amount</th>

                                        </tr>
                                        <td><input id="item_id" type="text" class="form-control" placeholder="Item ID" disabled></td>
                                        <td><input id="item_name" type="text" class="form-control" placeholder="Item Name"></td>
                                        <td><input id="uom" type="text" class="form-control" placeholder="UoM" disabled></td>
                                        <td><input id="unit_cost" name="sumField" type="text" class="form-control" placeholder="Unit Cost"></td>
                                        <td><input id="qty" type="text" name="sumField" class="form-control" placeholder="Qty"></td>
                                        <td><input id="total_amount" type="text" class="form-control" placeholder="Total Amount" disabled></td>
                                        <td><input id="add_items" type="button" class="btn btn-outline-success" value="+"></td>
                                        </tr>
                                    </table>
                                    <table id="dynamic_item_table" class="table border-bottom border-top">
                                    </table>
                                </div>
                                <button id="submit" type="button" class="btn btn-success mt-2 mb-2">Submit</button>
                            </div>
                            <!-- ===============================================  model form end  ======================================================== -->
                        </form>
                        <div id="container" class="border rounded p-1">
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">

                    </div>
                </footer>
            </div>
        </div>
        <script src="searchController.js"></script>
        <script src="fieldCentraler.js"></script>
        <!--   Core JS Files   -->
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


<?php include 'mainFooter.php'; ?>