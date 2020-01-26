<?php
session_start();

include_once '../controllers/config.inc.php';

$validateError = array();
$SubmitStatus = array();

if (isset($_POST['update'])) {
    if (empty($_POST['address'])) {
        $validateError['address'] = "address is empty";
    } else {
        $address = $_POST['address'];
    }

    if (empty($_POST['approx_budget'])) {
        $validateError['approx_budget'] = "approx budget is empty";
    } else {
        if (is_numeric($_POST['approx_budget'])) {
            $approxBudget = $_POST['approx_budget'];
        } else {
            $validateError['approx_budget'] = "approx budget is invalid";
        }
    }

    if (empty($_POST['start_date'])) {
        $validateError['start_date'] = "start date is empty";
    } else {
        $startDate = $_POST['start_date'];
    }

    if (empty($_POST['end_date'])) {
        $validateError['end_date'] = "end date is empty";
    } else {
        $endDate = $_POST['end_date'];
    }

    if (!($_FILES['plan_doc']['name'] == null)) {
        $fileExt = explode('.', $_FILES['plan_doc']['name']);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('pdf');
        if (!(in_array($fileActualExt, $allowed))) {
            $validateError['planDocError1'] = "Can not upload format of this file";
        }
        if (!($_FILES['plan_doc']['error'] == 0)) {
            $validateError['planDocError2'] = "There are some error this file";
        }
        if ($_FILES['plan_doc']['size'] > 1000000) {
            $validateError['planDocError3'] = "File size long of this file";
        }
        if (0 === count($validateError)) {
            $fileNewName = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = '../doc/file/' . $fileNewName;
            //image upload code and update upload status
            if (move_uploaded_file($_FILES['plan_doc']['tmp_name'], $fileDestination)) {
                $SubmitStatus['planDocStatus'] = "Upload success to system";
            } else {
                $validateError['planDocError4'] = "plan file upload error";
            }
        }
        $planDocName = $fileNewName;
    }

    if (!($_FILES['boq_doc']['name'] == null)) {
        $fileBoqExt = explode('.', $_FILES['boq_doc']['name']);
        $fileBoqActualExt = strtolower(end($fileBoqExt));
        $boqAllowed = array('pdf');
        if (!(in_array($fileBoqActualExt, $boqAllowed))) {
            $validateError['boqDocError1'] = "Can not upload format of this file";
        }
        if (!($_FILES['boq_doc']['error'] == 0)) {
            $validateError['boqDocError2'] = "There are some error this file";
        }
        if ($_FILES['boq_doc']['size'] > 1000000) {
            $validateError['boqDocError3'] = "File size long of this file";
        }
        if (0 === count($validateError)) {
            $fileBoqNewName = uniqid('', true) . "." . $fileBoqActualExt;
            $fileBoqDestination = '../doc/file/' . $fileBoqNewName;
            //image upload code and update upload status
            if (move_uploaded_file($_FILES['boq_doc']['tmp_name'], $fileBoqDestination)) {
                $SubmitStatus['boqDocStatus'] = "Upload success to system";
            } else {
                $validateError['boqDocError4'] = "boq file upload error";
            }
        }
        $boqDocName = $fileBoqNewName;
    }

    if (0 === count($validateError)) {
        $dbQuery = "UPDATE `project` SET `address`=".$_POST['address'].",`approx_budget`=".$_POST['approx_budget'].",`start_date`=".$_POST['start_date'].",`end_date`=".$_POST['end_date']." WHERE id='".$_POST['update']."';";

        if (mysqli_query($conn, $dbQuery)) {
            $SubmitStatus['dbStatus'] = "Submit success";
        } else {
            $SubmitStatus['dbError'] = "Update error to database";
        }
    }

    if (!($_FILES['plan_doc']['name'] == null) && 0 === count($validateError)) {
        $dbQueryPlan = "UPDATE project SET plan_doc='".$planDocName."' WHERE id='".$_POST['update']."';";

        mysqli_query($conn, $dbQueryPlan);
    }

    if (!($_FILES['boq_doc']['name'] == null) && 0 === count($validateError)) {
        $dbQueryBoq = "INSERT INTO boq_doc(pro_id, doc_name, release_user) VALUES ('".$_POST['update']."','".$boqDocName."','".$_SESSION['userID']."');";

        mysqli_query($conn, $dbQueryBoq);
    }
}

