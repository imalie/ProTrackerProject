
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pro Tracker| Forgot my password</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./res/css/bootstrap.min.css">
        <link rel="stylesheet" href="./res/css/main.css">
        <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
        <style>
            body {
                background-image: url("res/images/background.jpg") !important;
                background-repeat: no-repeat;
                background-position-y: center;
            }
        </style>
    </head>
    <body>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 model-box">
                    <div class="model-box-content">
                        <form method="post" action="">
                            <div class="row" style="text-align: center">
                                <label for="heading">
                                    <div class="row">
                                    <img src="res/images/logo.png" height="120px" width="250px" style="padding-bottom : 20px">
                                    <br>
                                    </div>


                                </label>
                            </div>
                            <!-- <span class="error_msg"> <?php echo $errorMsg; ?></span> -->
                            <div class="row" style="padding-bottom : 10px">
                                <p align="center">Enter your email or phone number and we'll send you a link to get into your account.</p>
                            </div>
                            <div class="row" style="padding-bottom : 10px">
                                <input type="email" name="userEmail" id="input" class="form-control" placeholder="Email" title="Email">
                            </div>
                            
                             <div class="row">
                                <p align="center">or</p>
                            </div>

                            <div class="row">
                                <input type="password" name="PhoneNumber" id="input" class="form-control" placeholder="Phone Number" title="Phone Number">
                            </div>
                            <br>
                            <div class="row">
                                <button type="submit" name="submit" class="btn btn-large btn-block btn-primary">Send Login Link</button>
                            </div>
                            <div class="row">
                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>