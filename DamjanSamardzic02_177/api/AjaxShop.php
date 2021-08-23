<?php
include ('../config/connection.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
include_once '../models/Supplement.php';



$upit = "SELECT s.name AS name, o.name AS origin, c.name AS producer, u.username AS seller, s.price AS price,s.id AS id
FROM suplements s, origin o, company c, user u 
WHERE s.supplementType = o.id AND s.company = c.id AND s.user = u.id
AND s.id NOT IN( SELECT supplement FROM supplier)";

    if(!empty($_POST['searchName'])){
        $searchName=$_POST['searchName'];
        $upit .= " AND s.name LIKE '".$searchName."%'";
    }else{
        $upit .= " AND s.name LIKE '%'";
    }


if(!empty($_POST['searchOrigin'])){

        $searchOrigin=$_POST['searchOrigin'];
        $upit .=" AND s.supplementType=".$searchOrigin;

    }else{
        $upit .=" AND s.supplementType LIKE '%'";

    }


    if(!empty($_POST['searchProducer'])){
        $searchProducer=$_POST['searchProducer'];
        $upit .=" AND s.company=".$searchProducer;
    }else{
        $upit .=" AND s.company LIKE '%'";
    }



//$sessionType=isset($_POST['sessionType']) ? $_POST['sessionType'] : die();
if(!empty($_POST['sessionType'])){
    $sessionType=$_POST['sessionType'];
}else{
    $sessionType="";
}

if(!empty($_POST['sessionUserName'])){
    $sessionUserName=$_POST['sessionUserName'];
}else{
    $sessionUserName="";
}

//$sessionUserName = $_POST['sessionUserName'];

$execute = $con->query($upit);

$num=$execute->rowCount();

if($num>0) {
    $supArr = array();
    $supArr = array();


    while ($row = $execute->fetch(PDO::FETCH_ASSOC)) {
        $supItem=array(
            'name' => $row["name"],
            'origin' => $row['origin'],
            'producer' => $row['producer'],
            'seller' => $row['seller'],
            'price' => $row['price'],
            'sessionType'=>$sessionType,
            'sessionUserName'=>$sessionUserName,
            'id'=>$row['id']
        );
        array_push($supArr,$supItem);
    }
    echo json_encode($supArr);
}




?>
