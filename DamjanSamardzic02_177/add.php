<?php
session_start();
include('config/connection.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once 'models/Supplement.php';


if (!isset($_SESSION["username"])) {
    header('Location:index.php');
}
$originErr=$nameErr=$priceErr=$producerErr=$name=$price="";
$check=true;
if (isset($_POST['submit'])) {
    if(!empty($_POST['name'])){
        if(strlen($_POST['name'])<=20) {
            $name = $_POST['name'];
        }else{
            $nameErr = "Name is too long";
            $check = false;
        }
    }else{
        $nameErr = "Name is empty";
        $check = false;
    }

    if(!empty($_POST['price'])){
        if(!is_numeric($_POST['price'])) {
            $priceErr="That is not  number";
            $check = false;
        }else {
            if (strlen($_POST['price']) <= 11) {
                $price = $_POST['price'];
            } else {
                $priceErr = "Price is too high";
                $check = false;
            }
        }
    }else{
        $priceErr = "Price is empty.";
        $check = false;
    }

    if($_POST['origin']!='null'){
        $origin=$_POST['origin'];
    }else{
        $originErr="Choose  origin.";
        $check = false;
    }

    if($_POST['producer']!='null'){
        $producer=$_POST['producer'];
    }else{
        $producerErr="Choose  produ.";
        $check = false;
    }
    if(isset($_POST['id'])){
        $id=$_POST['id'];
    }

    if($check) {
        $supplement =new Supplement ($con);

        $supplement->name=$name;
        $supplement->price=$price;
        $supplement->company=$producer;
        $supplement->user=$_POST['id'];
        $supplement->supplementType=$origin;

        $supplement->add();


        header('Location:shop.php');
    }else{

    }
}
?>
<html>
<head>
    <script>
        $(document).ready(function(){
            $('#mrss').click(function () {

                $.ajax({

                    url: 'api/addSup.php',
                    method: 'POST',
                    data: {
                        name: "<?php echo $name?>",
                        price:"<?php echo $price?>",
                        company:"<?php echo $producer?>",
                        user:"<?php echo $id?>",
                        supplementType:"<?php echo $origin?>"
                    },
                    dataType:"JSON",
                    success:function(data) {



                    }

                }
            });
        });
        })


        function checkName() {
            var username = document.getElementById("name").value;
            if(username.length>20){
                document.getElementById("nameErr").innerText="Name is too long";
            }else{
                document.getElementById("nameErr").innerText="";
            }
        }
        function checkPrice() {
            var price =document.getElementById("price").value;
            if(isNaN(price)){
                document.getElementById("priceErr").innerText="That is not api number";
            }else{
                document.getElementById("priceErr").innerText="";
            }
        }
    </script>
    <title>Sell</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
            color:red !important;
            background-color:black !important;

        }
        .header{

            /*background: url(images/s1.png);*/
            background-size: auto;
            background-repeat: no-repeat;
            background-position: center;

            padding: 0px;
            text-align: center;
            background: ;
            color: white;
            font-size: 30px;
        }
        .error{
            color: red;
        }
        .form{
            padding: 30px;
            text-align: center;
        }
        input[type=text], input[type=password] {
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
            margin: 8px 0px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
        input[type=button]{

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
        input[type="button"]:hover
        {
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
        }
        #h{
        padding-top: -40px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<div class="col-xs-auto col-md-auto col-lg-12 header">
    <img class="img-responsive" src="images/s1.png" />
    <h1 id="h"></h1> </br>


</div>
<div class="container-fluid" >
    <div class="row justify-content-md-center">
        <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">

             <div class="col-xs-12 col-md-6 col-lg-12 "><span>Name&nbsp;&nbsp;&nbsp;&nbsp;    </span><input type="text" name="name" placeholder="name.." value="<?php echo $name?>" onkeypress="checkName()"><span class="error">  <?php echo $nameErr?></span></div>


               <div class="col-xs-12 col-md-6 col-lg-12 ">     <span>&nbsp; Price&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" name="price" placeholder="price.." value="<?php echo $price ?>"><span class="error" onkeypress="checkPrice()">  <?php echo $priceErr?></span></div>


               <div class="col-xs-12 col-md-6 col-lg-12  ">        <span>&nbsp;Origin&nbsp;&nbsp;&nbsp;</span>  <select class="combo" name="origin">
                   <option value="null">select a origin...</option>
                   <?php
                   $upit = "SELECT id, name FROM origin";
                   $execute = $con->query($upit);
                   while ($row1 = $execute->fetch(PDO::FETCH_ASSOC)){
                       if ($_POST['origin'] == $row1['id']){
                           $temp= 'selected="'.$row1['id'].'"';
                       }
                       echo "<option value='".$row1['id']."' ".$temp.">".$row1['name']."</option>";
                       $temp="";
                   }
                   ?>
                   </select><span class="error">  <?php echo $originErr?></span> </div>

               <div class="col-xs-12 col-md-6 col-lg-12  ">
               <span>Producer</span>
               <select class="combo" name="producer">
                   <option value="null">select the producer...</option>
                   <?php
                   $upit = "SELECT id, name FROM company";
                   $execute = $con->query($upit);
                   while ($row2 = $execute->fetch(PDO::FETCH_ASSOC)){
                       if ($_POST['producer'] == $row2['id']){
                           $temp= 'selected="'.$row2['id'].'"';
                       }
                       echo "<option value='".$row2['id']."' ".$temp."> ".$row2['name']."</option>";
                       $temp="";
                   }
                   ?>
               </select><span class="error">  <?php echo $producerErr?></span></div>


               <div class="col-xs-12 col-md-6 col-lg-12  "><span>&nbsp;&nbsp;&nbsp; </span>       <input name="submit" type="submit" value="Add" id="mrss">
               </div>

               <div class="col-xs-12 col-md-6 col-lg-12 "><span>&nbsp;&nbsp;&nbsp; </span>
                   <a href="shop.php"><input type="button" value="Go back"></a> </div>

        <div class="col-xs-12 col-md-6 col-lg-12  ">


        </div>

        <div class="w-100"></div>

           </form>

    </div>
</div>

<div class="nani">


</div>
</body>
</html>