$detail_id = $_GET['id'];
$boqDocArray = array();

$id = $proOwnerId = $proName = $address = $approxBudget = $startDate = $endDate = $planDoc = $releaseDate = $status = "";
$releaseUser = "";

getUserInfo($conn);
function getUserInfo($conn)
{
    global $detail_id, $id, $proOwnerId, $proName, $address, $approxBudget, $startDate, $endDate, $planDoc, $releaseDate, $releaseUser, $boqDocArray,$status;
    //define db query
    $dbSelectQuery = "SELECT project.id,project.pro_name,customer.first_name,customer.last_name,project.address,project.approx_budget,project.start_date,project.end_date,project.plan_doc,project.status,project.release_date,project.release_user
    FROM project JOIN customer ON project.pro_owner_id = customer.id WHERE project.id='".$detail_id."';";
    //get the result from db
    if ($dbResult = mysqli_query($conn, $dbSelectQuery)) {
        $row = mysqli_fetch_assoc($dbResult);
        $dbSelectQueryPro = "SELECT users.email FROM users WHERE users.id='".$row['release_user']."';";
        $dbResultPro = mysqli_query($conn, $dbSelectQueryPro);
        $rowPro = mysqli_fetch_assoc($dbResultPro);
        //define variable and set value
        $id = $row['id'];
        $proOwnerId = $row['first_name']." ".$row['last_name'];
        $proName = $row['pro_name'];
        $address = $row['address'];
        $approxBudget = $row['approx_budget'];
        $startDate = $row['start_date'];
        $endDate = $row['end_date'];
        $planDoc = $row['plan_doc'];
        $releaseDate = $row['release_date'];
        $releaseUser = $rowPro['email'];
        $status = $row['status'];
    }

    $dbBoqQuery = "SELECT doc_name FROM boq_doc WHERE pro_id = '".$detail_id."';";
    $rowId = 0;
    if ($dbResultBoq = mysqli_query($conn, $dbBoqQuery)) {
        if (mysqli_num_rows($dbResultBoq) > 0) {
            while ($rowBoq = mysqli_fetch_assoc($dbResultBoq)) {
                $boqDocArray[$rowId] = $rowBoq['doc_name'];
                $rowId++;
            }
        }


    }
}
?>

<!DOCTYPE html>
            

            <head>
                <meta charset="utf-8" />
                
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

<?php include('mainHead.php') ?>

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
                        <a class="nav-link" href="./projectCreate.php">
                            <i class="material-icons">
                                date_range
                            </i>
                            <p>Project Creation</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./projectList.php">
                            <i class="material-icons">
                                assignment
                            </i>
                            <p>Project Report</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            
            <div class="content">
                <div class="container-fluid">
                    <h3><u>Project Information </u></h3>

                    <div class="row">
                        <div class="col-sm-3">
                        <a class="btn btn-success" target="_blank" href="stock-adjustment.php?id=<?php echo $detail_id; ?>">Stock Adjustment</a>
                        </div>
                       <div class="col-sm-3">
                       <a class="btn btn-success" target="_blank" href="progress.php?id=<?php echo $detail_id; ?>">Go to Progress</a>
                        </div>
                        <div class="col-sm-3">
                       <a class="btn btn-success" target="_blank" href="stage-viewer.php?id=<?php echo $detail_id; ?>">Go to Stage View</a>
                        </div>



                            <div class=" col-sm-12 border rounded p-3 bg-primary"  style="width: 11rem; height: 5rem">
                            <span class="">Status</span><br>
                            <p><?php echo $status; ?></p>
                            </div>
                        
                    </div>

            <div class="row">

                    <?php
                    if( $status= "inprogress"){
                    ?>

                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <?php
                    } else

                    { echo "error";}
                    ?>






