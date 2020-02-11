<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../res/ad/bootstrap.css" />
        <script type="text/javascript" src="../res/ad/jquery.min.js"></script>
        <script type="text/javascript" src="../res/ad/bootstrap.js"></script>
        <title>Images</title>
    </head>
    <body>
    <div class="container pt-4">
        <div class="card-columns">

         
            <?php
            include '../controllers/config.inc.php';

           

            $dbQuery = "SELECT 'img', 'release_date', 'stage_name' FROM stages_img";
            if ($result = mysqli_query($conn, $dbQuery)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                    <div class="card" style="width: 20rem">
                    <img class="card-img-top" alt="Card image cap" src="../doc/img/5e34f9acb06ab9.72079207.png">
                    <div class="card-body">
                    <h5 class="card-title"> satge 1</h5>
                    <p class="card-text">Release Date: 2020</p>
                    </div>
                    </div>';
                    }
                }else {
                    echo '<h4>No Result</h4>';
                }
            }
            ?>
        </div>
    </div>
    </body>
</html>



<!-- '.$row['stage_name'].' -->