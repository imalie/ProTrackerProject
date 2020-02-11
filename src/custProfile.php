<?php
session_start();
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

<?php
include 'mainHead.php';
include_once '../controllers/config.inc.php';


$validateError = array();
$SubmitStatus = array();

if (isset($_POST['update'])){
    // first name validation
    if (empty($_POST['firstName'])){
        $validateError['firstName'] = "first name is empty";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['firstName'])) {
            $validateError['firstName'] = "Use the letter for first name";
        }
    }
    // last name validation
    if (empty($_POST['lastName'])){
        $validateError['lastName'] = "first name is empty";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['lastName'])) {
            $validateError['lastName'] = "Use the letter for first name";
        }
    }
    // address validation
    if (empty($_POST['address'])){
        $validateError['address'] = "address is empty";
    }
    // Telephone validation
    if (empty($_POST['telNo'])){
        $validateError['telNo'] = "telNo is empty";
    } else {
        if(preg_match('/^\+\d(\d{3})(\d{3})(\d{4})$/', $_POST['telNo'],$result)){
            $telNo = $_POST['telNo'];
        } else { $validateError['telNo'] = "telNo is invalid"; }

    }
    // occupation validation
    if (empty($_POST['occupation'])){
        $validateError['occupation'] = "occupation is empty";
    }
    // nic validation
    if (empty($_POST['nic'])){
        $validateError['nic'] = "nic is empty";
    } else {
        $nic = $_POST['nic'];
        if(strlen($nic) == 10) {
            for ($i = 0; $i < strlen($nic); $i++){
                if ($i == 9){
                    if (substr($nic,$i,1) != 'V'){ $validateError['nic'] = "nic is invalid"; break; }
                } else {
                    if (!is_numeric(substr($nic,$i,1))) { $validateError['nic'] = "nic is invalid"; break; }
                }
            }
        } else {
            $validateError['nic'] = "Oops!, Your ID card is not in 10 digits.";
        }
    }
    if (0 === count($validateError)){
        // pass tha data to function
        updateUserInfo($conn,$_POST['firstName'],$_POST['lastName'],$_POST['address'],$_POST['telNo'],$_POST['nic'],$_POST['occupation']);
    }
}
if (isset($_POST['updatePrivacy'])){
    // password validation
    if (!empty($_POST['oldPassword'])){
        $oldPassword = md5($_POST['oldPassword']);
        if (check_old_pass($conn,$oldPassword) == true) {
            if (empty($_POST['newPassword'])){
                $validateError['newPassword'] = "New password is empty";
            } else {
                if (strlen($_POST['newPassword']) <= 8) {
                    $validateError['newPassword'] = "Your Password Must Contain At Least 8 Characters!";
                } elseif(!preg_match("#[0-9]+#",$_POST['newPassword'])) {
                    $validateError['newPassword'] = "Your Password Must Contain At Least 1 Number!";
                } elseif(!preg_match("#[A-Z]+#",$_POST['newPassword'])) {
                    $validateError['newPassword'] = "Your Password Must Contain At Least 1 Capital Letter!";
                } elseif(!preg_match("#[a-z]+#",$_POST['newPassword'])) {
                    $validateError['newPassword'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
                }elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["newPassword"])) {
                    $validateError['newPassword'] = "Your Password Must Contain At Least 1 Special Character !";
                } elseif ($_POST['newPassword'] != $_POST['confirmNewPass']) {
                    $validateError['newPassword'] = "confirm password";
                }else {
                    $newPassword = md5($_POST['newPassword']);
                }
            }
        } else { $validateError['oldPassword'] = "old password incorrect"; }
    } else {$validateError['oldPassword'] = "old password is empty";}

    if (0 === count($validateError)){
        // pass tha data to function
        updatePrivacy($conn,$newPassword);
    }
}
//define error and uploaded status variable
$imgUploadedError = array();
$imgUploadStatus = array();

