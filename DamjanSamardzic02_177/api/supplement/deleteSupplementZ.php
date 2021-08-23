<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Supplement.php';

$name = $_GET['name'];
$database = new Database();
$db = $database->connect();


$supplement = new Supplement($db);

$supplement->name = $name;

$supplement->read_single();



if($supplement->deleteZ()) {
    echo json_encode(
        array('message' => 'Supplement removed')
    );
} else {
    echo json_encode(
        array('message' => 'Supplement Not Deleted')
    );
}

