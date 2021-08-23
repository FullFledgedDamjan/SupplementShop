
<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once '../config/Database.php';
    include_once '../models/Supplement.php';

    $database=new Database();
    $db=$database->connect();

    $supplement =new Supplement ($db);

    $result =$supplement->read();

    $num=$result->rowCount();

    if($num>0){
    $supplement_arr=array();
    $supplement_arr['data']=array();

    while($row=$result->fetch(PDO::FETCH_ASSOC)){


    $supplement_item=array(

        'id'=>$row['id'],
        'name'=>$row['name'],
        'price'=>$row['price'],
        'company_name'=>$row['company_name'],
        'user'=>$row['user'],
        'supplementType'=>$row['supplementType']



    );
    array_push($supplement_arr['data'],$supplement_item);

    }
    echo json_encode($supplement_arr);

    }else{
    echo json_encode(
        array('message'=>'No supps found')
    );
    }

