<?php
session_start();
include '../controllers/config.inc.php';

$dataState = array();
if (isset($_POST['pro_id'])) {
    $dbQueryStage = "UPDATE project SET status = 'inprogress' WHERE id = '".$_POST['pro_id']."';";
    if ($dbResult = mysqli_query($conn, $dbQueryStage)) {
        updateActualStartDate($conn,$_POST['pro_id']);
        $dataState['state'] = "OK";
    }else{
        $dataState['state'] = "NOT";
    }
    echo json_encode($dataState);
}

function updateActualStartDate($conn,$proId){
    $dbQueryAcStartDate = "SELECT project.actual_start_date FROM project WHERE project.id = '".$proId."';";
    $resultAcStartDate = mysqli_query($conn, $dbQueryAcStartDate);
    $rowAcStartDate = mysqli_fetch_assoc($resultAcStartDate);
    if($rowAcStartDate['actual_start_date'] == "") {
        $dbQuery = "UPDATE project SET actual_start_date = 'CURRENT_TIMESTAMP' WHERE id = '".$proId."';";
        $result = mysqli_query($conn, $dbQuery);
    }
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
            updateStageAcDate($conn,$_POST['progress'][$i]['stages_status'],$_POST['progress'][$i]['stages_id']);
            $status = true;
        }else{
            $status = false;
        }
    }

    if ($status == true) {
        updateAcEndDateAndState($conn,$_POST['progress'][0]['pro_id']);
        $dataState['state'] = "OK";
    }else{
        $dataState['state'] = "NOT";
    }
    echo json_encode($dataState);
}

function updateAcEndDateAndState($conn,$proId) {
    $isAllStagesComp = false;
    $dbQueryStage = "SELECT stages.stage_id,stages.stages_status FROM stages WHERE stages.pro_id = '".$proId."';";
    if ($resultStage = mysqli_query($conn, $dbQueryStage)) {
        if (mysqli_num_rows($resultStage) > 0) {
            while ($rowStage = mysqli_fetch_assoc($resultStage)) {
                if ($rowStage['stages_status'] == 'complete'){
                    $isAllStagesComp = true;
                } else {
                    $isAllStagesComp = false;
                }
            }
        }
    }

    if ($isAllStagesComp == true) {
        $dbQuery = "UPDATE project SET actual_end_date = 'CURRENT_TIMESTAMP',status = 'complete' WHERE id = '".$proId."';";
        $result = mysqli_query($conn, $dbQuery);
    }
}

function updateStageAcDate($conn,$stageStatus,$stageId) {
    if ($stageStatus == "inprogress") {
        $dbQueryStageSDate = "UPDATE stages SET actual_start_date = 'CURRENT_TIMESTAMP' WHERE stage_id = '".$stageId."';";
        mysqli_query($conn, $dbQueryStageSDate);
    } elseif ($stageStatus == "complete") {
        $dbQueryStageEDate = "UPDATE stages SET actual_end_date = 'CURRENT_TIMESTAMP' WHERE stage_id = '".$stageId."';";
        mysqli_query($conn, $dbQueryStageEDate);
    }
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
