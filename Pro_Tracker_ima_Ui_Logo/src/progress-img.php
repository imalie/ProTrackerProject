<?php
session_start();
include '../controllers/config.inc.php';

$imgUploadedError = array();
$imgUploadStatus = array();

if (isset($_POST['stages_name_img'])){
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
        if ($_FILES['file']['size'] > 10000000){$imgUploadedError['uploadError4'] = "Image size long of this image"; }
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
            updateImg($conn, $imageNewName, $_POST['stages_name_img'],$_POST['pro_id']);

            if (!(0 === count($imgUploadedError))) {
                $dataState = array();
                $dataState['state'] = "OK";
                echo json_encode($dataState);
            }

        }
    }else {
        $imgUploadedError['uploadError1'] = "Select an image";
    }
}
function updateImg($conn, $imageNewName, $stage_id,$pro_id){
    //define db query
    $dbImgUpdateQuery = "INSERT INTO stages_img (pro_id,stages_id,img,release_user) VALUES ('".$pro_id."','".$stage_id."','".$imageNewName."','".$_SESSION['userID']."');";
    if (mysqli_query($conn, $dbImgUpdateQuery)) {
        global $imgUploadStatus;
        $imgUploadStatus['dbStatus'] = "Upload success to database";
    }else{
        global $imgUploadedError;
        $imgUploadedError['dbError'] = "Upload error image to database";
    }
}
