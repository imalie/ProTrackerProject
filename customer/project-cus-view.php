<?php
include '../controllers/config.inc.php';

$proId = $_GET['id'];
//define db query
$dbSelectQuery = "SELECT project.id,project.pro_name,customer.first_name,customer.last_name,project.address,project.approx_budget,project.start_date,project.end_date,project.pro_act_start_date,project.pro_act_end_date,project.plan_doc,project.status
    FROM project JOIN customer ON project.pro_owner_id = customer.id WHERE project.id='".$proId."';";
//get the result from db
if ($dbResult = mysqli_query($conn, $dbSelectQuery)) {
    $row = mysqli_fetch_assoc($dbResult);
    //define variable and set value
    $id = $row['id'];
    $proOwnerName = $row['first_name']." ".$row['last_name'];
    $proName = $row['pro_name'];
    $address = $row['address'];
    $approxBudget = $row['approx_budget'];
    $startDate = $row['start_date'];
    if ($row['pro_act_start_date'] != ""){
        $actualStartDate = $row['pro_act_start_date'];
    } else {$actualStartDate = "Not yet";}
    if ($row['pro_act_end_date'] != ""){
        $actualEndDate = $row['pro_act_end_date'];
    } else {$actualEndDate = "Not yet";}
    $endDate = $row['end_date'];
    $planDoc = $row['plan_doc'];
    $status = $row['status'];
}

$dbQueryStages = "SELECT stages.stage_id,stages.stage_name,stages.approx_budget,stages.stage_desc,stages.outstanding,stages.stages_status,stages.stage_act_start_date,stages.stage_act_end_date FROM stages 
                    WHERE stages.pro_id = '".$proId."';";
$dataset = array();
$totalPaidAmount = 0;
$totalOutAmount = 0;
if ($resultStage = mysqli_query($conn, $dbQueryStages)){
    if (mysqli_num_rows($resultStage) > 0){
        while ($rowStage = mysqli_fetch_assoc($resultStage)){
            $data['stage_id'] = $rowStage['stage_id'];
            $data['stage_name'] = $rowStage['stage_name'];
            $data['approx_budget'] = $rowStage['approx_budget'];
            $data['stage_desc'] = $rowStage['stage_desc'];
            $data['outstanding'] = $rowStage['outstanding'];
            $data['stages_status'] = $rowStage['stages_status'];

            if ($rowStage['stage_act_start_date'] != "") {
                $data['start_date'] = $rowStage['stage_act_start_date'];
            } else { $data['start_date'] = "Not Yet"; }
            if ($rowStage['stage_act_end_date'] != "") {
                $data['end_date'] = $rowStage['stage_act_end_date'];
            } else { $data['end_date'] = "Not Yet"; }

            $totalPaidAmount += $rowStage['approx_budget'] - $rowStage['outstanding'];
            $totalOutAmount += $rowStage['outstanding'];
            array_push($dataset,$data);
        }
    }
}

$dbQueryRemark = "SELECT remark,release_date FROM project_remark WHERE pro_id='".$proId."' and customer_visible='1';";
$datasetRemark = array();
if ($resultRemark = mysqli_query($conn, $dbQueryRemark)){
    if (mysqli_num_rows($resultRemark) > 0){
        while ($rowRemark = mysqli_fetch_assoc($resultRemark)){
            $dataRemark['remark'] = $rowRemark['remark'];
            $dataRemark['release_date'] = $rowRemark['release_date'];
            array_push($datasetRemark,$dataRemark);
        }
    } else {
        $dataRemark['null'] = "No Result";
        array_push($datasetRemark,$dataRemark);
    }
}

