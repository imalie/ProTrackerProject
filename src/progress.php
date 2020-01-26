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
    <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/mat-icons.css" />
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
    <script type="text/javascript" src="../res/ad/bootstrap.js"></script>
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
                        <a class="nav-link" href="./stock-adjustment.php">
                            <i class="material-icons">
                                dns
                            </i>
                            <p>Stock Adjustment</p>
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
                   
<?php
include '../controllers/config.inc.php';
$pro_id = $_GET['id'];

$dbQuery = "SELECT project.pro_name,project.actual_start_date,project.actual_end_date,project.status,stages.stages_status,stages.stage_id,stages.stage_name,project.in_paid_state,stages.actual_start_date,stages.actual_end_date FROM project JOIN stages ON project.id = stages.pro_id
            WHERE project.id = '".$pro_id."';";

$dataset = array();
if ($result = mysqli_query($conn, $dbQuery)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = array();
            $data['pro_name'] = $row['pro_name'];
            $data['ac_start_date'] = $row['actual_start_date'];
            $data['ac_end_date'] = $row['actual_end_date'];
            $data['stage_id'] = $row['stage_id'];
            $data['stage_name'] = $row['stage_name'];
            $data['in_paid_state'] = $row['in_paid_state'];
            $data['status'] = $row['status'];
            $data['stages_status'] = $row['stages_status'];
            if ($row['actual_start_date'] != ""){
                $data['actual_start_date'] = $row['actual_start_date'];
            } else {$data['actual_start_date'] = "Not yet";}
            if ($row['actual_end_date'] != ""){
                $data['actual_end_date'] = $row['actual_end_date'];
            }else {$data['actual_end_date'] = "Not yet";}
            array_push($dataset, $data);
        }
    }
}
$dbQueryRemark = "SELECT project_remark.remark FROM project_remark WHERE project_remark.pro_id = '".$pro_id."';";
$datasetRemark = array();
if ($resultRemark = mysqli_query($conn, $dbQueryRemark)) {
    if (mysqli_num_rows($resultRemark) > 0) {
        while ($rowRemark = mysqli_fetch_assoc($resultRemark)) {
            $dataRemark = array();
            $dataRemark['remark'] = $rowRemark['remark'];
            array_push($datasetRemark, $dataRemark);
        }
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
<div class="modal" id="demoModal">
                <div class="modal-dialog">
                    <div class="model-content">
                     <div class="modal-header">
                        <h2 class="modal-title">Please confirm!! </h2>
                        <button type="button" class="close"data-dismiss="modal">
                            <span>&times;</span></button>
                       
                    </div>
                        <div class="modal-body">
                            <p>this the modal,do you like it??</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-btn-secondary" data-dismiss="modal">Confirm</button>
                        </div>
                     </div> 
                </div>
            </div>
<div class="container p-3">
    <div>
        <h2>Progress</h2>
    </div>
    <table class="table">
        <tr>
            <td class="w-25"><label for="">Project ID</label><input class="form-control" id="pro_id" value="<?php echo $pro_id; ?>" disabled></td>
            <td class="w-auto"><label for="">Project Name</label><input class="form-control" id="pro_name" value="<?php echo $dataset[0]['pro_name']; ?>" disabled></td>
            <td class="w-auto"><label for="">Status Value</label><input class="form-control" value="<?php echo $complete; ?> %" disabled></td>
            <?php
            if ($dataset[0]['in_paid_state'] == 1) {
                if ($dataset[0]['status'] == 'inprogress') {
                    echo '<td><br><button type="button" id="hold" class="btn btn-warning w-100">HOLD</button></td>';
                    echo '<td><br><button type="button" id="update" class="btn btn-outline-success w-100">Update</button></td>';
                } else if ($dataset[0]['status'] == 'complete') {
                    echo '<td><br><label class="bg-success " style="width: 10rem; height: 3rem;color: white;">Complete</label></td>';
                } else {
                    echo '<td><br><button type="button" id="start" class="btn btn-success w-100">START</button></td>';
                }
            }
            ?>
        </tr>
        <tr>
            <td><label for="">Actual Start Date</label><br><label for=""><?php if($dataset[0]['ac_start_date']==""){echo 'Not Start Yet';} else {echo $dataset[0]['ac_start_date'];} ?></label></td>
            <td><label for="">Actual End Date</label><br><label for=""><?php if($dataset[0]['ac_end_date']==""){echo 'Not End Yet';} else {echo $dataset[0]['ac_end_date'];} ?></label></td>
        </tr>
    </table>
    <table class="table border w-100">
        <?php
        for ($i = 0; $i < count($dataset); $i++) {
            echo '<tr>
                    <td class="w-25"><label for="">Stage Id</label><input type="text" id="stage_id_' . $i . '" class="form-control stage_id" value="' . $dataset[$i]['stage_id'] . '" disabled></td>
                    <td class="w-25"><label for="">Stage Name</label><input type="text" class="form-control" value="' . $dataset[$i]['stage_name'] . '" disabled></td>
                    <td class="w-25"><label for="">Start Date</label><input type="text" class="form-control" value="' . $dataset[$i]['actual_start_date'] . '" disabled></td>
                    <td class="w-25"><label for="">Stage End</label><input type="text" class="form-control" value="' . $dataset[$i]['actual_end_date'] . '" disabled></td>
                    <td class="w-25"><a class="btn btn-success" href="progressImgesView.php?id='.$dataset[$i]['stage_id'].'" target="_blank">View Image</a></td>';
            if ($dataset[0]['status'] == 'inprogress') {
                if ($dataset[$i]['stages_status'] == 'inprogress') {
                    echo '<td class="w-25"><label for="">Status</label><br>
                            <select id="stages_status_' . $i . '" class="custom-select">
                                <option value="notstart">Not Start</option>
                                <option selected value="inprogress">Inprogress</option>
                                <option value="hold">Hold</option>
                                <option value="complete">Complete</option>
                            </select>
                            </td>                            
                            </tr>';
                } else if ($dataset[$i]['stages_status'] == 'hold') {
                    echo '<td class="w-25"><label for="">Status</label><br>
                            <select id="stages_status_' . $i . '" class="custom-select">
                                <option value="notstart">Not Start</option>
                                <option value="inprogress">Inprogress</option>
                                <option selected value="hold">Hold</option>
                                <option value="complete">Complete</option>
                            </select>
                            </td>               
                            </tr>';
                } else if ($dataset[$i]['stages_status'] == 'notstart') {
                    echo '<td class="w-25"><label for="">Status</label><br>
                            <select id="stages_status_' . $i . '" class="custom-select">
                                <option selected value="notstart">Not Start</option>
                                <option value="inprogress">Inprogress</option>
                                <option value="hold">Hold</option>
                                <option value="complete">Complete</option>
                            </select>
                            </td>               
                            </tr>';
                } else {
                    echo '<td class="w-25"><label for="">Status</label><br>
                            <select id="stages_status_' . $i . '" class="custom-select">
                                <option value="notstart">Not Start</option>
                                <option value="inprogress">Inprogress</option>
                                <option value="hold">Hold</option>
                                <option selected value="complete">Complete</option>
                            </select>
                            </td>               
                            </tr>';
                }
            }
        }
        ?>
    </table>
    <form id="formImg" action="progress-img.php" class="form-group" enctype="multipart/form-data">
        <label>Upload Stage Images</label>
        <select id="stages_name_img" name="stages_name_img" class="custom-select">
            <?php
            for ($i = 0; $i < count($dataset); $i++) {
                echo '<option value="' . $dataset[$i]['stage_id'] . '">' . $dataset[$i]['stage_name'] . '</option>';
            }
            ?>
        </select>
        <input type="file" name="file">
        <input type="number" id="pro_ids" class="d-none" name="pro_id" value="">
        <input type="submit" class="btn btn-outline-success" name="stages_name_img" id="submit" value="Submit">
    </form>
    <table class="table">
        <tr><td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#remarkModal">Remark</button></td></tr>
        <?php
        for ($i = 0; $i < count($datasetRemark); $i++) {
            echo '<tr><td colspan="2"><textarea class="form-control" disabled>' . $datasetRemark[$i]['remark'] . '</textarea></td></tr>';
        }
        ?>
    </table>
    <div class="modal fade" role="dialog" id="remarkModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title">Add Remark</label>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="checkbox" id="cus_visible" class="checkbox">Customer Visible<br>
                        <textarea class="form-control" id="remark"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-outline-dark float-right" type="button" id="add_remark" value="Add Remark">
                </div>
            </div>
        </div>
    </div>
    <p id="count" class="d-none"><?php echo count($dataset); ?></p>
</div>
<script>
    $(document).ready(function(e) {
        var pro_id = $('#pro_id').val();
        $('#pro_ids').val(pro_id);
        $('#start').click(function() {
            $.ajax({
                url: "progress-update.php",
                type: "POST",
                data: {
                    pro_id: $('#pro_id').val()
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data['state'].includes("OK")) {
                        location.reload();
                    } else {
                        alert("Failed!");
                    }
                }
            });
        });
        $('#hold').click(function() {
            $.ajax({
                url: "progress-update.php",
                type: "POST",
                data: {
                    hold: $('#pro_id').val()
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data['state'].includes("OK")) {
                        location.reload();
                    } else {
                        alert("Failed!");
                    }
                }
            });
        });
        $('#update').click(function() {

            var dataset = [];
            var count = parseInt($('#count').text());
            for (var i = 0; i < count; i++) {
                var data = {
                    'stages_id': $('#stage_id_' + i + '').val(),
                    'stages_status': $('#stages_status_' + i + ' option:selected').val(),
                    'pro_id': $('#pro_id').val(),
                };
                dataset.push(data);
                console.log(data);
            }

            console.log(dataset);

            $.ajax({
                url: "progress-update.php",
                type: "POST",
                data: {
                    progress: dataset
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data['state'].includes("OK")) {
                        location.reload();
                    } else {
                        alert("Failed!");
                    }
                }
            });
        });
        $('#add_remark').click(function() {
            var validate = false;
            var remark = $('#remark').val();
            var visible = 0;

            if ($('#cus_visible').is(":checked")) {
                visible = 1;
            } else {
                visible = 0;
            }

            if (remark !== "") {
                validate = true;
            }

            if (validate) {
                var dataset = {
                    'pro_id': '1',
                    'remark': remark,
                    'visible': visible
                };
                console.log(dataset);
                $.ajax({
                    url: "progress-update.php",
                    type: "POST",
                    data: {
                        remark: dataset
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if (data['state'].includes("OK")) {
                            location.reload();
                        } else {
                            alert("Failed!");
                        }
                    }
                });
            }
        });
        $("#formImg").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "progress-img.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function() {}
            });
        }));
    });
</script>