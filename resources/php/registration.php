<?php
    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
    if(!$conn)
    {
        //echo "Not connected to database<br>";
    }
    else
    {
        //echo "Connected to database<br>";

        if (isset($_POST['email']))
            $email = $_POST['email'];
        if (isset($_POST['userRegistration']))
            $user = $_POST['userRegistration'];
        if (isset($_POST['passwordRegistration']))
            $password = $_POST['passwordRegistration'];

        $q1 = " SELECT *
                FROM public.users
                WHERE username = $1";


        $result = pg_query_params($conn, $q1, array($user));
        if($line = pg_fetch_array($result,null,PGSQL_ASSOC))
        {
            //echo "Account già esistente!";
            //create an alert saying "User is already registered"

            //header('location:../../login.html');
            echo '<script type="text/javascript">',
            'alert("Utente già registrato");
            ',
            '</script>';
        }
        else
        {
            $q2 = "INSERT INTO public.users (username, password,email) VALUES ($1, $2,$3);";
            $data = pg_query_params($conn, $q2, array($user, $password,$email));
            if ($data)
            {
                echo "<h1> Account Creato!";
            }
            else
            {
                echo "Errore Interno!";
            }
        }
    }

?>