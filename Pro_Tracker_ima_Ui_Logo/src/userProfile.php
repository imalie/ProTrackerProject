<?php
session_start();

include_once '../controllers/config.inc.php';

$validateError = array();
$SubmitStatus = array();
//define error and uploaded status variable
$imgUploadedError = array();
$imgUploadStatus = array();

if (isset($_POST['update'])) {
    // first name validation
    if (empty($_POST['firstName'])) {
        $validateError['firstName'] = "first name is empty";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['firstName'])) {
            $validateError['firstName'] = "Use the letter for first name";
        }
    }
    // last name validation
    if (empty($_POST['lastName'])) {
        $validateError['lastName'] = "first name is empty";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['lastName'])) {
            $validateError['lastName'] = "Use the letter for first name";
        }
    }
    // address validation
    if (empty($_POST['address'])) {
        $validateError['address'] = "address is empty";
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

    if (!($_FILES['fileToUpload']['name'] == null)) {
        $target_dir = "../doc/img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $imageNewName = uniqid('', true) . "." . $imageFileType;
        $target_Direction = $target_dir . $imageNewName;
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $imgUploadedError['uploadError1'] = "File is not an image.";
            echo "";
            $uploadOk = 0;
        }


        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5242880) {
            $imgUploadedError['uploadError2'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $imgUploadedError['uploadError3'] = "Can not upload format of this image";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $imgUploadedError['uploadError4'] = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_Direction)) {
                global $imgUploadStatus;
                $imgUploadStatus['uploadStatus'] = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                //update current image name
                $_SESSION['userImage'] = $target_Direction;
                //image name send to database
                updateImg($conn, $target_Direction);
            } else {
                $imgUploadedError['uploadError6'] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (0 === count($validateError)) {
        // pass tha data to function
        updateUserInfo($conn, $_POST['firstName'], $_POST['lastName'], $_POST['address'], $_POST['telNo'], $_POST['nic']);
    }
}
if (isset($_POST['updatePrivacy'])) {
    // password validation
    if (!empty($_POST['oldPassword'])) {
        $oldPassword = md5($_POST['oldPassword']);
        if (check_old_pass($conn, $oldPassword) == true) {
            if (empty($_POST['newPassword'])) {
                $validateError['newPassword'] = "New password is empty";
            } else {
                if ($_POST['newPassword'] != $_POST['confirmNewPass']) {
                    $validateError['newPassword'] = "confirm password";
                } else {
                    $newPassword = md5($_POST['newPassword']);
                }
            }
        } else {
            $validateError['oldPassword'] = "old password incorrect";
        }
    } else {
        $validateError['oldPassword'] = "old password is empty";
    }

    if (0 === count($validateError)) {
        // pass tha data to function
        updatePrivacy($conn, $newPassword);
    }
}

