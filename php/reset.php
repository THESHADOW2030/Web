<?php
   // $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
//TODO:Fix it
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

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
            //TODO: Ofc it's not working, cause we need a Email server, it's almost impossible doing it locally
            $token = bin2hex(random_bytes(50));
            $sql = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
            $to = $email;
            $subject = "Reset your password on examplesite.com";
            $msg = "Hi there, click on this <a href=\"new_password.php?token=" . $token . "\">link</a> to reset your password on our site";
            $msg = wordwrap($msg,70);
            $headers = "From: info@infohealth.com";
            mail($to, $subject, $msg, $headers);

            echo "1";
        }
        else
        {
            echo "0";
        }
    }
