<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
include_once '../config/Database.php';
include_once '../models/Supplement.php';
include_once '../config/connection.php';

$database=new Database();
$db=$database->connect();

$supplement =new Supplement ($con);

//$data=json_decode(file_get_contents("php://input"));

//$supplement->id=$data->id;
//$supplement->name=$data->name;
//$supplement->price=$data->price;
//$supplement->company=$data->company;
//$supplement->user=$data->user;
//$supplement->supplementType=$data->supplementType;
if(!empty($_POST['price'])){
    $newPrice= $_POST['price'];
}

$supplement->id=$_POST['id'];
$supplement->name=$_POST['name'];
$supplement->price=$_POST['price'];
$supplement->company=$_POST['company'];
//$supplement->user=$_POST['user'];
$supplement->supplementType=$_POST['supplementType'];

if($supplement->update()) {
    echo json_encode(
        array('message'=>'Supplement Updated')
    );

}else{
    echo json_encode(
        array('message'=>'Supplement not  Updated')
    );
}
?>