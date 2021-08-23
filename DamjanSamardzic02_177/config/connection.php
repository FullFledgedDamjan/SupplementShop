<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$baza = 'gym';

try {
    $con = new PDO('mysql:host=' . $server . ';dbname=' . $baza, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    echo 'Connectionz Error ' . $e->getMessage();
}
return true;

//$con = new mysqli($server,$user,$pass,$baza);




