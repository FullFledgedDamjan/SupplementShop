<?php
include ('../config/connection.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
include_once '../models/Supplement.php';



$upit = "SELECT s.name AS name, o.name AS origin, c.name AS producer, sup.user AS user, s.price AS price,s.id AS id
FROM suplements s, origin o, company c, user u, supplier sup
WHERE s.supplementType = o.id AND s.company = c.id AND s.user = u.id
AND s.id =sup.supplement";
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
            'price' => $row['price'],
            'user' => $row['user'],
            'id'=>$row['id']
        );
        array_push($supArr,$supItem);
    }
    echo json_encode($supArr);
}




?>