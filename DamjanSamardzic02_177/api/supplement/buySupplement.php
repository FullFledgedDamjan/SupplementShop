<?php
session_start();
include('config/connection.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//include_once 'models/Supplement.php';
include_once '../../models/Supplier.php';

include_once '../../config/Database.php';
include_once '../../models/Supplement.php';

//if(isset($_GET['id'])){
//    $id=$_GET['id'];
//}
//
//
//    $id=$_POST['id'];
$database = new Database();
$db = $database->connect();
$supplier =new Supplier ($db);

    $id=$_GET['supplement'];
    $user = $_GET['user'];

    $supplier->user=$user;
    $supplier->supplement=$id;

    $supplier->buy();



