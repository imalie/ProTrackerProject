<?php
session_start();
include_once '../controllers/config.inc.php';

$validateError = array();
$SubmitStatus = array();

if (isset($_POST['submit'])) {
    $defaultImagePath = "../doc/img/defaultImg.png";
    // first name validation
    if (empty($_POST['firstName'])) {
        $validateError['firstName'] = "first name is empty";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['firstName'])) {
            $validateError['firstName'] = "Use the letter for first name";
        } else {
            $firstName = $_POST['firstName'];
        }
    }
    // last name validation
    if (empty($_POST['lastName'])) {
        $validateError['lastName'] = "first name is empty";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['lastName'])) {
            $validateError['lastName'] = "Use the letter for first name";
        } else {
            $lastName = $_POST['lastName'];
        }
    }
    // address validation
    if (empty($_POST['address'])) {
        $validateError['address'] = "address is empty";
    } else {
        $address = $_POST['address'];
    }
    // Telephone validation
    if (empty($_POST['telNo'])) {
        $validateError['telNo'] = "telNo is empty";
    } else {
        if (preg_match('/^\+\d(\d{3})(\d{3})(\d{4})$/', $_POST['telNo'], $result)) {
            $telNo = $_POST['telNo'];
        } else {
            $validateError['telNo'] = "telNo is invalid";
        }
    }
    // nic validation
    if (empty($_POST['nic'])) {
        $validateError['nic'] = "nic is empty";
    } else {
        if (check_duplicate_nic($conn,$_POST['nic']) == true) {
            $validateError['nic'] = "duplicate nic";
        } else {
            $nic = $_POST['nic'];
            if (strlen($nic) == 10) {
                for ($i = 0; $i < strlen($nic); $i++) {
                    if ($i == 9) {
                        if (substr($nic, $i, 1) != 'V') {
                            $validateError['nic'] = "nic is invalid";
                            break;
                        }
                    } else {
                        if (!is_numeric(substr($nic, $i, 1))) {
                            $validateError['nic'] = "nic is invalid";
                            break;
                        }
                    }
                }
            } else {
                $validateError['nic'] = "Oops!, Your ID card is not in 10 digits.";
            }
        }
    }
    // user type validation
    if (empty($_POST['userType'])) {
        $validateError['userType'] = "userType is empty";
    } else {
        $userType = $_POST['userType'];
    }
    // email validation
    if (empty($_POST["email"])) {
        $validateError['email'] = "Enter user email";
    } else {
        // check if e-mail address is well-formed
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $validateError['email'] = "Email is invalid";
        } else {
            // check if email duplicate
            if (check_duplicate_email($conn, $_POST['email']) == false) {
                $validateError['email'] = "Duplicate email";
            } else {
                $email = $_POST['email'];
            }
        }
    }
    // password validation
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];
    if (empty($password)) {
        $validateError['password'] = "password is empty";
    } else {
        if (empty($confirmPass)) {
            $validateError['confirmPass'] = "confirmPass is empty";
        } else {
            if (strlen($password) <= 8) {
                $validateError['password'] = "Your Password Must Contain At Least 8 Characters!";
            } elseif(!preg_match("#[0-9]+#",$password)) {
                $validateError['password'] = "Your Password Must Contain At Least 1 Number!";
            } elseif(!preg_match("#[A-Z]+#",$password)) {
                $validateError['password'] = "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif(!preg_match("#[a-z]+#",$password)) {
                $validateError['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
            } elseif($password != $confirmPass) {
                $validateError['confirmPass'] = "password confirm error";
            } elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
                $validateError['password'] = "Your Password Must Contain At Least 1 Special Character !";
            } else {
                $password = md5($password); // A1234567c
            }
        }
    }
    // check if any error
    if (0 === count($validateError)) {
        $dbQuery = "INSERT INTO users(first_name,last_name,address,tel_no,nic,email,password,user_type,user_img,release_user) 
                    VALUES ('" . $firstName . "','" . $lastName . "','" . $address . "','" . $telNo . "','" . $nic . "','" . $email . "','" . $password . "','" . $userType . "','" . $defaultImagePath . "','" . $_SESSION['userEmail'] . "');";

        if (mysqli_query($conn, $dbQuery)) {
            $SubmitStatus['dbStatus'] = "Submit success";
        } else {
            $SubmitStatus['dbError'] = "Update error to database";
        }
        //close the db connection
        mysqli_close($conn);
    }
}

