<?php 

//define check e-mail and password function
function loginValid($conn, $userEmail, $userPassword)
{
    //define query variable and set the db query
    $dbQuery = "SELECT id,first_name,user_type,email,user_img,status FROM `users` WHERE email = '$userEmail' AND password = '$userPassword' 
                UNION SELECT id,first_name,user_type,email,user_img,status FROM `customer` WHERE email = '$userEmail' AND password = '$userPassword';";

    $dbResult = mysqli_query($conn, $dbQuery);
    //close the db connection
    mysqli_close($conn);

    return $dbResult;
}