<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Users.php';


$database = new Database();
$db = $database->connect();

$user = new Users($db);


$result = $user->read();
$num = $result->rowCount();
if($num > 0) {
    $arrayMan = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arrayItem = array(
            'id' => $row['id'],
            'username'       => $row['username'],
            'password' => $row['password'],
            'type' => $row['type'],

        );
        array_push($arrayMan, $arrayItem);
    }
    echo json_encode($arrayMan);
}

?>