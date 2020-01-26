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
                        <a class="nav-link" href="./projectCreate.php">
                            <i class="material-icons">
                                date_range
                            </i>
                            <p>Project Creation</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./projectList.php">
                            <i class="material-icons">
                                assignment
                            </i>
                            <p>Project Report</p>
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
                    <!--<button type="button" class="btn btn-outline-secondary"><a href="projectCreate.php">
                            <i class="material-icons">account_circle</i>Create Project</a></button>-->
                    <table class="table table-hover">
                        <thead class="thead-light"></thead>
                        <thead>
                            <tr class="">
                                <th class="">Project ID</th>
                                <th class="">Project Name</th>
                                <th class="">Owner Name</th>
                                <th class="">Approximated Budget</th>
                                <th class="">Start Date</th>
                                <th class="">End Date</th>
                                <th class="">Release Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../controllers/config.inc.php';

                            $dbQuery = "SELECT project.id,project.pro_name,customer.first_name,customer.last_name,project.approx_budget,project.start_date,project.end_date,project.release_date
                                    FROM project INNER JOIN customer ON project.pro_owner_id = customer.id;";

                            if ($result = mysqli_query($conn, $dbQuery)) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                            <td>' . $row['id'] . '</td>
                                            <td>' . $row['pro_name'] . '</td>
                                            <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                                            <td>' . $row['approx_budget'] . '</td> 
                                            <td>' . $row['start_date'] . '</td>
                                            <td>' . $row['end_date'] . '</td>
                                            <td>' . $row['release_date'] . '</td>
                                            <td><a href="projectViewer.php?id=' . $row['id'] . '">View</a></td>
                                        </tr>';
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td style="color: #ff0000">0 result</td>
                                    </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'mainFooter.php' ?>