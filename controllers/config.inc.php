<?php
//DBMS Connection settings
$dbServer = "localhost";
$dbUser = "root";
$dbPassword = "root";
$dbDatabase = "pro_tracker";

//DBMS Connection create
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbDatabase);
