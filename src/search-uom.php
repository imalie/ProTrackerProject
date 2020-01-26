<?php
include_once '../controllers/config.inc.php';

$dbQuery = "SELECT uom_code FROM uom WHERE uom_code LIKE '%".$_POST['term']."%' LIMIT 4;";
//get the result from db
$dbResult = mysqli_query($conn, $dbQuery);
// Generate array with skills data
$skillData = array();
if (mysqli_num_rows($dbResult) > 0) {
    while ($row = mysqli_fetch_assoc($dbResult)) {
        $data['id'] = $row['uom_code'];
        $data['value'] = $row['uom_code'];
        array_push($skillData, $data);
    }
}
// Return results as json encoded array
echo json_encode($skillData);