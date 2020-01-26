<?php
//start session
session_start();
//gather errors
$errorMsg = "";
$errorList = array();

include 'controllers/dataAccess.php';
include 'controllers/commonFunctions.php';
//load the dbms config
include 'controllers/config.inc.php';

if (isset($_POST['submit'])) {
    //check if e-mail address is empty
    if (empty($_POST["userEmail"])) {
        $errorList['emailError'] = "Enter user email";
    } else {
        // check if e-mail address is well-formed
        if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
            $errorList['emailError'] = "Email is invalid";
        }
    }
    //check if password is empty
    if (empty($_POST["userPassword"])) {
        $errorList['passwordError'] = "Enter password";
    }

    if (0 === count($errorList)) {
        $userEmail = mysqli_real_escape_string($conn, $_POST["userEmail"]);
        $userPassword = md5(mysqli_real_escape_string($conn, $_POST['userPassword']));
        //check if user e-mail and user password is valid
        
        $dbResult = loginValid($conn, $userEmail, $userPassword);

        if ($dbResult && mysqli_num_rows($dbResult) == 1) {
            $row = mysqli_fetch_assoc($dbResult);
            //set the user information to session
            if ($row['status'] === '1') {
                $_SESSION['userID'] = $row['id'];
                $_SESSION['userFirstName'] = $row['first_name'];
                $_SESSION['userEmail'] = $row['email'];
                $_SESSION['userType'] = $row['user_type'];
                if ($row['user_img'] == ""){
                    $_SESSION['userImage'] = "../doc/img/defaultImg.png";
                }else {
                    $_SESSION['userImage'] = "../doc/img/".$row['user_img'];
                }
                //redirect to system if user e-mali and password is valid
                pageRedirect("src/dashboard.php");
            } else {
                $errorList['accessError'] = "User blocked";
            }
        } else {
            //access denied
            global $errorList;
            $errorList['accessError'] = "Access denied";
        }
    }
}

if (isset($_GET['signout'])) {
    if ($_GET['signout'] == "true") {
        showValidateMsg("Login Session: ", "You are now logged out.");
    }
}
if (!(0 === count($errorList))) {
    foreach ($errorList as $error) {
        showValidateMsg("Warning: ", $error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pro Tracker| Sign in</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./res/css/bootstrap.min.css">
        <link rel="stylesheet" href="./res/css/main.css">
        <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../assets/css/mat-icons.css" />
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/demo/demo.css" rel="stylesheet" />
     <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
    <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
    <script type="text/javascript" src="../res/ad/bootstrap.js"></script>
        <style>
            body {
                background-image: url("res/images/background.jpg") !important;
                background-repeat: no-repeat;
                background-position-y: center;
            }
        </style>
    </head>
    <body>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 model-box">
                    <div class="model-box-content">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="row" style="text-align: center">
                                <label for="heading">
                                    <div class="row">
                                    <img src="res/images/logo.png" height="120px" width="250px" style="padding-bottom : 20px">
                                    <br>
                                    </div>


                                </label>
                            </div>
                            <span class="error_msg"> <?php echo $errorMsg; ?></span>
                            <div class="row">
                                <input type="email" name="userEmail" id="input" class="form-control" placeholder="Email" title="Email">
                               
                            </div>
                            <br>
                            <div class="row">
                                <input type="password" name="userPassword" id="input" class="form-control" placeholder="Password" title="Password">
                            </div>
                            <br>
                            <div class="row">
                                <button type="submit" name="submit" class="btn btn-large btn-block btn-primary">Login</button>
                            </div>
                            <br>
                            <div class="row" align = "right">
                               <a href="./forgetpassword.php" >Forgot my Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>