<?php
include('../config/connection.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
include_once '../models/Supplement.php';
//include_once 'api/Database.php';


$supplement =new Supplement ($con);

$supplement->id=isset($_GET['id']) ? $_GET['id'] : die();

$execute = $supplement->info();

$num=$execute->rowCount();
if($num>0) {
    $supArr = array();
    $supArr = array();



    while ($row = $execute->fetch(PDO::FETCH_ASSOC)) {
    $supItem=array(
        'name' => $row["name"],
        'company' => $row['company'],
       'origin' => $row['origin'],
        'producer' => $row['producer'],
        'seller' => $row['seller'],
        'price' => $row['price']
    );
    array_push($supArr,$supItem);
    }
    echo json_encode($supArr);
}

?>