<?php
//session clear
if (isset($_GET['signout'])){
    session_start();
    session_unset();
    session_destroy();
    pageRedirect("index.php?signout=true");
}
//define page redirect function
function pageRedirect($path){
    header( 'Location: ' . $path );
    exit();
}