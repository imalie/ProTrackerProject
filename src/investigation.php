<?php
session_start();
include_once '../controllers/config.inc.php';
$validateError = array();
$SubmitStatus = null;


if (isset($_POST['submit'])) {

    $invest_comment = $_POST['invest_comment'];
    $pro_id = $_POST['pro_id'];
    $accessTrans = $_POST['access_trans'];
    if (isset($_POST['electricity'])) {
        $electricity = 1;
    } else { $electricity = 0; }

    if (isset($_POST['water'])) {
        $water = 1;
    } else { $water = 0; }

    if (isset($_POST['space'])) {
        $space = 1;
    } else { $space = 0; }


    if(empty($invest_comment)) {
        $validateError['invest_comment'] = "comment is empty";
    }

    // check if any error
    if (0 === count($validateError)) {

        $dbQuery = "INSERT INTO investigation(pro_id, access_trans, electricity, water, space_available,invest_comment, release_user)
                               VALUES ('".$pro_id."','".$accessTrans."','".$electricity."','".$water."','".$space."','".$invest_comment."','" . $_SESSION['userID'] . "');";

        if (mysqli_query($conn, $dbQuery)) {
            $dbQueryInvest = "UPDATE project SET is_invest= '1' WHERE id = '".$pro_id."';";
            if (mysqli_query($conn,$dbQueryInvest)) {
                $SubmitStatus = " Investigation created successfully";
            } else {$SubmitStatus = "Error in Creating Investigation";}
        } else {
            $SubmitStatus = "Update error to database";
        }
        //close the db connection
        mysqli_close($conn);
    }
}
//?>

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
    <link rel="stylesheet" type="text/css" href="../res/ad/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/mat-icons.css" />
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/demo/demo.css" rel="stylesheet" />
     <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
    <?php include('mainHead.php') ?>
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

            <div class="col-lg-12 col-md-6 col-sm-6">
              <div class="card card-stats">
                   <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>

                  <h3 class="card-title"> Project Investigation
                  </h3>
                </div>


                <div class="card-header card-header-warning card-header-icon">
                  


<br>
<br>
  

                  <?php

                        if (isset($SubmitStatus['dbStatus'])) {


                            // echo '<lable class="text-success">' . $SubmitStatus['dbStatus'] . '</lable>';

                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>' . $SubmitStatus['dbStatus'] . '</strong> 
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                    ?>

                    <?php
                        } else if (isset($SubmitStatus['dbError'])) {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>' . $SubmitStatus['dbStatus'] . '</strong> 
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                        }

                        ?>

                    <form class="form-group" method="post">
                    <div class="form-row">
                            <div class="form-group col-md-6">
                             <br>
                                <input type="text" class="form-control" id="pro_id" name="pro_id" placeholder="Project Id" readonly>
                                <label id = "bold">Project ID:</label>
                                <br>
                                
                            
                            </div>

                            <div class="form-group col-md-6"><br> <label id = "bold">Project Name:</label>

                            <input type="text" class="form-control" id="pro_name"  placeholder="Enter Project Name" autocomplete="off" required>
                                <?php if (isset($validateError['pro_name'])) {
                                                                echo '<span style="color:red">  ' . $validateError['pro_name'] . '</span>';
                                                            } ?>
                            </div>
                           
                    </div>

                        <div class="form-row" >
                                <div class="form-group col-md-3" >
                                     <label id = "bold" style="padding-left:6px"> Accessability In Transportation :</label>

                                </div>
                                <div class="form-group col-md-9">
                                    <div class="form-row col-md-12">
                                        <div class="form-check form-check-radio form-check-inline"  style="padding-left:4px">
                                            <label class="form-check-label" style="padding-left:4px">
                                                <input class="form-check-input" type="radio" name="access_trans" id="lineRadio_ok" value="1" >OK
                                                <span class="circle"  >
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline" style="padding-left:6px">
                                            <label class="form-check-label" style="padding-left:4px">
                                                <input class="form-check-input" type="radio" name="access_trans" id="inlineRadio_need_to_improve" value="0"> Need to be Improved
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                       
                                                <?php if (isset($validateError['userType'])) {
                                                                    echo '<span class="text-danger">  ' . $validateError['access_trans'] . '</span>';
                                                                } ?>
                                            
                                    </div>
                                </div>
                        </div>
                              

                         <div class="form-row">
                                <div class="form-group col-md-3">
                                     <label id = "bold" style="padding-left:6px"> Infrastructure of Area :</label>
                                     <br>
                                </div>

                                <div class="form-group col-md-9"> 
                                        <div class="form-row col-md-12">
                                            <div class="form-check-inline">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="electricity" value="1">Electricity
                                        </label>
                                        </div>
                                        <div class="form-check-inline">
                                        <label class="form-check-label" for="check2">
                                            <input type="checkbox" class="form-check-input" id="check2" name="water" value="1">Water
                                        </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label" for="check2">
                                                <input type="checkbox" class="form-check-input" id="check3" name="space" value="1">Space Availability of Site Office
                                            </label>
                                        </div>
                                       
                                </div>    
                            </div>
                         </div>

                           </div>

                                 <div class="form-row" style="padding-left:15px ; padding-right:10px">
                                    <div class="form-group col-md-12">
                                        <label id = "bold" style="padding-left:15px">Additional Comments:</label>
                                        <br>
                                        <textarea required="required" name="invest_comment"  rows="5" class="form-control" placeholder=" Investigation comment here"></textarea>
                                        <?php if (isset($validateError['invest_comment'])) {
                                                                    echo '<span style="color:red" >  ' . $validateError['invest_comment'] . '</span>';
                                                                } ?>
                                    </div>
                                </div>

                        <div class="form-row">
                        <div class="col-md-12" style="padding-left:15px ; padding-bottom : 15px">
                            <button type="submit" name="submit" value="submit" class="btn btn-success" >Create Investigation</button>
                            <?php
                            if (isset($SubmitStatus['dbStatus'])) {
                                echo '<div class="">
                                <span class="text-success"> Customer created successfully</span>
                             </div>';
                            }
                            ?>
                        </div>
                    </div>
            </div>

    </form>
</div>
<div class="card-footer">
  <div class="stats">
<footer class="footer">
                    <div class="container-fluid">
                        <?php include('mainFooter.php') ?>
                    </div>
            </footer>
</div>
</div>
<script>
    $(document).ready(function() {
        $("#pro_name").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "search_option.php",
                    type: "POST",
                    data: { project_invest: request['term'] }, // {project_name: "s"}
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        response($.map(data, function (el) {
                            return {
                                id: el.id,
                                value: el.value
                            };
                        }));
                    }

                });
            },
            select: function (event,ui) {
                $('#pro_id').val(ui.item.id);
            }
        });
    });
</script>

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap-material-design.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

</body>
</html>


<div class="modal" tabindex="-1" role="dialog" id="messege_modal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Modal title</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<p> <?php
        if (isset($SubmitStatus['dbStatus'])) {
            echo '<lable class="text-success">' . $SubmitStatus['dbStatus'] . '</lable>';
        } else if (isset($SubmitStatus['dbError'])) {
            echo '<lable class="text-danger">' . $SubmitStatus['dbStatus'] . '</lable>';
        }
        ?></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary">Save changes</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
