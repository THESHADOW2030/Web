<?php

    //$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");


if(!$conn)
    {
        echo "Errore: impossibile raggiungere i nostri database";
    }
    else
    {
        if (isset($_POST['userLogin']))
            $user = $_POST['userLogin'];
        if (isset($_POST['passwordLogin']))
            $password = $_POST['passwordLogin'];
        if(isset($_SESSION['user']))
            header("Location: homepage/index.html");

        $q1 = "SELECT * FROM public.users WHERE username = $1 AND password = $2";

        $result = pg_query_params($conn, $q1, array($user, $password));

        if ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
        {
            session_start();
            //If user and password found
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            echo "1";
            //Start session



            //Redirect to homepage
            ("Location: ../homepage/homepage.html");
        }
        else
        {
            //Else not found
            echo "0";
        }
    }














?>
