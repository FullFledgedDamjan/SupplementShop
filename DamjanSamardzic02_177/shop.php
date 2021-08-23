<?php
session_start();
include('config/connection.php');
if(!isset($_SESSION["username"])){
    header('Location:index.php');
}
$searchName="";
if(!empty($_POST['searchName'])){
    $searchName=$_POST['searchName'];
}
$sessionType="";
if(!empty($_SESSION['type'])){
    $sessionType=$_SESSION['type'];
}

$sessionUserName="";
if(!empty($_SESSION["username"])){
    $sessionUserName=$_SESSION["username"];
}
//
//$sessionType=$_SESSION['type'];
//$sessionUserName=$_SESSION['username'];

?>
<html>
<header>
    <title>Shop</title>
    <style>
        .table {
            background: rgba(255,255,255,0.5);
            margin: auto;
            border-collapse: collapse;
            width: 100%;
            height: ;

        }

        .table td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;

        }

        .table tr:nth-child(odd){background-color: white;}

        .table tr:hover {background-color: #ddd;}

        .table th {

            padding-left: 10px;
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            text-align: left;
            background-color:rgba(255,0,0,0.6);
            color: white;

        }

        input[type=button] {
            float: right;
            padding-top: -150px;
            background-color: black;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin:1px;
        }

        body {
            padding: 0px;
            font-family: Arial;
            margin: 0px;

            background: url(images/ar.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;


        }

        .header{
            /*background: url(images/bst.jpg);*/
            background-size: auto;
            background-size: 70%;
            position: -webkit-sticky; /* Safari */
            /*position: fixed;*/
            top: 0;
            background-size: cover;
            width: 100%;
            background-position: center;
            padding: 100px;
            padding-bottom: 183px;

            text-align: center;
            background: ;
            color: white;
            font-size: 30px;
            margin-bottom: 0px;

        }
        input[type=text] {
            width: 130px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 200px;
            background-color: black;
            color: white;
            padding: 14px 20px;
            margin: 8px 0px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .combo{
            width: 130px;
            padding: 8px 16px;
            margin: 3px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #admin {
            margin-right: -70px;
            background-color:rgba(214, 69, 65, 1);
            margin-top: -60px;

        }
        #admin:hover{
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
        }
        .right{


        }
        input[type="submit"]:hover,
        input[type="button"]:hover
        {
        {
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
        }
        .h{
            color:red;
        }
        .h:hover{

            color: #ffc107;
            transition: 0.2s ease;
        }

        }
        .a{
            padding-top: 1px;
        }
       #re{
           margin-top: -100px;
       }
    </style>

</header>

<head>    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>



<div class="container-fluid " >
    <div class="row justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12">
         
<div class="header">
    <h1>Supplement Shop</h1>
    <p class="right">Welcome <?php echo $_SESSION["username"] ?>, <a href="logout.php" style="color:rgba(255,0,0,0.6)" class="h">Logout</a>  </br>
        <?php
        if($_SESSION['type']==2){
            echo "<p>";
            echo "<a href='admin.php' class='settings'><input id='admin' value='settings' type='button' ></a>";
            echo "</p>";
        }
        ?>
    </p>

</div>
        </div>
    </div>
</div>



<div class="container-fluid a" id="re">
    <div class="row justify-content-center ">
<div class="col-sm-6 col-md-12 col-lg-12">

<table class="table" border="1" id="try">
    <tr>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <th><input type="text" name="searchName" placeholder="name..." value="<?php echo $searchName ?>" id="searchName"> </th>
            <th><select class="combo" name="searchOrigin" id="searchOrigin">
                    <option value="">any origin</option>
                    <?php
                    $upit = "SELECT id, name FROM origin";
                    $execute = $con->query($upit);
                    while ($row1 = $execute->fetch(PDO::FETCH_ASSOC)){
                        if ($_POST['searchOrigin'] == $row1['id']){
                            $temp= 'selected="'.$row1['id'].'"';
                        }
                        echo "<option value='".$row1['id']."' ".$temp.">".$row1['name']."</option>";
                        $temp="";
                    }
                    ?>
                </select></th>
            <th id="producer">
                <select class="combo" name="searchProducer" id="searchProducer">
                    <option value="">any producer</option>
                    <?php
                    $upit = "SELECT id, name FROM company";
                    $execute = $con->query($upit);
                    while ($row2 = $execute->fetch(PDO::FETCH_ASSOC)){
                        if ($_POST['searchProducer'] == $row2['id']){
                            $temp= 'selected="'.$row2['id'].'"';
                        }
                        echo "<option value='".$row2['id']."' ".$temp.">".$row2['name']."</option>";
                        $temp="";
                    }
                    ?>
                </select>
            </th>
            <th style="background-color: rgba(255,0,0,0.6);"><input type="button" name="submit" value="Search" id="srch"/></th>
            <th></th>
            <th></th>
            <th>
                <?php
                if($_SESSION['type']==2){
                    echo "<p>";
                    echo "<a href='seeUsers.php' class='settings'><input id='' value='See recent users' type='button' ></a>";
                    echo "</p>";
                }



                ?>
            </th>
        </form>
    </tr>
    <tr>
        <th>Name</th>
        <th>Origin</th>
        <th>Producer</th>
        <th>Seller</th>
        <th>Price</th>
        <th><a href="add.php"><input type="button" value="Add "> </a></th>
       <th> <a href="info.php"><input type="button" value="Shopping cart"></a></th>

    </tr>
        </div>
</table>
</div>

</div>

</body>
</html>
<script>


    $(document).ready(function(){
        $('#srch').click(function () {

            $.ajax({

                url: 'api/AjaxShop.php',
                method: 'POST',
                data: {
                    searchName: $('#searchName').val(),
                    searchOrigin:$('#searchOrigin').val(),
                    searchProducer:$('#searchProducer').val(),
                    sessionType:"<?php echo $sessionType?>",
                    sessionUserName:"<?php echo $sessionUserName?>"
                },
                dataType:"JSON",
                success:function(data) {
                    document.querySelectorAll('.s').forEach(e => e.remove());

                    for(let i=0; i<data.length; ++i){
                        var ids=data[i].id;
                        var link1="buy.php?id=";
                    $('#try').append($('<tr class="s">')
                        .append($('<td class="s">').append(data[i].name))
                        .append($('<td class="s">').append(data[i].origin))
                    .append($('<td class="s">').append(data[i].producer))
                    .append($('<td class="s">').append(data[i].seller))
                    .append($('<td class="s">').append(data[i].price))
                        .append("<td class='s'><img src=\"images/prota.png\" width=\"45\" height=\"45\">" +(data[i].sessionType==1 && data[i].sessionUserName!=data[i].seller ? '<a  href=\"buy.php?id='+ids+'\"><input type=\"button\" value=\"Buy\"></a>' : ''))
                    .append("<td class='s'>" +(data[i].sessionType==2 || data[i].sessionUserName==data[i].seller ? '<a href=\"edit.php?id='+ids+'\"><input type=\"button\" value=\"Edit\"></a><a href=\"http://localhost/DamjanSamardzic02_177/api/deleteSup.php?id='+ids+'\"><input type=\"button\" value=\"Delete\"></a>' : '')));







                    }

                }
            });
        });
    })


</script>
