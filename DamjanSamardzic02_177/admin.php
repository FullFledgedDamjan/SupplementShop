<?php
session_start();
include('config/connection.php');
if(!isset($_SESSION["username"])){
    header('Location:index.php');
}

if (isset($_POST['ban'])){
    $user=$_POST['user'];
    if($user!="null"){
        $upit="UPDATE user SET type=3 WHERE id=".$user;
        $execute = $con->query($upit);

        $name="SELECT username from user where id=".$user;
        $execute = $con->query($name);
        while($row=$execute->fetch(PDO::FETCH_ASSOC)) {
            $message = "User " . $row['username'] . " has been banned";
        }
        echo "<script >alert('$message');</script>";

    }
}


?>
<html>
<head>

    <title>Admin</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;

            background: url(images/ban.jpg);
            background-size:100%;
            background-color: black !important;
            background-repeat: no-repeat;
            background-position: center;
        }
        .header{
            padding: 40px;
            text-align: center;
            background: ;
            color: white;
            font-size: 30px;
        }

        .form{

            margin-top: -100px;
            color:red;
            padding: 10px;
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
        input[type="submit"]:hover,
        input[type="submit"]:focus,
        input[type="button"]:hover
        {
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
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
        input[type=button]{
            float:right;
            font-size: 20px;
            width: 200px;
            background-color: red;
            color: white;
            padding: 14px 20px;
            margin-top: -20px;
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
        .ban{
            width: 200px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #h{
            margin-left: 220px;
            margin-top: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body class="">


<div class="container-fluid" >
    <div class="row justify-content-md-center">

    </div>
</div>

<div class="header">
    <a href="shop.php"><input type="button" value="Go back"></a>
</div>




<div>

    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

        <br><h1 id="h">Ban user for breaking policy: </h1>
        <select class="ban" name="user">
            <option value="null">select a user...</option>
            <?php
            $upit = "SELECT id, username FROM user WHERE type=1";
            $execute = $con->query($upit);
            while ($row = $execute->fetch(PDO::FETCH_ASSOC)){
                echo "<option value='".$row['id']."'>".$row['username']."</option>";
            }
            ?>
        </select>
        <input style="background-color:red" type="submit" value="Ban" name="ban">
    </form>

</div>
</body>
</html>

