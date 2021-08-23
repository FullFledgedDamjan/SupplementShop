<html>
<head></head>
<body>
<a><?php echo $company?> hehe mrs </a>
</body>
</html>
<?php

include_once '../../config/Database.php';
include_once '../../models/Supplement.php';


$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

$supplement = new Supplement($db);

$name = $data->name;
$price = $data->price;

$company =$data->producer; // nmg ovo konvertovat u INT nikako
$user= $data->user;
$supplementType=$data->supplementType;

//$mrs=(int)$company;
//$company=+$company;

$supplement->name = $name;
$supplement->price = $price;

$supplement->company = $company; //

echo $company;
$supplement->user=$user;
$supplement->supplementType=$supplementType;


if($supplement->create()) {
    echo json_encode(
        array('message' => 'Sup Created')
    );
} else {
    echo json_encode(
        array('message' => 'Sup Not Created')
    );
}

?>

