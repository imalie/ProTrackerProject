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
    <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
    <script type="text/javascript" src="../res/ad/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../res/ad/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/mat-icons.css" />
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/demo/demo.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
</head>
 <!-- Navbar -->
 <?php include('mainHead.php') ?>
            <!-- End Navbar -->
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
                        <a class="nav-link" href="./payment.php">
                            <i class="material-icons">
                                dns
                            </i>
                            <p>Payment Creation</p>
                        </a>
                    </li>
                
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <?php
                    include_once '../controllers/config.inc.php';
                    ?>

  
        <div class="container p-3">
            <table class="table">
                <tr>
                <th>Customer Id</th>
                <th>Customer Name</th>
                <th>Project Name</th>
                </tr>
                <tr>
                    <td class="w-25"><input class="form-control" placeholder="Customer ID" id="customer_id" disabled></td>
                    <td class="w-auto"><input class="form-control" placeholder="Customer Name" id="customer_name"></td>
                    <td class="w-50"><select id="project_name" class="custom-select"><option value="null">Select</option></select></td>
                </tr>
                <tr>
                    <td colspan="4"><input class="btn btn-success float-right" type="button" id="checkout" value="Checkout"></td>
                </tr>
                <tr id="payment_tr" class="invisible">
                    <td colspan="4"><input type="number" class="form-control w-25 float-right" id="payment" placeholder="Payment (LKR)"></td>
                </tr>
            </table>
            <div class="pt-4" id="stage_details">

            </div>
            <div class="table" id="release_div">

            </div>
        </div>
    </div>
</body>
    <script>
        $(document).ready(function () {
            var resultLength = 0;
            var totalOutstanding = 0;
            $("#customer_name").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "payment_search.php",
                        type: "POST",
                        data: { customer_name: request['term'] },
                        dataType: 'json',
                        success: function (data) {
                            response($.map(data, function (el) {
                                return {
                                    id: el.id,
                                    label: el.full_name
                                };
                            }));
                        }

                    });
                },
                select: function (event,ui) {
                    $('#customer_id').val(ui.item.id);
                    console.log(ui.item.id);
                    $.ajax({
                        url: "payment_search.php",
                        type: "POST",
                        data: { project_id: ui.item.id },
                        dataType: 'json',
                        success: function (data) {
                            for (var i = 0; i < data.length; i++) {
                                $('#project_name').append('<option value="'+data[i].id+'">'+data[i].pro_name+' (LKR '+data[i].outstanding+')</option>');
                            }
                        }
                    });
                }
            });
            $('#checkout').click(function () {
                var validationStatue = false;
                var selectedVal = $('#project_name option:selected').val();

                if (selectedVal.includes('null')){validationStatue = true; addClassWarning('project_name');}

                if (validationStatue === false) {
                    addClassVisible('payment_tr');
                    disabledField('project_name');
                    disabledField('customer_name');
                    $.ajax({
                        url: "payment_search.php",
                        type: "POST",
                        data: {stage_details: selectedVal},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            var dataSetLength = data.length;
                            for (var i = 0; i < dataSetLength; i++) {
                                resultLength++;
                                totalOutstanding += parseInt(data[i].outstanding);
                                $('#stage_details').append('<table class="table border rounded">' +
                                    '<tr>' +
                                    '<td><label for="">Stage ID </label><input type="text" class="form-control" value="' + data[i].stage_id + '" id="stage_id_' + resultLength + '" disabled></td>' +
                                    '<td><label for="">Stage Name </label><input type="text" class="form-control" value="' + data[i].stage_name + '" disabled></td>' +
                                    '<td><label for="">Approximated Budget </label><input type="number" class="form-control" value="' + data[i].approx_budget + '" disabled></td>' +
                                    '<td><label for="">Outstanding </label><input type="number" class="form-control"  value="' + data[i].outstanding + '" id="outstanding_' + resultLength + '" disabled></td>' +
                                    '<td><label for="">Payment Set Off </label><input type="number" class="form-control border-warning" id="setoff_paid_' + resultLength + '" value="0.00" disabled></td>' +
                                    '</tr>' +
                                    '</table>');

                            }
                            $('#release_div').append('<input class="btn btn-success float-right" id="release" value="Release" type="button">');
                        }
                    });
                }
            });

            $('#payment').change(function () {
                for (var y = 1; y <= resultLength; y++){
                    $('#setoff_paid_'+y+'').val('0.00');
                }

                var payment = parseInt($('#payment').val());

                if (totalOutstanding >= payment){
                    for (var i = 1; i <= resultLength; i++) {
                        var outstanding = parseInt($('#outstanding_'+i+'').val());

                        if (outstanding < payment){
                            payment = payment - outstanding;
                            $('#setoff_paid_'+i+'').val(outstanding);
                        } else {
                            $('#setoff_paid_'+i+'').val(payment);
                            break;
                        }
                    }
                }else {
                    addClassWarning("payment");
                }
            });
            
            $(document).on('click','#release',function () {
                var validationStatue = false;
                var data_set = [];

                if ($('#payment').val() === "") {validationStatue = true; addClassWarning('payment'); }
                if ($('#payment').val() > totalOutstanding) {validationStatue = true; addClassWarning('payment'); }
                if (validationStatue === false) {

                    var data_payment = {
                        'type': 'payment',
                        'cus_id': $('#customer_id').val(),
                        'payment': $('#payment').val(),
                        'pro_id': $('#project_name option:selected').val()
                    };

                    data_set.push(data_payment);

                    for (var i = 1; i <= resultLength; i++){
                        var data_outstanding = {
                            'type': 'outstanding',
                            'stage_id': $('#stage_id_'+i+'').val(),
                            'out': $('#setoff_paid_'+i+'').val()
                        };
                        data_set.push(data_outstanding);
                    }

                    $.ajax({
                        url: "out-payment.php",
                        type: "POST",
                        data: { data_set: data_set },
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data['state'].includes("OK")){
                                alert("Success!");
                            }else { alert("Failed!"); }
                        }
                    });
                }
            });

            function addClassWarning(id) {
                $('#'+id+'').addClass("border-danger");
            }

            function addClassVisible(id) {
                $('#'+id+'').removeClass("invisible");
            }
            function disabledField(id) {
                $('#'+id+''). prop("disabled", true);
            }
        });
    </script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
<?php include 'mainFooter.php'; ?>