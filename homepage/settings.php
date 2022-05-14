<?php

$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

if(!$conn)
{
    echo "Errore: impossibile raggiungere i nostri database";
}else{

    session_start();

    if(isset($_SESSION['user']))
        $user = $_SESSION['user'];




    if (isset($_POST['username'])){
        $username = $_POST['username'];
     //   $_SESSION['user'] = $username;

        $query = "UPDATE users SET username = '$username' WHERE username = '$user'";
        $result = pg_query($conn, $query);

        //update the foreign key in user_alimenti
        $query2 = "UPDATE user_alimenti SET username = '$username' WHERE username = '$user'";
        $result = pg_query($conn, $query2);
        if (!$result) {
            echo "Errore nell'esecuzione della query";
        }
        else {
            echo "Username aggiornato";
        }


    }
    if (isset($_POST['password'])){
        $password = $_POST['password'];
    }
    if (isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if (isset($_POST['altezza'])){
        $altezza = $_POST['altezza'];
    }
    if (isset($_POST['peso'])){
        $peso = $_POST['peso'];
    }






    echo $user;
    echo $username;
    echo $password;
    echo $email;
    echo $altezza;
    echo $peso;


























}





?>