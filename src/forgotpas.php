<?php
include '../controllers/config.inc.php';
require '../controllers/Mail/PHPMailerAutoload.php';

$companyEmailAddress = "protrackerepci@gmail.com";
$companyEmailPassword = "protrackerepci123";

$validateError = null;
$mailMeg = null;

if (isset($_POST['Send'])) {
    $email = $_POST['email'];
    if (!empty($email)) {
        if (!is_email($conn,$email)){
            $validateError = "Is this mail your?";
        } else {
            sendMail($conn,$email,randomPassword());
        }
    } else {
        $validateError = "Email is empty";
    }
}

function is_email($conn,$email) {
    //define query variable and set the db query
    $dbQuery = "SELECT email FROM customer WHERE email = '".$email."';";
    //get the result from db
    $dbResult = mysqli_query($conn, $dbQuery);
    if ($dbResult && mysqli_num_rows($dbResult) == 1) {
        return true;
    } else {
        return false;
    }
}

function randomPassword(){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function updateResetPassword($conn,$email,$password) {
    $dbQuery = "UPDATE customer SET password='".md5($password)."' WHERE email = '".$email."';";
    mysqli_query($conn, $dbQuery);
}

function sendMail($conn,$email,$password) {
    global $companyEmailAddress, $companyEmailPassword, $mailMeg;
    try {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username=$companyEmailAddress;
        $mail->Password=$companyEmailPassword;

        $mail->setFrom($email,'');
        $mail->addAddress($email);
        $mail->addReplyTo($email);

        $mail->isHTML(true);
        $mail->Subject='Account Reset Password';
        $mail->Body='<p>Reset Password: </p>'.$password;

        if (!$mail->send()) {
            $mailMeg = 'not send';
        } else {
            $mailMeg = 'send';
            updateResetPassword($conn,$email,$password);
        }
    } catch (phpmailerException $e) {
        print $e;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot password</title>
    <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css"/>
</head>
<body>
    <div class="container">
        <div class="p-4">
            <form method="post">
                <table class="table border rounded">
                    <tr>
                        <td>
                            <label for="">Enter your email</label><input type="email" name="email" class="form-control">
                            <?php if ($validateError != null) { echo '<label for="" class="text-danger">'.$validateError.'</label>'; } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="Send" value="Send" class="btn btn-success">
                        </td>
                    </tr>
                </table>
            </form>
            <?php if ($mailMeg != null) { echo '<div><P>'.$mailMeg.'</P></td></div>'; } ?>
        </div>
    </div>
</body>
</html>
