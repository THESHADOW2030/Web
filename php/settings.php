<?php

$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

if(!$conn)
{
    // echo "Errore: impossibile raggiungere i nostri database";
}else{

    session_start();

    if(isset($_SESSION['user']))
        $user = $_SESSION['user'];




    if (isset($_POST['username']) && $_POST['username'] != ""){
        $username = $_POST['username'];

        //check whether the username is already in the database
        $query = "SELECT * FROM public.users WHERE username = '$username'";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);
        $flag = 1;
        if (isset($row['username'])){
            $flag = 0;
            echo '1';
        }
        if ($flag == 1){

            //update the username
            $query = "UPDATE user_info SET username = '$username' WHERE username = '$user'";
            $result = pg_query($conn, $query);

            // echo "Username aggiornato";
            $_SESSION['user'] = $username;
            //update the username in the user_activity table
            $query = "UPDATE user_activity SET username = '$username' WHERE username = '$user'";
            $result = pg_query($conn, $query);
            //update the username in the users table
            $query = "UPDATE users SET username = '$username' WHERE username = '$user'";
            $result = pg_query($conn, $query);
            //update the username in the user_info table
            $query = "UPDATE user_alimenti SET username = '$username' WHERE username = '$user'";
            $result = pg_query($conn, $query);
        }

    }
    if (isset($_POST['password']) && $_POST['password'] != ""){
        $password = $_POST['password'];
        $query = "UPDATE users SET password = '$password' WHERE username = '$user'";
        $result = pg_query($conn, $query);
        if (!$result) {
            // echo "Errore nell'esecuzione della query";
        }
        else {
            // echo "Password aggiornata";
        }
    }
    if (isset($_POST['email']) && $_POST['email'] != ""){

        $email = $_POST['email'];
        $query = "UPDATE users SET email = '$email' WHERE username = '$user'";
        $result = pg_query($conn, $query);
        if (!$result) {
            // echo "Errore nell'esecuzione della query";
        }
        else {
            // echo "Email aggiornata";
        }
    }
    if (isset($_POST['altezza']) && $_POST['altezza'] != ""){

        $altezza = $_POST['altezza'];
        // echo $altezza . "aaaaaaaaaaa";
        $query = "UPDATE user_info SET altezza = '$altezza' WHERE username = '$user'";
        $result = pg_query($conn, $query);
        if (!$result) {
            // echo "Errore nell'esecuzione della query";
        }
        else {
            // echo "Altezza aggiornata";
        }
    }
    if (isset($_POST['peso']) && $_POST['peso'] != ""){
        $pesoNuovo = $_POST['peso'];
        //dataNuovoPeso put the current date
        $dataNuovoPeso = date("Y-m-d");
        $query2 = "INSERT INTO user_info (username, peso, data) VALUES ('$user', $pesoNuovo, '$dataNuovoPeso')";


        $result = pg_query($conn, $query2);
        if (!$result)
        {
            // echo "Errore nell'esecuzione della query";
        }
        else
        {
            // echo "Peso aggiornato";
        }
    }
}

?>