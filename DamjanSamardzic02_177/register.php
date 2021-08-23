<?php
session_start();
include('config/connection.php');
if(isset($_SESSION["username"]) && $_SESSION["type"]!=3){
    header('Location:shop.php');
}
$usernameErr =$username=$password= $passwordErr=$email=$emailErr = "";
$check = true;

if (isset($_POST['submit'])) {
    if(!empty($_POST['username'])){
        if(strlen($_POST['username'])<=20) {
            $username = $_POST['username'];
        }else{
            $usernameErr = "Username is too long";
            $check = false;
        }
    }else{
        $usernameErr = "Username is empty";
        $check = false;
    }

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $email = $_POST['email'];
    }else {
        $emailErr = "Email is empty";
        $check = false;
    }



    if(!empty($_POST['password'])){
        if(strlen($_POST['password'])>=3) {
            $pw=$_POST['password'];
            $pw2=$_POST['password2'];
            if ($pw==$pw2) {

                $password = $_POST['password'];
            } else {
                $passwordErr = "Password doesnt match";
                $check = false;
            }


        }else{
            $passwordErr = "Password is too short";
            $check = false;
        }
    }else{
        $passwordErr = "Password is empty";
        $check = false;
    }







    if($check) {

        $check1=true;
        $upit = "SELECT username FROM user";
        $execute = $con->query($upit);
        while ($row1 = $execute->fetch(PDO::FETCH_ASSOC)){
            if (strtolower($username) == strtolower($row1['username'])){
                $check1=false;
                $usernameErr="User with that name already exists.";
                break;
            }
        }
        if ($check1) {
            $sql = "INSERT INTO user(id, username, password, type) VALUES (NULL,'" . $username . "','" . $password . "',1)";
            $execute = $con->query($sql);


            header('Location:index.php');
        }


    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script>
        function checkUsername() {
            var username = document.getElementById("username").value;
            if(username.length>10){
                document.getElementById("usernameErr").innerText="Username is too long JS";
            }else{
                document.getElementById("usernameErr").innerText="";
            }
        }

        function checkPassword() {
            var password = document.getElementById("password").value;
            if(password.length>10){
                document.getElementById("passwordErr").innerText="Password is too long JS";
            }else{
                document.getElementById("passwordErr").innerText="";
            }
        }
    </script>
    <style>
        body
        {

            margin: 0;

            padding:20px;

            font-size: 16px;
            color: #777;
            font-family: sans-serif;
            font-weight: 300;



            background: url(images/c2.jpg);
            background-size: cover;
            background-position: center;
            font-family: sans-serif;

        }



        h1
        {
            margin: 0 0 20px 0;
            font-weight: 300;
            font-size: 28px;
        }

        input[type="text"],
        input[type="password"]
        {
            display: block;
            box-sizing: border-box;
            margin-bottom: 20px;
            padding: 4px;
            width: 220px;
            height: 32px;
            border: none;
            outline: none;
            border-bottom: 1px solid #aaa;
            font-family: sans-serif;
            font-weight: 400;
            font-size: 15px;
            transition: 0.2s ease;
        }

        input[type="submit"]
        {
            margin-bottom: 28px;
            width: 100px;
            height: 32px;
            background: #f44336;
            border: none;
            border-radius: 2px;
            color: #fff;
            font-family: sans-serif;
            font-weight: 500;
            text-transform: uppercase;
            transition: 0.2s ease;
            cursor: pointer;

        }



        input[type="submit"]:hover,
        input[type="button"]:hover
        {
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
        }
        /*#login-box*/
        /*{*/
        /*    position: relative;*/
        /*    top:10vh;*/
        /*    margin: 5% auto;*/
        /*    height: 420px;*/
        /*    width: 600px;*/

        /*//   background: #fff;*/
        /*    background: #000;*/
        /*    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);*/

        /*}*/

        /*.left-box*/
        /*{*/
        /*    position: absolute;*/
        /*    top: 0;*/
        /*    left: 0;*/
        /*    box-sizing: border-box;*/
        /*    padding: 40px;*/
        /*    width: 300px;*/
        /*    height: 420px;*/
        /*}*/

        .right-box
        {
            position: absolute;
            top: 0;
            right: 0;
            box-sizing: border-box;
            padding: 40px;
            width: 300px;
            height: 420px;
            background-image: url(images/wat.png);
            background-size: cover;
            background-width:50%;
            background-position: center;
        }



        .right-box
        {
            display: block;
            margin-bottom: 40px;
            font-size: 28px;
            color: #fff;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        }



        .error{
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .loginbox{
            width: 320px;
            height: 620px;
            background: #000;
            color: #fff;
            top: 40vh;
            left: 50%;
            position: absolute;
            transform: translate(-50%,-50%);
            box-sizing: border-box;
            padding: 70px 30px;
        }

        .loginbox p{
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        .loginbox input{
            width: 100%;
            margin-bottom: 20px;
        }

        .loginbox input[type="text"], input[type="password"]
        {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
        }
        .loginbox input[type="submit"]
        {
            border: none;
            outline: none;
            height: 40px;
            background: #fb2525;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
        }
        .loginbox input[type="button"]
        {
            border: none;
            outline: none;
            height: 40px;

            color: black;
            font-size: 18px;
            border-radius: 20px;
        }
        .loginbox input[type="submit"]:hover,input[type="button"]:hover
        {
            cursor: pointer;
            background: #ffc107;
            color: #000;
        }
        .loginbox a{
            text-decoration: none;
            font-size: 12px;
            line-height: 20px;
            color: darkgrey;

        }

        .loginbox a:hover
        {
            color: #ffc107;
        }
        .b{
            border: none;
            width: 100px;
            height: 32px;
            float:;
        }

    </style>


</head>
<body>
<section class="container-fluid" >
    <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-3">

                <div class="loginbox">
                    <h1> Register</h1>
                    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <input type="text" id="username" name="username"  placeholder="Username"  value="<?php echo $username?>" onkeypress="checkUsername()"/><div class="error" id="usernameErr"><?php echo $usernameErr?></div>

                        <input type="text" name="email"  placeholder="Email "  value="<?php echo $email?>"/><div class="error"><?php echo $emailErr ?></div>

                        <input type="password"  id="password" name="password"  placeholder="Password" value="<?php echo $password?>" onkeypress="checkPassword()"/><div class="error" id="passwordErr"><?php echo $passwordErr?></div>

                        <input type="password"   name="password2" placeholder="Retype password" value="<?php echo $password?>"/><div class="error" id="passwordErr"><?php echo $passwordErr?></div>

                        <input type="submit" name="submit" value="Register"/>

                        <a href="index.php"><input type="button" value="Go back" class="b"></a>
                    </form>



            </div>
        </section>
    </section>
</section>


</body>


</html>
