<?php
session_start();
include_once '../controllers/config.inc.php';

$pro_id = $_GET['id'];
$proName = $approxBudget=$is_approval= $access_trans = $water=$electricity=$space_available=$invest_comment="";

$dbqu = "SELECT investigation.invest_comment,investigation.access_trans,investigation.water,investigation.electricity,investigation.space_available,investigation.invest_comment,project.pro_name,project.approx_budget FROM investigation
                JOIN project ON investigation.pro_id = project.id WHERE investigation.pro_id = '".$pro_id."';";

if ($result = mysqli_query($conn,$dbqu)){
    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        print_r($row);
        $proName = $row['pro_name'];
        $approxBudget=$row['approx_budget'];
        $access_trans = $row['access_trans'];
        $electricity=$row['electricity'];
        $water=$row['water'];
        $space_available=$row['space_available'];
        $invest_comment=$row['invest_comment'];
        print_r($access_trans);
    }
}

$validateError = array();
$SubmitStatus = null;
$approval_status=null;
if (isset($_POST['submit'])) {
    $approval_status = $_POST['approval_status'];
    $approval_status_comment = $_POST['approval_status_comment'];

    if(empty($invest_comment)) {
        $validateError['invest_comment'] = "comment is empty";
    }

    // check if any error
    if (0 === count($validateError)) {
 $dbQuery = "UPDATE project SET is_approval= '".$app."' WHERE id = '" . $pro_id . "';";
//        if (mysqli_query($conn, $dbQuery)) {
//
//            if (mysqli_query($conn, $dbQuery)) {
//                $SubmitStatus = "  project Approved  successfully";
//            } else {
//                $SubmitStatus = "Error in Creating Investigation";
//            }
//        } else {
//            $SubmitStatus = "Update error to database";
//        }
//        //close the db connection
//        mysqli_close($conn);
//        print_r($SubmitStatus);

}

    }

//   

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

                  <h3 class="card-title">Project Approval
                  </h3>
                </div>

            
                <div class="card-header card-header-warning card-header-icon">
                  


<br>
<br>
  

                    <form class="form-group" method="get">
                    <div class="form-row">
                            <div class="form-group col-md-12">
                                <label id = "bold">Project Name:</label>
                                <br>
                                <input class="form-control" type="text" value="<?php echo $proName; ?>" placeholder="Disabled project Name..." disabled>
                                
                            </div>

                    </div>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label>Approximated Budget</label>
                                <br>
                                    <input type="text" class="form-control" name="approx_budget"  value="<?php echo $approxBudget?>"placeholder="Disabled Approximate budget" Disabled>


                                </div>
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
                                      <input class="form-check-input" type="radio" id="lineRadio_ok" <?php if ($access_trans == 1) {echo 'checked';} ?>>OK
                                      <span class="circle"  >
                                                    <span class="check"></span>
                                                </span>
                                  </label>
                              </div>
                              <div class="form-check form-check-radio form-check-inline" style="padding-left:6px">
                                  <label class="form-check-label" style="padding-left:4px">
                                      <input class="form-check-input" type="radio" id="inlineRadio_need_to_improve" <?php if ($access_trans == 0) { echo 'checked';} ?>> Need to be Improved
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
                                      <input type="checkbox" class="form-check-input" id="check1" name="electricity" value="1"<?php if ($electricity == 1) {echo 'checked';} ?>>Electricity
                                  </label>
                              </div>
                              <div class="form-check-inline">
                                  <label class="form-check-label" for="check2">
                                      <input type="checkbox" class="form-check-input" id="check2" name="water" value="1"<?php if ($water == 1) {echo 'checked';} ?>>Water
                                  </label>
                              </div>
                              <div class="form-check-inline">
                                  <label class="form-check-label" for="check2">
                                      <input type="checkbox" class="form-check-input" id="check3" name="space" value="1"<?php if ($space_available == 1) {echo 'checked';} ?>>Space Availability of Site Office
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
                        <textarea required="required" name="invest_comment"  rows="5" class="form-control" placeholder=" Investigation comment here"> <?php echo $invest_comment?></textarea>
                        <?php if (isset($validateError['invest_comment'])) {
                            echo '<span style="color:red" >  ' . $validateError['invest_comment'] . '</span>';
                        } ?>
                    </div>
                </div>
                  <div class="form-group col-md-6">
                                <label>Status:</label>
                                <div class="form-row">
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="approval" id="lineRadio_approve" value="approved"><?php if ($is_approval === "1") {
                                                echo 'checked';
                                            } ?>Approve
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio_reject" value="reject"><?php if ($is_approval === "0") {
                                                echo 'checked';
                                            } ?>Reject
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                            </div>
                        </div>
                      
                        <div class="col-md-12">
                            <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
                            <?php
                            if (isset($SubmitStatus['dbStatus'])) {
                                echo '<div class="">
                                <span class="text-success">  Updated successfully</span>
                             </div>';
                            }
                            ?>
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

</body>
</html>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap-material-design.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

