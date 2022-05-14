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

        //check whether the username is already in the database
        $query = "SELECT * FROM user_info WHERE username = '$username'";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);
        echo $row['username'];













     //   $_SESSION['user'] = $username;

       $query = "UPDATE users SET username = '$username' WHERE username = '$user'";
        $result = pg_query($conn, $query);

        //update the foreign key in user_alimenti
    //    $query2 = "UPDATE user_alimenti SET username = '$username' WHERE username = '$user'";
      //  $result = pg_query($conn, $query2);
    //    if (!$result) {
      //      echo "Errore nell'esecuzione della query";
        //}
       // else {
          //  echo "Username aggiornato";
        //}


    }
    if (isset($_POST['password'])){
        $password = $_POST['password'];
        $query = "UPDATE users SET password = '$password' WHERE username = '$user'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Errore nell'esecuzione della query";
        }
        else {
            echo "Password aggiornata";
        }
    }
    if (isset($_POST['email'])){
        $email = $_POST['email'];
        $query = "UPDATE users SET email = '$email' WHERE username = '$user'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Errore nell'esecuzione della query";
        }
        else {
            echo "Email aggiornata";
        }
    }
    if (isset($_POST['altezza'])){
        $altezza = $_POST['altezza'];
        $query = "UPDATE user_info SET altezza = '$altezza' WHERE username = '$user'";
        $result = pg_query($conn, $query);
        if (!$result) {
            echo "Errore nell'esecuzione della query";
        }
        else {
            echo "Altezza aggiornata";
        }
    }
    if (isset($_POST['peso'])){
        $pesoNuovo = $_POST['peso'];
        //dataNuovoPeso put the current date
        $dataNuovoPeso = date("Y-m-d");
        $query2 = "INSERT INTO user_info (username, peso, data) VALUES ('$user', $pesoNuovo, '$dataNuovoPeso')";


        $result = pg_query($conn, $query2);
        if (!$result) {
            echo "Errore nell'esecuzione della query";
        }
        else {
            echo "Peso aggiornato";
        }
    }
































}





?>