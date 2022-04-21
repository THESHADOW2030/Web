<?php

    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
    if(!$conn)
    {
        echo "Not connected to database<br>";
    }
    else
    {
        echo "Connected to database<br>";

    //    $q1=" select * from user where email= $1 ";
  //      $result=pg_query_params($conn, $q1, array($email));

//        if ($line=pg_fetch_array($result, null, PGSQL_ASSOC)) {

           // echo ""


        //}


    }

$email = $_POST['email'];
$password = $_POST['email'];



?>