$complete = 0;
$completeCount = 0;
for ($i = 0;$i< count($dataset);$i++){
    if ($dataset[$i]['stages_status'] == "complete") {
        $completeCount += 1;
    }
}
$complete = ($completeCount/count($dataset))*100;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Project</title>
        <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
        <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
        <script type="text/javascript" src="../res/ad/bootstrap.js"></script>
    </head>
    <!-- Navbar -->
            <?php include('mainHead.php') ?>
            <!-- End Navbar -->
    <body style="padding-top: 85px">
        <div class="container pt-4">
            <div>
                <table class="table border rounded">
                    <tr>
                        <td colspan="1"><h5>Project Information</h5></td>
                        <td class="w-auto"><label for="">Project Value</label><input class="form-control bg-success" style="color: white;" type="text" value="<?php echo $complete;?> %" disabled></td>
                        <td class="w-auto"><label for="">Project Status</label><input class="form-control bg-success" style="color: white;" type="text" value="<?php echo $status;?>" disabled></td>
                    </tr>
                    <tr>
                        <td class="w-25"><label for="">Project ID</label><input class="form-control" type="number" value="<?php echo $id;?>" disabled></td>
                        <td class="w-auto"><label for="">Project Name</label><input class="form-control" type="text" value="<?php echo $proName;?>" disabled></td>
                        <td class="w-auto"><label for="">Project Owner Name</label><input class="form-control" type="text" value="<?php echo $proOwnerName;?>" disabled></td>
                    </tr>
                    <tr>
                        <td colspan="2"><label for="">Site Address</label><input class="form-control" type="text" value="<?php echo $address;?>" disabled></td>
                        <td><label for="">Approximated Budget</label><input class="form-control" type="text" value="<?php echo $approxBudget;?>" disabled></td>
                    </tr>
                    <tr>
                        <td colspan="3"><button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#remarkModal">Project Remark</button></td>
                    </tr>
                </table>
                <table class="table border rounded">
                    <tr><td colspan="2"><h5>Time Line Information</h5></td></tr>
                    <tr>
                        <td><label for="">Start Date</label><input class="form-control" type="text" value="<?php echo $startDate;?>" disabled></td>
                        <td><label for="">End Date</label><input class="form-control" type="text" value="<?php echo $endDate;?>" disabled></td>
                    </tr>
                    <tr>
                        <td><label for="">Actual Start Date</label><input class="form-control" type="text" value="<?php echo $actualStartDate;?>" disabled></td>
                        <td><label for="">Actual End Date</label><input class="form-control" type="text" value="<?php echo $actualEndDate;?>" disabled></td>
                    </tr>
                </table>
                <table class="table border rounded">
                    <tr><td colspan="2"><h5>Payment Information</h5></td></tr>
                    <tr>
                        <td><label for="">Project Total Paid Amount (LKR)</label><input class="form-control" type="text" value="<?php echo $totalPaidAmount;?>" disabled></td>
                        <td><label for="">Project Total Outstanding Amount (LKR)</label><input class="form-control" type="text" value="<?php echo $totalOutAmount;?>" disabled></td>
                    </tr>
                </table>
                <table class="table border rounded">
                    <tr><td><h5>Stages Information</h5></td></tr>
                    <?php
                    for ($i = 0;$i< count($dataset);$i++) {
                        echo '
                        <tr>
                            <td>
                                <table class="table table-borderless">
                                    <tr>
                                    <td><label for="">Stages ID</label><input class="form-control" type="text" value="'.$dataset[$i]['stage_id'].'" disabled></td>
                                    <td><label for="">Stages Name</label><input class="form-control" type="text" value="'.$dataset[$i]['stage_name'].'" disabled></td>
                                    <td><label for="">Start Date</label><input class="form-control" type="text" value="'.$dataset[$i]['start_date'].'" disabled></td>
                                    <td><label for="">End Date</label><input class="form-control" type="text" value="'.$dataset[$i]['end_date'].'" disabled></td>                                    
                                    </tr>
                                    <tr>
                                    <td><label for="">Approximated Budget (LKR)</label><input class="form-control" type="text" value="'.$dataset[$i]['approx_budget'].'" disabled></td>
                                    <td><label for="">Outstanding (LKR)</label><input class="form-control" type="number" value="'.$dataset[$i]['outstanding'].'" disabled></td>
                                    <td><label for="">Paid Amount (LKR)</label><input class="form-control" type="number" value="'.($dataset[$i]['approx_budget'] - $dataset[$i]['outstanding']).'" disabled></td>
                                    <td><label for="">Status</label><input class="form-control" type="text" value="'.$dataset[$i]['stages_status'].'" disabled></td>
                                    </tr>
                                    <tr>
                                    <td colspan="4"><a class="btn btn-success float-right" target="_blank" href="../src/progressImgesView.php?id='.$dataset[$i]['stage_id'].'">View Images</a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        ';
                    }
                    ?>
                </table>
            </div>
            <style >
                
                div.ex3 {
  
  width: 100%;
  height: 500px;
  overflow: auto;
}
            </style>
            
            <div class="modal fade" role="dialog" id="remarkModal">
                <div class="modal-dialog modal-lg" style="width: 200rem;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <label class="modal-title">All Remark</label>
                        </div>
                        <div class="modal-body ex3">
                            <div class="form-group overflow-auto">
                                <?php
                                for ($i = 0; $i < count($datasetRemark); $i++) {
                                    if (isset($datasetRemark[$i]['null'])) {
                                        echo '<p>No Result</p>';
                                    }else {
                                        echo '
                                        <table class="table border rounded">
                                        <tr><td><label for="">Date</label><input type="text"class="form-control" value="'.$datasetRemark[$i]['release_date'].'" disabled></td></tr>
                                        <tr><td><label for="">Remark</label><textarea class="form-control" disabled>'.$datasetRemark[$i]['remark'].'</textarea></td></tr>
                                        </table>
                                        ';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
      <?php include 'mainFooter.php'; ?>
</html>