// define variable and set value
$id = $firstName = $lastName = $address = $telNo = $nic = $email = '';
// run the function for get user info
getUserInfo($conn);
// define function for fet user info form db
function getUserInfo($conn)
{

    global $id, $firstName, $lastName, $address, $telNo, $nic, $email;
    //define db query
    $dbSelectQuery = "SELECT * FROM `users` WHERE `id`=" . $_SESSION['userID'] . ";";
    //get the result from db
    if ($dbResult = mysqli_query($conn, $dbSelectQuery)) {
        $row = mysqli_fetch_assoc($dbResult);
        //define variable and set value
        $id = $row['id'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $address = $row['address'];
        $telNo = $row['tel_no'];
        $nic = $row['nic'];
        $email = $row['email'];
    }
}

//define update database function for user image
function updateImg($conn, $imageNewName)
{
    //define db query
    $dbImgUpdateQuery = "UPDATE users SET user_img='" . $imageNewName . "' WHERE `id`=" . $_SESSION['userID'] . ";";
    if (mysqli_query($conn, $dbImgUpdateQuery)) {
        global $imgUploadStatus;
        $imgUploadStatus['dbStatus'] = "Upload success to database";
    } else {
        global $imgUploadedError;
        $imgUploadedError['dbError'] = "Upload error image to database";
    }
}
// define update database function for user info
function updateUserInfo($conn, $firstName, $lastName, $address, $telNo, $nic)
{
    // define db query
    $dbQuery = "UPDATE users SET first_name='" . $firstName . "',last_name='" . $lastName . "',address='" . $address . "',tel_no='" . $telNo . "',nic='" . $nic . "' WHERE `id`=" . $_SESSION['userID'] . ";";
    if (mysqli_query($conn, $dbQuery)) {
        global $SubmitStatus;
        $SubmitStatus['dbStatus'] = "User info update success";
    } else {
        global $validateError;
        $validateError['dbError'] = "User Info Update error";
    }
}
// define update database function for user info
function updatePrivacy($conn, $newPassword)
{
    // define db query
    $dbQuery = "UPDATE users SET password = '" . $newPassword . "' WHERE `id`='" . $_SESSION['userID'] . "';";
    if (mysqli_query($conn, $dbQuery)) {
        global $SubmitStatus;
        $SubmitStatus['dbStatus'] = "User privacy update success";
    } else {
        global $validateError;
        $validateError['dbError'] = "User Info Update error";
    }
}
// check old password
function check_old_pass($conn, $oldPassword)
{
    // define query variable and set the db query
    $dbQuery = "SELECT email FROM `users` WHERE id = '" . $_SESSION['userID'] . "' AND password = '" . $oldPassword . "';";
    // get the result from db
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
    <!-- <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /> -->
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <style>
        .profile-img {
            text-align: center;
        }

        .profile-img img {
            width: 70%;
            height: 100%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="green" style="margin-top: 80px;" data-background-color="green" data-image="../assets/img/sidebar-1.jpg">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="./dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item active-pro ">
                        <a class="nav-link" href="./upgrade.html">
                            <i class="material-icons">unarchive</i>
                            <p>Upgrade by Pro Tracker 1.0</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <?php include('mainHead.php')
            ?>
            <div class="content">
                <div class="container-fluid">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="profile-img">
                                    <img id="blah" src=<?php echo $_SESSION['userImage'] ?> alt="..." width="70%" />
                                    <label for="file-upload" class="file btn btn-lg btn-primary">
                                        Change Photo
                                    </label>
                                    <input id="file-upload" style="display: none" name="fileToUpload" onchange="readURL(this);" type="file" />
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <h4><u>User Informations</u></h4>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <label>First Name</label> <?php if (isset($validateError['firstName'])) {
                                                                        echo '<label class="text-danger">  ' . $validateError['firstName'] . '</label>';
                                                                    } ?>
                                        <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <label>Last Name</label><?php if (isset($validateError['lastName'])) {
                                                                    echo '<label class="text-danger">  ' . $validateError['lastName'] . '</label>';
                                                                } ?>
                                        <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <label>Address:</label><?php if (isset($validateError['address'])) {
                                                                    echo '<label class="text-danger">  ' . $validateError['address'] . '</label>';
                                                                } ?>
                                        <textarea required="required" name="address" class="form-control"><?php echo $address; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <label>Contact No:</label><?php if (isset($validateError['telNo'])) {
                                                                        echo '<label class="text-danger">  ' . $validateError['telNo'] . '</label>';
                                                                    } ?>
                                        <input class="form-control" type="tel" name="telNo" value="<?php echo $telNo; ?>">
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <label>NIC:</label><?php if (isset($validateError['nic'])) {
                                                                echo '<label class="text-danger">  ' . $validateError['nic'] . '</label>';
                                                            } ?>
                                        <input class="form-control" type="text" name="nic" value="<?php echo $nic; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <label>Email:</label>
                                        <input class="form-control" type="text" name="email" value="<?php echo $email; ?>" disabled>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <button class="btn btn-success" style="margin-top: 24px; float: right;" name="update" value="Update">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br />
                    <form method="post" enctype="multipart/form-data">
                        <h4><u>Privacy Informations</u></h4>
                        <div class="row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <label>Old password:</label><?php if (isset($validateError['oldPassword'])) {
                                                                echo '<label class="text-danger">  ' . $validateError['oldPassword'] . '</label>';
                                                            } ?>
                                <input class="form-control" type="password" name="oldPassword" value="">
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <label>New password:</label><?php if (isset($validateError['newPassword'])) {
                                                                echo '<label class="text-danger">  ' . $validateError['newPassword'] . '</label>';
                                                            } ?>
                                <input class="form-control" type="password" name="newPassword" value="">
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <label>Confirm password:</label><?php if (isset($validateError['confirmNewPass'])) {
                                                                    echo '<label class="text-danger">  ' . $validateError['confirmNewPass'] . '</label>';
                                                                } ?>
                                <input class="form-control" type="password" name="confirmNewPass" value="">
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <button class="btn btn-success" style="margin-top: 24px;" name="updatePrivacy" value="updatePrivacy">Change Password</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    if (isset($SubmitStatus['dbStatus'])) {
                        echo '<div class=""> <span class="text-success">Update Successful !</span> </div>';
                    }
                    ?>
                </div>
            </div>

            <footer class="footer">
                <?php include('mainFooter.php') ?>
            </footer>
        </div>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width('70%');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
</body>

</html>