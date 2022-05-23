<?php

//connect to database
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
session_start();

//get the user from session
$user = $_SESSION['user'];

//delete the user from database users, user_info and user_activity and user_alimenti
$query = "DELETE FROM public.users WHERE username = '$user'";
$result = pg_query($conn, $query);
$query = "DELETE FROM public.user_info WHERE username = '$user'";
$result = pg_query($conn, $query);
$query = "DELETE FROM public.user_activity WHERE username = '$user'";
$result = pg_query($conn, $query);
$query = "DELETE FROM public.user_alimenti WHERE username = '$user'";
$result = pg_query($conn, $query);
session_destroy();
header("Location: ../index.html");

header("Location: ../index.html");




?>