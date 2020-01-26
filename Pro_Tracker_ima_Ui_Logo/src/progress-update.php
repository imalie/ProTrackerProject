<?php
session_start();
include '../controllers/config.inc.php';

$dataState = array();
if (isset($_POST['pro_id'])) {
    $dbQueryStage = "UPDATE project SET status = 'inprogress' WHERE id = '".$_POST['pro_id']."';";
    if ($dbResult = mysqli_query($conn, $dbQueryStage)) {
        $dataState['state'] = "OK";
    }else{
        $dataState['state'] = "NOT";
    }
    echo json_encode($dataState);
}
if (isset($_POST['hold'])) {
    $dbQueryStage = "UPDATE project SET status = 'hold' WHERE id = '".$_POST['hold']."';";
    if ($dbResult = mysqli_query($conn, $dbQueryStage)) {
        $dataState['state'] = "OK";
    }else{
        $dataState['state'] = "NOT";
    }
    echo json_encode($dataState);
}
if (isset($_POST['progress'])) {
    $dataset_count = count($_POST['progress']);
    $status = false;

    for ($i = 0; $i < $dataset_count; $i++) {
        $dbQueryStage = "UPDATE stages SET stages_status = '".$_POST['progress'][$i]['stages_status']."' WHERE stage_id = '".$_POST['progress'][$i]['stages_id']."';";

        if ($dbResult = mysqli_query($conn, $dbQueryStage)) {
            $status = true;
        }else{
            $status = false;
        }
    }

    if ($status == true) {
        $dataState['state'] = "OK";
    }else{
        $dataState['state'] = "NOT";
    }
    echo json_encode($dataState);
}

if (isset($_POST['remark'])) {
    $status = false;

    $dbQueryStage = "INSERT INTO project_remark(pro_id,remark,customer_visible,release_user) 
                    VALUES ('".$_POST['remark']['pro_id']."','".$_POST['remark']['remark']."','".$_POST['remark']['visible']."','".$_SESSION['userID']."');";

    if ($dbResult = mysqli_query($conn, $dbQueryStage)) {
        $status = true;
    } else {
        $status = false;
    }

    if ($status == true) {
        $dataState['state'] = "OK";
    }else{
        $dataState['state'] = "NOT";
    }
    echo json_encode($dataState);
}
