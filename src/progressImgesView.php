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

            $stage_id = $_GET['id'];

            $dbQuery = "SELECT stages_img.img,stages_img.release_date,stages.stage_name FROM stages_img JOIN stages ON stages_img.stages_id = stages.stage_id WHERE stages_img.stages_id = '".$stage_id."';";
            if ($result = mysqli_query($conn, $dbQuery)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                    <div class="card" style="width: 20rem">
                    <img class="card-img-top" alt="Card image cap" src="../doc/img/'.$row['img'].'">
                    <div class="card-body">
                    <h5 class="card-title">'.$row['stage_name'].'</h5>
                    <p class="card-text">Release Date: '.$row['release_date'].'</p>
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