<?php
session_start();
include 'mainHead.php';
include_once '../controllers/config.inc.php';

$validateError = array();
$SubmitStatus = array();

if (isset($_POST['submit'])) {
    if (empty($_POST['pro_owner_id'])) {
        $validateError['pro_owner_id'] = "Pro owner Name is empty";
    } else {
        $proOwnerId = $_POST['pro_owner_id'];
    }

    if (empty($_POST['pro_name'])) {
        $validateError['pro_name'] = "Pro Name is empty";
    } else {
        if (check_duplicate_proname($conn, $_POST['pro_name']) == false) {
            $validateError['pro_name'] = "Use the anther project name";
        } else {
            $proName = $_POST['pro_name'];
        }
    }

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
    } else {
        $validateError['planDocError1'] = "Select plan document";
    }

    if (!($_FILES['boq_doc']['name'] == null)) {
        $fileBoqExt = explode('.', $_FILES['boq_doc']['name']);
        $fileBoqActualExt = strtolower(end($fileBoqExt));
        $boqAllowed = array('xlsm');
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
            if (move_uploaded_file($_FILES['boq_doc']['tmp_name'], $fileBoqDestination)) {
                $SubmitStatus['boqDocStatus'] = "Upload success to system";
            } else {
                $validateError['boqDocError4'] = "boq file upload error";
            }
        }
        $boqDocName = $fileBoqNewName;
    } else {
        $validateError['boqDocError1'] = "Select boq document";
    }

    if (0 === count($validateError)) {
        $dbQuery = "INSERT INTO project(pro_owner_id,pro_name,address,approx_budget,start_date,end_date,plan_doc,release_user)
                    VALUES ('".$proOwnerId."','".$proName."','".$address."','".$approxBudget."','" . $startDate . "','" . $endDate . "','" . $planDocName . "','" . $_SESSION['userID'] . "');";

        $dbQueryImg = "INSERT INTO boq_doc (pro_id, doc_name, release_user) VALUES ((SELECT id FROM project WHERE pro_name='".$proName."'),'".$boqDocName."','".$_SESSION['userID']."');";

        if (mysqli_query($conn, $dbQuery) && mysqli_query($conn, $dbQueryImg)) {
            $SubmitStatus['dbStatus'] = "Submit success";
        } else {
            $SubmitStatus['dbError'] = "Update error to database";
        }

        mysqli_close($conn);
    }
}
// check duplicate email function
function check_duplicate_proname($conn, $proName)
{
    //define query variable and set the db query
    $dbQuery = "SELECT pro_name FROM `project` WHERE pro_name = '" . $proName . "';";
    //get the result from db
    $dbResult = mysqli_query($conn, $dbQuery);
    if ($dbResult && mysqli_num_rows($dbResult) == 1) {
        return false;
    } else {
        return true;
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
                <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
                <script type="text/javascript" src="../res/ad/jquery-ui.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
                <link rel="stylesheet" type="text/css" href="../res/ad/jquery-ui.css" />
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
                <div class="col-lg-12 col-md-6 col-sm-6">
              <div class="card card-stats">
                   <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">description</i>
                  </div>

                  <h3 class="card-title"> Project Information
                  </h3>
                </div>

            
                <div class="card-header card-header-warning card-header-icon">
                  


<br>
<br>



                    <form class="form-group" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Project Name:</label><?php if (isset($validateError['pro_name'])) {
                                                            echo '<label class="text-danger">  ' . $validateError['pro_name'] . '</label>';
                                                        } ?>
                            <input type="text" class="form-control" name="pro_name" placeholder="Enter Project Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Project Owner Name:</label><?php if (isset($validateError['pro_owner_id'])) {
                                                                    echo '<label class="text-danger">  ' . $validateError['pro_owner_id'] . '</label>';
                                                                } ?>
                            <input type="text" class="form-control d-none" id="pro_owner_id" name="pro_owner_id" value="">
                            <input type="text" class="form-control" id="pro_owner" placeholder="Enter project owner">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Address:</label><?php if (isset($validateError['address'])) {
                                                        echo '<label class="text-danger">  ' . $validateError['address'] . '</label>';
                                                    } ?>
                            <textarea required="required" class="form-control" name="address" placeholder="Ex:1234 Main St"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Approximated Budget</label><?php if (isset($validateError['approx_budget'])) {
                                                                    echo '<label class="text-danger">  ' . $validateError['approx_budget'] . '</label>';
                                                                } ?>
                            <div class="input-group-append">
                                <span class="input-group-text">LKR</span>
                                <input type="number" class="form-control" name="approx_budget" placeholder="Enter Approximated Budget" required>
                                <!--<span class="input-group-text">0.00</span>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Start Date :</label><?php if (isset($validateError['start_date'])) {
                                                            echo '<label class="text-danger">  ' . $validateError['start_date'] . '</label>';
                                                        } ?>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>End Date:</label><?php if (isset($validateError['end_date'])) {
                                                        echo '<label class="text-danger">  ' . $validateError['end_date'] . '</label>';
                                                    } ?>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Plan Document:</label><?php if (isset($validateError['planDocError1'])) {
                                                                echo '<label class="text-danger">  ' . $validateError['planDocError1'] . '</label>';
                                                            } ?>
                            <div class="custom-file">
                                <input type="file" name="plan_doc">
<!--                                <label for="file-upload" class="file btn btn-sm btn-primary">-->
<!--                                        Choose File-->
<!--                                    </label>-->
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>BOQ Document:</label><?php if (isset($validateError['boqDocError1'])) {
                                                            echo '<label class="text-danger">  ' . $validateError['boqDocError1'] . '</label>';
                                                        } ?>
                            <div class="custom-file">
                                <input type="file" name="boq_doc">
<!--                                <label for="file-upload" class="file btn btn-sm btn-primary">-->
<!--                                         Choose File-->
<!--                                    </label>-->
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <label>Project State:</label>
                        
                    </div>
                    <div class="form-row">
                        <button type="submit" name="submit" value="submit" class="btn btn-success">Create Project</button>
                    </div>

                    <?php
                    if (isset($SubmitStatus['dbStatus'])) {
                        echo '<div class="">
                                <span class="text-success">upload success</span>
                             </div>';
                    }
                    ?>
            </form>
        </div>
        <script>
            $(document).ready(function() {
                $('#pro_owner').autocomplete({
                    source: function(request, response) {
                        console.log(request);
                        $.ajax({
                            url: "project-search.php",
                            type: "POST",
                            data: {
                                pro_name: request['term']
                            },
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                response($.map(data, function(el) {
                                    return {
                                        id: el.id,
                                        label: el.value
                                    };
                                }));
                            }
                        });
                    },
                    select: function(event, ui) {
                        $('#pro_owner_id').val(ui.item.id);
                    }
                });
            });
        </script>
          <footer class="footer">
                    <!-- <div class="container-fluid">
                        <?php include('mainFooter.php') ?>
                    </div> -->
        </footer>
</body>
</html>



