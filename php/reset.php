<?php
    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
    if(!$conn)
    {
        echo "Errore: impossibile raggiungere i nostri database";
    }
    else
    {
        if (isset($_POST['email']))
            $email = $_POST['email'];


        $q1 = "SELECT * FROM public.users WHERE email = $1";

        $result = pg_query_params($conn, $q1, array($email));

        if ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
