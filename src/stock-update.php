<?php
session_start();
include '../controllers/config.inc.php';

if (isset($_POST['stockin'])){
    $dataset_count = count($_POST['stockin']);
    $validate = false;
    for ($i = 0; $i < $dataset_count; $i++) {
        $totalCost = $_POST['stockin'][$i]['ads_qty'] * $_POST['stockin'][$i]['unit_cost'];
        $dbQueryStage = "INSERT INTO pro_stock_in(pro_id, stage_id, item_id, item_cost, qty, total_amount, release_user) 
                    VALUES ('".$_POST['stockin'][$i]['pro_id']."','".$_POST['stockin'][$i]['stage_id']."','".$_POST['stockin'][$i]['item_id']."','".$_POST['stockin'][$i]['unit_cost']."','".$_POST['stockin'][$i]['ads_qty']."','".$totalCost."','".$_SESSION['userID']."');";

        if ($dbResult = mysqli_query($conn, $dbQueryStage)){$validate = true;}
    }
    mysqli_close($conn);
    if ($validate == true){
        $data = array();
        $data['state'] = "OK";
        echo json_encode($data);
    }else{
        echo "not work";
    }
}

if (isset($_POST['stockout'])){
    $dataset_count = count($_POST['stockout']);
    $validate = false;
    for ($i = 0; $i < $dataset_count; $i++) {
        $totalCost = $_POST['stockout'][$i]['ads_qty'] * $_POST['stockout'][$i]['unit_cost'];
        $dbQueryStage = "INSERT INTO pro_stock_out(pro_id, stage_id, item_id, item_cost, qty, total_amount, release_user) 
                    VALUES ('".$_POST['stockout'][$i]['pro_id']."','".$_POST['stockout'][$i]['stage_id']."','".$_POST['stockout'][$i]['item_id']."','".$_POST['stockout'][$i]['unit_cost']."','".$_POST['stockout'][$i]['ads_qty']."','".$totalCost."','".$_SESSION['userID']."');";
        if ($dbResult = mysqli_query($conn, $dbQueryStage)){$validate = true;}
    }
    mysqli_close($conn);
    if ($validate == true){
        $data = array();
        $data['state'] = "OK";
        echo json_encode($data);
    }else{
        echo "not work";
    }
}
