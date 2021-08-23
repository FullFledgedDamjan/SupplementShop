
<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

if(!isset($_POST['id']) && !isset($_POST['name'])) {
    $sql2 = "SELECT c.name, s.name, s.price, s.id, c.name as company, s.user, s.supplementType FROM suplements s, company c WHERE c.id = s.company";
    $stmt = $db->prepare($sql2);
    $stmt->execute();

    $output = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $outputItem = array(
            'name' => $row['name'],
            'company' => $row['company'],
            'price' => $row['price'],
            'user'=>$row['user'],
            'supplementType'=>$row['supplementType']

        );
        array_push($output, $outputItem);
    }

    echo json_encode($output);
//    echo json_encode(array('message' => "Nothing"));
    die();
}

$id = $_POST['id'];
$name = $_POST['name'];

if($id == "ori"){
    $sql2 = "SELECT c.name, s.name, s.price, s.id FROM suplements s, company c WHERE c.id = s.company AND name LIKE '%$name%'";
    $stmt = $db->prepare($sql2);
    $stmt->execute();

    $output = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $outputItem = array(
            'name' => $row['name'],
            'company' => $row['company'],
            'price' => $row['price'],
            'user'=>$row['user'],
            'supplementType'=>$row['supplementType']
        );
        array_push($output, $outputItem);
    }

    echo json_encode($output);
//    echo json_encode(array('message' => "Nothing"));
    die();
}

$content = file_get_contents('http://localhost/DamjanSamardzic02_177/api/supplement/readSupplementsWithCompany.php?id=' . $id);
$json = json_decode($content, true);

$sql2 = "SELECT * FROM suplements WHERE company = '$id' and name like '%$name%' ORDER BY price DESC, name DESC";
$stmt = $db->prepare($sql2);
$stmt->execute();

$output = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $outputItem = array(
        'name' => $row['name'],
        'company' => $row['company'],
        'price' => $row['price'],
        'user'=>$row['user'],
        'supplementType'=>$row['supplementType']
    );
    array_push($output, $outputItem);
}

echo json_encode($output);