<!-- <div class="progress">
  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="progress">
  <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="progress">
  <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>
          -->           

         </div>



 <div class="col-lg-12 col-md-6 col-sm-6">
              <div class="card card-stats" >
                 
            <form class="form-group" method="post" enctype="multipart/form-data" style="padding-top : 20px ; padding-left :40px ; padding-right: 20px">
                <div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Project Name:</label>
                            <input class="form-control" type="text" value="<?php echo $proName; ?>" placeholder="Disabled project Name..." disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Project Owner Name:</label>
                            <input class="form-control" type="text" value="<?php echo $proOwnerId; ?>" placeholder="Disabled project  Owner Name..." disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Address:</label><?php if (isset($validateError['address'])) {
                                                        echo '<label class="text-danger">  ' . $validateError['address'] . '</label>';
                                                    } ?>
                            <textarea class="form-control" name="address"><?php echo $address; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Approximated Budget</label><?php if (isset($validateError['approx_budget'])) {
                                                                    echo '<label class="text-danger">  ' . $validateError['approx_budget'] . '</label>';
                                                                } ?>
                            <div class="input-group-append">
                                <span class="input-group-text">LKR</span>
                                <input type="number" class="form-control" name="approx_budget" value="<?php echo $approxBudget; ?>" required>
                                 <!--<span class="input-group-text">0.00</span>--> 
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Start Date :</label><?php if (isset($validateError['start_date'])) {
                                                            echo '<label class="text-danger">  ' . $validateError['start_date'] . '</label>';
                                                        } ?>
                            <input type="date" class="form-control" name="start_date" value="<?php echo $startDate; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>End Date:</label><?php if (isset($validateError['end_date'])) {
                                                        echo '<label class="text-danger">  ' . $validateError['end_date'] . '</label>';
                                                    } ?>
                            <input type="date" class="form-control" name="end_date" value="<?php echo $endDate; ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Plan Document:</label><?php if (isset($validateError['plan_doc'])) {
                                                                echo '<label class="text-danger">  ' . $validateError['plan_doc'] . '</label>';
                                                            } ?>
                            <div class="custom-file">
                                <input type="file" class="" name="plan_doc">
                                <label class="" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                                    <a href="../doc/file/<?php echo $planDoc; ?>">Go to Plan Document</a>
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>BOQ Document:</label><?php if (isset($validateError['boq_doc'])) {
                                                            echo '<label class="text-danger">  ' . $validateError['boq_doc'] . '</label>';
                                                        } ?>
                            <div class="custom-file">
                                <input type="file" class="" name="boq_doc">
                                <label class="" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                                    <?php
                                    if (0 != count($boqDocArray)) {
                                        for ($i = 0; $i < count($boqDocArray); $i++) {
                                            $ss = $i + 1;
                                            echo '<a href="../doc/file/'.$boqDocArray[$i].'">Go to BOQ Document '.$ss.'</a><br>';
                                        }
                                    }
                                    ?>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Release Date :</label>
                            <input type="text" class="form-control" value="<?php echo $releaseDate; ?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Release User:</label>
                            <input type="text" class="form-control" value="<?php echo $releaseUser; ?>" disabled>
                        </div>

                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success btn-lg float-right" type="submit" name="update" value="<?php echo $id; ?>">Update View</button>
                    </div>

                </div>
            </form>
            </div>
            </div>
            <?php
            if (isset($SubmitStatus['dbStatus'])) {
                echo '<div class="">
                    <span class="text-success">upload success</span>
                  </div>';
            }
            if (!(0 === count($validateError))) {
                foreach ($validateError as $error) {
                    showSubmitValidationMsg("Warning", $error);
                }
            }
            function showSubmitValidationMsg($validationHeader, $validationBody)
            {
                echo '<div class="">
                          <span class="text-danger">' . $validationHeader . ':&nbsp;</span>
                          <span class="text-danger">&nbsp;' . $validationBody . '</span>
                      </div>';
            }
            ?>
        </div>
        </body>
</html>

        <?php include 'mainFooter.php'; ?>