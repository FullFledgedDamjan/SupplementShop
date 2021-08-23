<?php

//header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');
//header('Access-Control-Allow-Methods: POST');
//header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

$error = false;
$username = $data->username;
$username = htmlspecialchars(strip_tags($username));



$password = $data->password;
$password = htmlspecialchars(strip_tags($password));

$type = $data->type;
$type = htmlspecialchars(strip_tags($type));

if (empty($username)) {
    $error = true;
    echo json_encode(
        array('message' => 'Please enter your username.')
    );
    die();
}

if (empty($type)) {
    $error = true;
    echo json_encode(
        array('message' => 'Please enter your type.')
    );
    die();
}
if (empty($password)) {
    $error = true;
    echo json_encode(
        array('message' => 'Please enter your password.')
    );
    die();
}

if(strlen($password) < 6) {
    $error = true;
    echo json_encode(
        array('message' => 'Password must contain at least 6 characters.')
    );
    die();
}

//$password = md5($password);

if (!$error) {
    $sqlCheck = "SELECT * FROM user WHERE username = '$username'";
    $check = $db->prepare($sqlCheck);
    $check->execute();
    $data = $check->rowCount();

    if ($data == 0) {
        $sql = "INSERT INTO user(username, password, type)
                VALUES ('$username', '$password', '$type')";
        $stmt = $db->prepare($sql);
        if ($stmt->execute()) {
            echo json_encode(
                array('message' => 'Successfully registered!')
            );
        }
    } else {
        echo json_encode(
            array('message' => 'User already exists!')
        );
    }
}
