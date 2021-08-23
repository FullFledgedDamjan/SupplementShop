<?php
session_start();
include('config/connection.php');

if (!isset($_SESSION["username"])) {
    header('Location:index.php');
}
$id = $_SESSION['id'];

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Buy</title>
    <style>
        body {
            margin: 0;
            background: url(images/carttt.jpg);

            background-size: cover;
            background-position: center;
            font-family: Arial;

        }

        .header {


            padding: 20px;
            text-align: center;
            background: ;
            color: white;
            font-size: 30px;
        }

        .buy {

            wdith: 45%:


        }

        #buy {
            width: 45%;

            margin-top: 70px;

        }

        #h1 {

            color: white;
            padding-left: 450px;
            padding-top: 70px;
        }


        .table {
            background: rgba(255,255,255,0.5);
            margin: auto;
            border-collapse: collapse;
            width: 70%;
            height: ;

        }

        .table td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }

        .table th {
            width: 20%;
            padding-left: 10px;
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: red;
            color: white;
        }

        input[type=button] {
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
        input[type="button"]:hover {
            background: #ffc107;
            color: #000;
            transition: 0.2s ease;
        }

        #b {
            float: right;
            margin-top: 10px;
            margin-right: 10px;
        }
        #try2{
            margin-top: 10px;
        }
        .h{
            margin-top:100px ;
        }
        /*.h{*/
        /*    padding-bottom: ;*/
        /*    position: fixed;*/
        /*    left: 450px;*/
        /*}*/
        /*.t{*/
        /*    margin-left: 450px;*/
        /*    margin-top: 50px;*/
        /*    width: 100%;*/
        /*}*/

    </style>





</head>
<body onload="fetch_data()">



<div class="header" >

    <a href="shop.php"><input type="button" value="Go back" id="b"></a>

</div>


    <section class="container-fluid " >
        <section class="row justify-content-center">


    <table class="table" table-bordered id="try">
        <div class="h">
            <h1 id="" style="color:#fb2525">Supplements purchased by <?php echo $_SESSION["username"] ?></h1>
        </div>
        <tr>
            <th>Name</th>
            <th>Origin</th>
            <th>Producer</th>
            <th>Seller</th>
            <th>Price</th>
        </tr>
        </table>





            <table class="table" table-bordered id="try2">
                <div class="h">
                    <h1 id="" style="color:#fb2525">Supplements that are sold by <?php echo $_SESSION["username"] ?></h1>
                </div>
                <tr>

                    <th>Name</th>
                    <th>Origin</th>
                    <th>Producer</th>
                    <th>Seller</th>
                    <th>Price</th>
                </tr>
            </table>

        </section>
    </section>





</body>

</html>
<script>
    function fetch_data() {
        $.ajax({
            url: 'api/AjaxInfo.php',
            method: 'GET',
            data: {id: "<?php echo $id?>"},
            dataType:"JSON",
            success:function(data) {

                for(let i=0; i<data.length; ++i){
                    $('#employee_details').css("display", "block");
                    $('#try').append("'<tr><td>"+data[i].name+"</td><td>"+data[i].origin+"</td><td>"+data[i].producer+"</td><td>"+data[i].seller+"</td><td>"+data[i].price+"</td></tr>"



                    );


                    //     $('#try').innerHTML+="<tr>"'<td>'.data[$i].name.'</td>''<td>'.data[$i].origin.'</td>''<td>'.data[$i].producer.'</td>''<td>'.data[$i].seller.'</td>''<td>'.data[$i].price.'</td>'"</tr>";

                }




            }
        });


        $.ajax({
            url: 'api/AjaxInfoSold.php',
            method: 'GET',
            data: {id: "<?php echo $id?>"},
            dataType:"JSON",
            success:function(data) {

                for(let i=0; i<data.length; ++i){
                    $('#employee_details').css("display", "block");
                    $('#try2').append("'<tr><td>"+data[i].name+"</td><td>"+data[i].origin+"</td><td>"+data[i].producer+"</td><td>"+data[i].buyer+"</td><td>"+data[i].price+"</td></tr>"



                    );


                    //     $('#try').innerHTML+="<tr>"'<td>'.data[$i].name.'</td>''<td>'.data[$i].origin.'</td>''<td>'.data[$i].producer.'</td>''<td>'.data[$i].seller.'</td>''<td>'.data[$i].price.'</td>'"</tr>";

                }




            }
        });
    }
</script>
<script>
    function fetch_data2() {
        $.ajax({
            url: 'api/AjaxInfoSold.php',
            method: 'GET',
            data: {id: "<?php echo $id?>"},
            dataType:"JSON",
            success:function(data) {

                for(let i=0; i<data.length; ++i){
                    $('#employee_details').css("display", "block");
                    $('#try').append("'<tr><td>"+data[i].name+"</td><td>"+data[i].origin+"</td><td>"+data[i].producer+"</td><td>"+data[i].buyer+"</td><td>"+data[i].price+"</td></tr>"



                    );


                    //     $('#try').innerHTML+="<tr>"'<td>'.data[$i].name.'</td>''<td>'.data[$i].origin.'</td>''<td>'.data[$i].producer.'</td>''<td>'.data[$i].seller.'</td>''<td>'.data[$i].price.'</td>'"</tr>";

                }




            }
        });
    }
</script>