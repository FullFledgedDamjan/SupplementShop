<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
include_once '../config/Database.php';
include_once '../models/Supplement.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];
}

$database=new Database();
$db=$database->connect();

$supplement =new Supplement ($db);

$data=json_decode(file_get_contents("php://input"));

//$supplement->id=$data->id;
$supplement->id=$id;

if($supplement->delete()) {
    echo json_encode(
        array('message'=>'Sup deleted')
    );
    header('Location:../shop.php');

}else{
    echo json_encode(
        array('message'=>'Sup not  deleted')
    );
    header('Location:../shop.php');
}
