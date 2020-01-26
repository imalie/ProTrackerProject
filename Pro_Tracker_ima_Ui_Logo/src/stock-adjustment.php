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
                        <a class="nav-link" href="./stock-adjustment.php">
                            <i class="material-icons">
                                dns
                            </i>
                            <p>Stock Adjustment</p>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="main-panel">
            
            <div class="content">
                <div class="container-fluid">
                <h2>Stock Adjustment</h2> 
        <?php
        include '../controllers/config.inc.php';
            $itemCount = 0;
            $dbQueryStages = "SELECT stages.stage_id,stages.pro_id,project.pro_name,stages.stage_name FROM stages JOIN project ON stages.pro_id = project.id WHERE stages.pro_id = '".$_GET['id']."';";
            if ($resultStage = mysqli_query($conn, $dbQueryStages)) {
                if (mysqli_num_rows($resultStage) > 0) {
                    while ($rowStage = mysqli_fetch_assoc($resultStage)) {
                        echo '<div class="border rounded mt-2">
                                        <table class="table table-borderless">
                                        <tr><td>Stage Name: ' . $rowStage['stage_name'] . '</td></tr>';

                        $dbQueryStagesItem = "SELECT stages_item.id,stages_item.item_id,product.product_name,stages_item.qty FROM stages_item JOIN product ON stages_item.item_id = product.id WHERE stages_item.stage_id = '" . $rowStage['stage_id'] . "';";
                        if ($resultStageItem = mysqli_query($conn, $dbQueryStagesItem)) {
                            if (mysqli_num_rows($resultStageItem) > 0) {
                                while ($rowStageItem = mysqli_fetch_assoc($resultStageItem)) {
                                    $itemCount++;
                                    echo '</table></div><div class="border rounded">
                                                    <table class="table table-borderless" id="item_table">
                                                    <tr>
                                                    <tr>
                                                    <th>Item ID</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Add Quantity</th>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                    <td class="d-none"><input type="number" id="stage_item_' . $itemCount . '" value="' . $rowStageItem['id'] . '"></td>                                       
                                                    <td><input type="number" value="' . $rowStageItem['item_id'] . '" class="form-control" disabled></td>
                                                    <td><input type="text" value="' . $rowStageItem['product_name'] . '" class="form-control" disabled></td>
                                                    <td><input type="number" id="qty_' . $itemCount . '" value="' . $rowStageItem['qty'] . '" class="form-control" disabled></td>
                                                    <td><input type="number" id="add_qty_' . $itemCount . '" class="form-control" placeholder="Add qty"></td>
                                                    </tr>';
                                }
                            } else {
                                echo 'no result! ';
                            }
                        }
                        echo '</table></div>';
                    }
                }
            }
            ?>
            <button id="update" class="btn btn-success mt-2 float-right">Update</button>
            <p id="item_count" class="d-none"><?php echo $itemCount; ?></p>
        </div>
        <script>
            $(document).ready(function() {
                $('#update').click(function() {
                    var itemCount = parseInt($('#item_count').text());
                    var validate = false;

                    for (var y = 1; y <= itemCount; y++) {
                        var qty = parseInt($('#qty_' + y + '').val());
                        var ads_qty = parseInt($('#add_qty_' + y + '').val());

                        if (qty < ads_qty) {
                            addClassWarning('add_qty_' + y + '');
                            validate = false;
                        } else {
                            validate = true;
                        }
                    }

                    if (validate) {
                        var dataset = [];
                        for (var i = 1; i <= itemCount; i++) {
                            var ads_qty_tmp = parseInt($('#add_qty_' + i + '').val());
                            if (isNaN(ads_qty_tmp)) {
                                ads_qty_tmp = 0;
                            }
                            var set = {
                                'id': parseInt($('#stage_item_' + i + '').val()),
                                'ads_qty': ads_qty_tmp
                            };
                            dataset.push(set);
                        }
                        console.log(dataset);

                        $.ajax({
                            url: "stock-add.php",
                            type: "post",
                            async: false,
                            data: {
                                'dataset': dataset
                            },
                            success: function(data) {
                                var ttt = JSON.parse(data);
                                if (ttt['state'].includes("OK")) {
                                    alert('update success');
                                } else {
                                    alert('error');
                                }
                            }
                        });
                    }
                });

                function addClassWarning(id) {
                    $('#' + id + '').addClass("border-danger");
                }
            });
        </script>
        <?php include 'mainFooter.php'; ?>