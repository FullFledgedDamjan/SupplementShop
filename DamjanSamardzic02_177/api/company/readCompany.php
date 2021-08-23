<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$result = $company->read();
$num = $result->rowCount();
if($num > 0) {
    $arrayMan = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arrayItem = array(
            'id' => $row['id'],
            'name'       => $row['name']

        );
        array_push($arrayMan, $arrayItem);
    }
    echo json_encode($arrayMan);
}

?>
