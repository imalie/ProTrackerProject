<?php 

//define redirect function
function pageRedirect($path)
{
    header('Location: ' . $path);
    exit();
}

//display messege
function showValidateMsg($validateHeader, $validateBody)
{
    global $errorMsg;
    $errorMsg = $errorMsg . $validateHeader . ' ' . $validateBody . '<br/>';
}
