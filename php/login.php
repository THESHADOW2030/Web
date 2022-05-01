<?php
    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
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


        $q1 = "SELECT * FROM public.users WHERE username = $1 AND password = $2";

        $result = pg_query_params($conn, $q1, array($user, $password));

        if ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }














?>
