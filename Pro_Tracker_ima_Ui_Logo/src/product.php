<?php
session_start();
include_once '../controllers/config.inc.php';

$validateError = array();
$SubmitStatus = array();

if (isset($_POST['submit'])){
    if (empty($_POST['product_name'])){
        $validateError['product_name'] = "product name is empty";
    } else {
        $productName = $_POST['product_name'];
    }

    $productDesc = $_POST['product_desc'];

    if (empty($_POST['uom_code'])){
        $validateError['uom_code'] = "UOM code is empty";
    } else {
        $uomCode = $_POST['uom_code'];
    }

    if (empty($_POST['unit_cost'])){
        $validateError['unit_cost'] = "Unit code is empty";
    } else {
        if (is_numeric($_POST['unit_cost'])){
            $unitCost = $_POST['unit_cost'];
        } else { $validateError['unit_cost'] = "Enter numbers only"; }
    }

    if (empty($_POST['product_type'])){
        $validateError['product_type'] = "product_type is empty";
    } else {
        $productType = $_POST['product_type'];
    }

    if (0 === count($validateError)){
        $dbQuery = "INSERT INTO product(product_name, product_desc, uom_code, unit_cost, product_type, release_user) 
                    VALUES ('".$productName."','".$productDesc."','".$uomCode."','".$unitCost."','".$productType."','".$_SESSION['userID']."');";

        if (mysqli_query($conn, $dbQuery)){
            $SubmitStatus['dbStatus'] = "Submit success";
        }else {
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
        <div class="sidebar" data-color="green" style="margin-top: 80px;" data-background-color="green" data-image="../assets/img/sidebar-1.jpg">
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
                    <?php
                    //include_once '../controllers/config.inc.php';
                    ?>
                    <div class="container">

            <div class="col-lg-12 col-md-6 col-sm-6">
              <div class="card card-stats" style="padding-left : 20px ; padding-right : 20px">
                   <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">description</i>
                  </div>

                  <h3 class="card-title"> Product Creation
                  </h3>
                </div>
                       
                        <form class="form-group" method="post">

                     <div style="padding-top : 20px ; padding-bottom : 10px">
                        <h4>Add Product </h4>
                    </div>
                    <div>
                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <label>Enter unit Of Measure :</label>
                                                <input type="text"  class="form-control"name="product_name" placeholder="Product name" required>
                                        </div>
                        </div>
                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <label>Enter  Product Description:</label>
                                                <textarea required="required"  name="product_desc" class="form-control"
                                                placeholder="Enter product Description in detail"></textarea>
                                        </div>
                        </div>
                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <label>Enter  Unit Of Measure code:</label>
                                                <input type="text" class="form-control" id="uom" name="uom_code" placeholder="uom" 
                                                autocomplete="off" class="ui-autocomplete-input">
                                        </div>
                        </div>
                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <label>Enter  Unit Cost:</label>
                                                <input type="text"  class="form-control" name="unit_cost" placeholder="unit cost"required>
                        </div>

                        <div class="form-row">
                       
                                <div class="form-group col-md-6">
                                <label>Select Product Type:</label>
                                </div>
                                <!--<div class="form-group col-md-3">
                                <select name="allow_decimal" class="custom-select mb-3">
                                <option value="1">Allow</option>
                                <option value="0">Not Allow</option>
                                </select>
                                                                    
                                </div>-->
                                <div class="form-group col-md-6">
                                <select name="product_type" class="custom-select mb-3">
                                    <option value="goods">Goods</option>
                                     <option value="service">Service</option>
                                </select>
                                                                    
                                </div>
                        </div>
                    </div>
                    <div class="">
                                <button type="submit" name="submit" value="submit" class="btn btn-success">Create product</button>
                 </div>
                
            </form>
            </div>
            </div>
 
    <div>
<?php
if (!(0 === count($validateError))){
    foreach ($validateError as $error){
        showSubmitValidationMsg("Warning",$error);
    }
}
if (!(0 === count($SubmitStatus))){
    foreach ($SubmitStatus as $status){
        showSubmitValidationMsg("Status",$status);
    }
}
function showSubmitValidationMsg($validationHeader, $validationBody) {
    echo '<div class="">
            <span class="">'.$validationHeader.':&nbsp;</span>
            <span class="">&nbsp;'.$validationBody.'</span>
          </div>';
}
?>
<table class="table table-hover table-striped table-responsive-sm" >
                        <thead class="thead-dark ">
    <tr class="">
        <th class="">ID</th>
        <th class="">Product Name</th>
        <th class="">Product Desc</th>
        <th class="">UOM</th>
        <th class="">Unit Cost</th>
        <th class="">product Type</th>
        <th class="">Release User</th>
        <th class="">Release Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $dbQuerySelect = "SELECT product.id,product.product_name,product.product_desc,product.product_type,product.uom_code,product.unit_cost,product.release_date,users.email
                        FROM product JOIN users ON product.release_user = users.id;";
    if ($result = mysqli_query($conn, $dbQuerySelect)){
        if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){

                echo '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['product_name'].'</td>
                        <td>'.$row['product_desc'].'</td>
                        <td>'.$row['uom_code'].'</td>
                        <td>'.$row['unit_cost'].'</td>
                        <td>'.$row['product_type'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['release_date'].'</td>
                      </tr>';
            }
        }else {
            echo '
                  <tr>
                    <td style="color: #ff0000">0 result</td>
                  </tr>';
        }
    }
    mysqli_close($conn);
    ?>
    <script>
    $(document).ready(function() {
        $("#uom").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "search-uom.php",
                    type: "POST",
                    data: request,
                    dataType: 'json',
                    success: function (data) {
                        response($.map(data, function (el) {
                            return {
                                label: el.label,
                                value: el.value
                            };
                        }));
                    }
                });
            }
        });
    });
    </script>
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
        <footer class="footer">
                    <div class="container-fluid">
                            <?php include('mainFooter.php') ?>
                    </div>
        </footer>
        
    </body>
</html>
