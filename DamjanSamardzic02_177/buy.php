<?php
session_start();
include('config/connection.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once 'models/Supplement.php';
include_once 'models/Supplier.php';
if(!isset($_SESSION["username"])){
    header('Location:index.php');
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
}

if (isset($_POST['submit'])) {
    $id=$_POST['id'];
    $user = $_SESSION['id'];

    $supplier =new Supplier ($con);
    $supplier->user=$user;
    $supplier->supplement=$id;

    $supplier->buy();



    header('Location:shop.php');
}


$supplement=new Supplement($con);
$supplement->id=$id;


$execute = $supplement->buyInfo();
$row = $execute->fetch(PDO::FETCH_ASSOC);
$name=$row['name'];
$price=$row['price'];




?>
<html>
<head>
    <title>Buy</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: url(images/buybuy.png);
            /*background: url(images/b.png);*/

            background-size: cover;

            background-position: center;


        }

        .header{

            text-align: center;
           padding-top: 0px;
            color: white;
            font-size: 30px;
        }
        .form{
            padding: 30px;
            text-align: center;
        }
        input[type=submit]{
            font-size: 20px;
            width: 200px;
            background-color: black;
            color: white;
            padding: 14px 20px;
            margin: 8px 0px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=button]{
            font-size: 20px;
            width: 200px;
            background-color: red;
            color: white;
            padding: 14px 20px;
            margin: 8px 0px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover,
        input[type="submit"]:focus,
        input[type="button"]:hover
        {
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Buy</h1>
    <p>Are you sure you want to purchase <?php echo $name?> for <?php echo $price?> €</p>
</div>
<div class="form">
    <form method="post">
        <input type="hidden" value="<?php echo $id?>" name="id">
        <input type="submit" name="submit" value="Buy"> <a href="shop.php"><input type="button" value="Cancel"></a>
    </form>
</div>
</body>
</html>