if (isset($_POST['profileImg'])){
    //check if uploaded image is empty
    if (!($_FILES['file']['name'] == null)){
        //split image format from image name
        $imageExt = explode('.', $_FILES['file']['name']);
        //convert image format name to lower case
        $imageActualExt = strtolower(end($imageExt));
        //define image format to allow
        $allowed = array('jpg', 'jpeg', 'png');
        //check image format
        if (!(in_array($imageActualExt, $allowed))){$imgUploadedError['uploadError2'] = "Can not upload format of this image"; }
        //check if there are image
        if (!($_FILES['file']['error'] == 0)){$imgUploadedError['uploadError3'] = "There are some error this image"; }
        //check image size
        if ($_FILES['file']['size'] > 100000){$imgUploadedError['uploadError4'] = "Image size long of this image"; }
        //check error count is 0
        if (0 === count($imgUploadedError)){
            //define image new name
            $imageNewName = uniqid('',true).".".$imageActualExt;
            //define uploaded destination
            $imageDestination = '../doc/img/'.$imageNewName;
            //image upload code and update upload status
            if(move_uploaded_file($_FILES['file']['tmp_name'], $imageDestination)){$imgUploadStatus['uploadStatus'] = "Upload success to system";}
            //update current image name
            $_SESSION['userImage'] = $imageNewName;
            //image name send to database
            updateImg($conn, $imageNewName);

        }
    }else {
        $imgUploadedError['uploadError1'] = "Select an image";
    }
}
// define variable and set value
$id = $firstName = $lastName = $address = $telNo = $nic = $occupation = $email = '';
// run the function for get user info
getUserInfo($conn);
// define function for fet user info form db
function getUserInfo($conn) {
    global $id,$firstName,$lastName,$address,$telNo,$nic,$occupation,$email;
    //define db query
    $dbSelectQuery = "SELECT * FROM `customer` WHERE `id`=".$_SESSION['userID'].";";
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
        $occupation = $row['occupation'];
        $email = $row['email'];
    }else {
        echo 'DB Error';
    }
}
//define update database function for user image
function updateImg($conn, $imageNewName){
    //define db query
    $dbImgUpdateQuery = "UPDATE customer SET user_img='".$imageNewName."' WHERE `id`=".$_SESSION['userID'].";";
    if (mysqli_query($conn, $dbImgUpdateQuery)) {
        global $imgUploadStatus;
        $imgUploadStatus['dbStatus'] = "Upload success to database";
    }else{
        global $imgUploadedError;
        $imgUploadedError['dbError'] = "Upload error image to database";
    }
}
// define update database function for user info
function updateUserInfo($conn,$firstName,$lastName,$address,$telNo,$nic,$occupation){
    // define db query
    $dbQuery = "UPDATE customer SET first_name='".$firstName."',last_name='".$lastName."',address='".$address."',tel_no='".$telNo."',nic='".$nic."',occupation='".$occupation."' WHERE `id`=".$_SESSION['userID'].";";
    if (mysqli_query($conn, $dbQuery)){
        global $SubmitStatus;
        $SubmitStatus['dbStatus'] = "User info update success";
    }else {
        global $validateError;
        $validateError['dbError'] = "User Info Update error";
    }
}
// define update database function for user info
function updatePrivacy($conn,$newPassword){
    // define db query
    $dbQuery = "UPDATE customer SET password = '".$newPassword."' WHERE `id`='".$_SESSION['userID']."';";
    if (mysqli_query($conn, $dbQuery)){
        global $SubmitStatus;
        $SubmitStatus['dbStatus'] = "User privacy update success";
    }else {
        global $validateError;
        $validateError['dbError'] = "User Info Update error";
    }
}
// check old password
function check_old_pass($conn,$oldPassword){
    // define query variable and set the db query
    $dbQuery = "SELECT email FROM `customer` WHERE id = '".$_SESSION['userID']."' AND password = '".$oldPassword."';";
    // get the result from db
    $dbResult = mysqli_query($conn, $dbQuery);
    if ($dbResult && mysqli_num_rows($dbResult) == 1){
        return true;
    }else {
        return false;
    }
}
?>


    <?php
    if (isset($imgUploadStatus['dbStatus']) && isset($imgUploadStatus['uploadStatus'])) {
        echo '<div class="">
            <span class="text-success"> Uploading Success !</span>
          </div>';
    }
    ?>
    <form class="" method="post">
        <div class="">
            <h4>Customer Info</h4>
        </div>
        <div class="">
            <input type="number" name="id" value="<?php echo $id;?>" disabled>
            <?php if (isset($validateError['firstName'])){ echo '<label class="text-danger">  '.$validateError['firstName'].'</label>'; } ?>
            <input type="text" name="firstName" value="<?php echo $firstName;?>" placeholder="First Name">
            <?php if (isset($validateError['lastName'])){ echo '<label class="text-danger">  '.$validateError['lastName'].'</label>'; } ?>
            <input type="text" name="lastName" value="<?php echo $lastName;?>" placeholder="Last Name">
            <?php if (isset($validateError['address'])){ echo '<label class="text-danger">  '.$validateError['address'].'</label>'; } ?>
            <input type="text" name="address" value="<?php echo $address;?>" placeholder="Address">
            <?php if (isset($validateError['telNo'])){ echo '<label class="text-danger">  '.$validateError['telNo'].'</label>'; } ?>
            <input type="tel" name="telNo" value="<?php echo $telNo;?>" placeholder="Telephone Number">
            <?php if (isset($validateError['occupation'])){ echo '<label class="text-danger">  '.$validateError['occupation'].'</label>'; } ?>
            <input type="text" name="occupation" value="<?php echo $occupation;?>" placeholder="Occupation">
            <?php if (isset($validateError['nic'])){ echo '<label class="text-danger">  '.$validateError['nic'].'</label>'; } ?>
            <input type="text" name="nic" value="<?php echo $nic;?>" placeholder="NIC">
            <?php if (isset($validateError['email'])){ echo '<label class="text-danger">  '.$validateError['email'].'</label>'; } ?>
            <input type="email" name="email" value="<?php echo $email; ?>" disabled>
            <div class="">
                <button type="submit" name="update" value="update">Update</button>
            </div>
        </div>
    </form>
    <form class="" method="post">
        <div class="">
            <h4>Privacy Info</h4>
        </div>
        <div class="">
            <?php if (isset($validateError['oldPassword'])){ echo '<label class="text-danger">  '.$validateError['oldPassword'].'</label>'; } ?>
            <input type="password" name="oldPassword" value="" placeholder="Old Password">
            <?php if (isset($validateError['newPassword'])){ echo '<label class="text-danger">  '.$validateError['newPassword'].'</label>'; } ?>
            <input type="password" name="newPassword" value="" placeholder="New Password">
            <?php if (isset($validateError['confirmNewPass'])){ echo '<label class="text-danger">  '.$validateError['confirmNewPass'].'</label>'; } ?>
            <input type="password" name="confirmNewPass" value="" placeholder="Confirm Password">
            <div class="">
                <button type="submit" name="updatePrivacy" value="updatePrivacy">Update</button>
            </div>
        </div>
    </form>
</div>
</html>
<?php
if (isset($SubmitStatus['dbStatus'])){
    echo '<div class="">
                    <span class="text-success">upload success</span>
                  </div>';
}
include 'mainFooter.php';
?>