// check duplicate email function
function check_duplicate_email($conn, $email)
{
    //define query variable and set the db query
    $dbQuery = "SELECT email FROM `users` WHERE email = '" . $email . "' UNION SELECT email FROM `customer` WHERE email = '" . $email . "';";
    //get the result from db
    $dbResult = mysqli_query($conn, $dbQuery);
    if ($dbResult && mysqli_num_rows($dbResult) == 1) {
        return false;
    } else {
        return true;
    }
}

function check_duplicate_nic($conn, $nic)
{
    //define query variable and set the db query
    $dbQuery = "SELECT nic FROM users WHERE nic = '" . $nic . "';";
    //get the result from db
    $dbResult = mysqli_query($conn, $dbQuery);
    if ($dbResult && mysqli_num_rows($dbResult) == 1) {
        return true;
    } else {
        return false;
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
                        <a class="nav-link" href="./userAdd.php">
                            <i class="material-icons">person</i>
                            <p>User Creation</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./userReport.php">
                            <i class="material-icons">content_paste</i>
                            <p>User Report</p>
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
                    <h3><u>Add New User</u></h3>
                    <form class="form-group" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>First Name:</label>
                                <input type="text" class="form-control" name="firstName" maxlength="30" required>
                                <?php if (isset($validateError['firstName'])) {
                                                                echo '<span style="color:red">  ' . $validateError['firstName'] . '</span>';
                                                            } ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name:</label>
                                <input type="text" class="form-control" name="lastName" maxlength="30" required>
                                <?php if (isset($validateError['lastName'])) {
                                                                echo '<span style="color:red">  ' . $validateError['lastName'] . '</span>';
                                                            } ?>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Address:</label>
                                <textarea required="required" class="form-control" name="address"></textarea>
                                <?php if (isset($validateError['address'])) {
                                                            echo '<span style="color:red">  ' . $validateError['address'] . '</span>';
                                                        } ?>
                               
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Contact No:</label>
                                <input type="tel" class="form-control" name="telNo" required>
                                <?php if (isset($validateError['telNo'])) {
                                                                echo '<span style="color:red">  ' . $validateError['telNo'] . '</span>';
                                                            } ?>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label>NIC: </label>
                                <input type="text" class="form-control" name="nic" required>
                                <?php if (isset($validateError['nic'])) {
                                                        echo '<span style="color:red">  ' . $validateError['nic'] . '</span>';
                                                    } ?></label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6" class="alert alert-primary" role="alert">
                                <label>Email:</label>
                               
                                    <input type="email" class="form-control" name="email" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <?php if (isset($validateError['email'])) {
                                                            echo '<span style="color:red">  ' . $validateError['email'] . '</span>';
                                                        } ?>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>password:</label>
                                <input type="password" class="form-control" name="password" required>
                                <?php if (isset($validateError['password'])) {
                                                            echo '<span style="color:red">  ' . $validateError['password'] . '</span>';
                                                        } ?>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label> Confirm password:</label>
                                <input type="password" class="form-control" name="confirmPass" required>
                                <?php if (isset($validateError['confirmPass'])) {
                                                                        echo '<span style="color:red">  ' . $validateError['confirmPass'] . '</span>';
                                                                    } ?>
                                
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label> User type:</label>
                                    <div class="form-row">
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="userType" id="lineRadio_superuser" value="superuser">Super User
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="userType" id="inlineRadio_Supervisor" value="supervisor">Supervisor
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="userType" id="inlineRadio_superuser" value="employee"> Employee
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                                <?php if (isset($validateError['userType'])) {
                                                                    echo '<span class="text-danger">  ' . $validateError['userType'] . '</span>';
                                                                } ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-success float-right" name="submit" value="submit">Create User</button>
                            </div>
                        </div>

                        <?php
                        if (isset($SubmitStatus['dbStatus'])) {
                            echo '<lable class="text-success">' . $SubmitStatus['dbStatus'] . '</lable>';
                        } else if (isset($SubmitStatus['dbError'])) {
                            echo '<lable class="text-danger">' . $SubmitStatus['dbStatus'] . '</lable>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

</body>

<?php include_once 'mainFooter.php'; ?>