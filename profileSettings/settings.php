<?php
echo "Hello World";

//connect to the database
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
session_start();

/*
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    //update in database infohealth.users
    $userSession = $_SESSION['user'];
    $query = "UPDATE public.users SET username = '$username' WHERE username = '$userSession' ";
    $result = pg_query($conn, $query);
    $query = "UPDATE public.user_info SET username = '$username' WHERE username = '$userSession' ";
    $result = pg_query($conn, $query);
    $query = "UPDATE public.user_activity SET username = '$username' WHERE username = '$userSession' ";
    $result = pg_query($conn, $query);
    $query = "UPDATE public.user_alimenti SET username = '$username' WHERE username = '$userSession' ";
    $result = pg_query($conn, $query);

    if($result) {
        echo "Successfully updated username";
        $_SESSION['user'] = $username;
        header("Location: ../homepage/homepage.php");
    }else{
        echo "Failed to update username";
    }
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['altezza'])) {
    $altezza = $_POST['altezza'];
}
if (isset($_POST['peso'])) {
    $peso = $_POST['peso'];
}



*/


?>