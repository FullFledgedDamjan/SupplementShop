<?php
session_start();
include('config/connection.php');

if(isset($_SESSION["username"]) && $_SESSION["type"]!=3){
    header('Location:shop.php');
}
$usernameErr =$username=$password= $passwordErr = "";
$check = true;






if (isset($_POST['submit'])) {
    if(!empty($_POST['username'])){
        $username = $_POST['username'];
    }else{
        $usernameErr = "Username is empty";
        $check = false;
    }
    if(!empty($_POST['password'])){
        $password = $_POST['password'];
    }else{
        $passwordErr = "Password is empty";
        $check = false;
    }
    if($check) {
        $upit = "SELECT * FROM user";
        $execute = $con->query($upit);
        while ($row = $execute->fetch(PDO::FETCH_ASSOC)) {
            try {
                if ($row['username'] == $username && $row['password'] == $password) {
                    $_SESSION["username"] = $username;
                    $_SESSION["type"] = $row['type'];
                    if ($_SESSION['type'] == 3) {
                        $message = "Your account has been temporarily suspended, please contact support  ";
                        echo "<script >alert('$message');</script>";
                        session_unset();
                        session_destroy();
                   die("Connection error");

                        header('Location:index.php');
                    }
                    $_SESSION["id"] = $row['id'];


                    $write = $username . ";" . $row['type'] . ";" . $row['id'] . "\n";
                    $users = fopen("recentUsers.csv", "api");
                    fwrite($users, $write);
                    //close($users);


                    header('Location:shop.php');
                }
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        $passwordErr = "Wrong information";
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
    <style>
        body{


            color: white;
            margin: 0;
            padding: 0;
            background: url(images/c2.jpg);
            background-size: cover;
            background-position: center;
            font-family: sans-serif;
            background-position-y: 50px;
        }


        .avatar{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: absolute;
            top: -50px;
            left: calc(50% - 50px);
        }

        h1{
            margin: 0;
            padding: 0 0 20px;
            text-align: center;
            font-size: 22px;
        }

        .form-container{
            padding:
        }

        .header{
            margin: 0;
            padding: 0;
            background: url(images/he.png);

            background-size: cover;
            background-position: center;

            font-family: "Comic Sans MS", cursive, sans-serif;
            font-size: 30px;
            letter-spacing: 2px;
            word-spacing: 2px;

            font-weight: normal;
            text-decoration: none;
            font-style: normal;
            font-variant: normal;
            text-transform: none;

            padding: 10px;
            text-align: center;
            background:  red;
            color: white;

        }
        .cookie{
            margin-top: -150px;
        }
        .error{
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .cookie input[type="submit"]
        {
            border: none;
            outline: none;
            height: 40px;
            background: white;
            color: black;
            font-size: 14px;
            border-radius: 20px;
        }
        .cookie input[type="submit"]:hover
        {
            cursor: pointer;
            background: #ffc107;
            color: #000;
        }
        .nas{
            position
        }

        .loginbox{
            width: 320px;
            height: 440px;
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
    </style>

    <title>Welcome</title>
</head>
<body>

<!-- nAvigation-->
<nav class=" sticky-top header">
    <div class="container-fluid">

        <p class="nas">WELCOME TO THE BIGGEST ONLINE SUPPLEMENT MARKET</p>
    </div>
</nav>

<!--<div class="header">-->
<!--    WELCOME-->
<!--    <p>TO THE BIGGEST ONLINE SUPPLEMENT MARKET</p>-->
<!--</div>-->

<section class="container-fluid" >
    <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-3">r
            <div class="loginbox">
                <img src="images/avatar.png" class="avatar">
                <h1>Login Here</h1>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-container">
                    <p>Username</p>

                    <input type="text" id="username" name="username" value="<?php echo $username?>" placeholder="Enter Username"><div class="error"><?php echo $usernameErr?></div>
                    <p>Password</p>

                    <input type="password" id="password" name="password" value="<?php echo $password?>" placeholder="Enter Password"><div class="error"><?php echo $passwordErr?></div>

                    <input name="submit" type="submit" value="Login"><span> </span><a href="register.php"><input type="button" value="Register"></a>

                </form>

            </div>
        </section>
    </section>
</section>

</div>

   </body>
   </html>
