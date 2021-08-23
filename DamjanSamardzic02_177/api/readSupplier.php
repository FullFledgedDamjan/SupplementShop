<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Supplement.php';

$database = new Database();
$db = $database->connect();

$supplement = new Supplement($db);

$result = $supplement->readSupplier();
$num = $result->rowCount();
if($num > 0) {
    $arrayMan = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arrayItem = array(
            'id' => $row['id'],
            'user'       => $row['user'],
            'supplement'       => $row['supplement']

        );
        array_push($arrayMan, $arrayItem);
    }
    echo json_encode($arrayMan);
}