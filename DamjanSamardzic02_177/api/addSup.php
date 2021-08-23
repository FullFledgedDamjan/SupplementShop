<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
include_once '../config/Database.php';
include_once '../models/Supplement.php';

$database=new Database();
$db=$database->connect();

$supplement =new Supplement ($db);

$supplement->name=$_POST['name'];
$supplement->price=$_POST['price'];
$supplement->company=$_POST['company'];
$supplement->user=$_POST['user'];
$supplement->supplementType=$_POST['supplementType'];

if($supplement->add()) {
    echo json_encode(
        array('message'=>'Supplement added')
    );

}else{
    echo json_encode(
        array('message'=>'Supplement not  added')
    );
}