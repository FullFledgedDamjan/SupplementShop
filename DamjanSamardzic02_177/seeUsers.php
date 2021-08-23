<?php
session_start();
include('config/connection.php');
if(!isset($_SESSION["username"])){
    header('Location:index.php');
}


if (isset($_POST['download'])) {
    header('Content-Disposition: attachment; filename="users.txt"');

    $upit = "SELECT  id AS id, username AS name,type  AS type 
                FROM user";
    $execute = $con->query($upit);
    $count =0;
    echo "List of all users";
    echo PHP_EOL;
    while ($row = $execute->fetch(PDO::FETCH_ASSOC)) {
        $count=$count+1;


        if($row['type']==2){
            $tip='admin';
        }else{
            $tip='user';
        }
        echo $count.'. '.$row['name'].'-'.$tip.' ID: '.$row['id'];
        echo PHP_EOL;
    }
    return;
}

$nizUsera = file("recentUsers.csv");

foreach ($nizUsera as $user => $sData) {
    $var	= explode(";", $sData);
    $nizUsera[$user] = $var;

}


echo "<table border='1px'><tr><td>User</td>
			<td>Type</td><td>ID</td></tr>
		";

foreach ($nizUsera as $user => $Data) {
    echo "<tr>";
    foreach ($Data as $dat) {
        echo "<td>$dat</td>" ;
    }
    echo "</tr>";
}echo "</table>";




?>


<html>
<head></head>
<body>
<form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <span>Download a list of all users: </span><input type="submit" value="Download" name="download"><br><br>
</form>
</body>
</html>



