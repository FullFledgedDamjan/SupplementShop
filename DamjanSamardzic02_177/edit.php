<?php
session_start();
include('config/connection.php');
include_once 'models/Supplement.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
if(!isset($_SESSION["username"])){
    header('Location:index.php');
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
$nameErr= $newName="";
if(isset($_POST['submit'])){
    if(!empty($_POST['name'])){
            if(strlen($_POST['name'])<=20) {
            $newName = $_POST['name'];
        }else{
            $nameErr = "Name is too long";
            $check = false;
        }
    }else{
        $usernameErr = "Username is empty";
        $check = false;
    }
    if(!empty($_POST['Origin'])){
        $newOrigin= $_POST['Origin'];
    }else{
        $newOrigin="";
    }
    if(!empty($_POST['producer'])){
        $newProducer= $_POST['producer'];
    }
    if(!empty($_POST['price'])){
        $newPrice= $_POST['price'];
    }
    $id=$_POST['id'];









    $supplement =new Supplement ($con);
    $supplement->id=$id;
    $supplement->name=$newName;
    $supplement->price=$newPrice;
    $supplement->company=$newProducer;
    // $supplement->user=$data->user;
    $supplement->supplementType=$newOrigin;

    $supplement->update();
    header('Location:shop.php');
}


$upit = "SELECT * FROM suplements WHERE id=".$id;
$execute = $con->query($upit);
$row = $execute->fetch(PDO::FETCH_ASSOC);
$name=$row['name'];
$origin=$row['supplementType'];
$producer=$row['company'];
$seller=$row['user'];
$price=$row['price'];
?>

<html>
<head>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
    <script>



            $('#aok').on('click','#mrs', function () {

                $.ajax({

                    url: 'api/update.php',
                    method: 'post',
                    data: {
                        id: "<?php echo $id; ?>",
                        name:"<?php echo $newName; ?>",
                        price:"<?php echo $newPrice;?>",
                        company:"<?php echo $newProducer; ?>",
                        supplementType:"<?php echo $newOrigin; ?>"
                    },
                    dataType:"JSON",
                    success:function() {


                        }

                    })
                });





        function checkName() {
            var name = document.getElementById("name").value;
            if(name.length>20){
                document.getElementById("nameErr").innerText="Name is too long";
            }else{
                document.getElementById("nameErr").innerText="";
            }
        }
        function checkPrice() {
            var price =document.getElementById("price").value;
            if(isNaN(price)){
                document.getElementById("priceErr").innerText="That is not a number";
            }else{
                document.getElementById("priceErr").innerText="";
            }
        }




    </script>
    <title>Edit</title>
    <style>
        body {
            font-family: Arial;
            color:red !important;
            margin: 0;
            background:  black !important;
        }
        .header{

            margin-top: -60px;

            background-repeat: no-repeat;
            background-position: center;
            text-align: center;

            color: white;
            font-size: 30px;
        }
        .error{
            color: red;
        }
        input[type=text] {
            width: 200px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .combo{
            width: 200px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 200px;
            background-color: red;
            color: white;
            padding: 14px 20px;
            margin: 20px 0px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form{
            padding: 30px;
            text-align: center;
        }
        input[type="submit"]:hover,
        input[type="submit"]:focus,
        input[type="button"]:hover
        {
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
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
        #back{

        }
    </style>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0">


<body>
<div class="col-s-auto col-md-1 col-lg-12 header">

    <img class="img-responsive" src="images/editt.png" />

</div>


<div class="container-fluid" >
    <div class="row justify-content-md-center">
        <div class="col-xs-auto col-auto col-lg-2  " >
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

        <div class="col-xs-12 col-md-6 col-lg-2 ">   <span>Name&nbsp;&nbsp;&nbsp;&nbsp; </span> <input value="<?php echo $name ?>" type="text" name="name" onkeypress="checkName()"><span class="error"><?php echo $nameErr ?></span></div>
        <div class="col-xs-12 col-md-6 col-lg-2 ">     <span>Origin&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <select class="combo" name="Origin">
            <?php
            $upit = "SELECT name FROM origin WHERE id=".$origin;
            $execute = $con->query($upit);
            $row1 = $execute->fetch(PDO::FETCH_ASSOC);
            echo "<option value='".$origin."'>".$row1['name']."</option>";

            $upit = "SELECT id, name FROM origin WHERE id<>".$origin;
            $execute = $con->query($upit);
            while ($row2 = $execute->fetch(PDO::FETCH_ASSOC)){
                echo "<option value='".$row2['id']."'>".$row2['name']."</option>";
            }
            ?>
        </select></div>

        <div class="col-xs-12 col-md-6 col-lg-2 ">  <span>Producer</span>
        <select class="combo" name="producer">
            <?php
            $upit = "SELECT name FROM company WHERE id=".$producer;
            $execute = $con->query($upit);
            $row3 = $execute->fetch(PDO::FETCH_ASSOC);
            echo "<option value='".$producer."'>".$row3['name']."</option>";

            $upit = "SELECT id, name FROM company WHERE id<>".$producer;
            $execute = $con->query($upit);
            while ($row4 = $execute->fetch(PDO::FETCH_ASSOC)){
                echo "<option value='".$row4['id']."'>".$row4['name']."</option>";
            }
            ?>
        </select></div>

        <?php
        $upit = "SELECT username FROM user WHERE id=".$seller;
        $execute = $con->query($upit);
        $row5 = $execute->fetch(PDO::FETCH_ASSOC);
        $sellerName=$row5['username'];
        ?>
        <div class="col-xs-12 col-md-6 col-lg-2 ">  <span>Supplier&nbsp;</span> <input value="<?php echo $sellerName ?>" type="text" disabled> </div>


        <div class="col-xs-12 col-md-6 col-lg-2 ">   <span>Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <input value="<?php echo $price ?>" type="text" name="price" onkeypress=""></div>
        <div id="aok" class="col-xs-12 col-md-6 col-lg-1 ">  <input type="submit" name="submit" value="Save changes" id="mrs"></div>

        <div class="col-xs-12 col-md-6 col-lg-1 ">   <a href="shop.php"><input type="button" value="Back" id="back"></a></div>

        <div class="col-xs-12 col-md-6 col-lg-2 ">  <input type="hidden" name="id" value="<?php echo $id ?>"></div>

    </form>
        </div>
</div>
    </div>
</div>
</body>
</html>