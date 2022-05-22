<?php

//connect to database
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
session_start();

//get the user from session
$user = $_SESSION['user'];

$output = array();
//get the avarage peso row from user_info from current date
for ($i = 0; $i<24; $i++)
{
    $query = "SELECT AVG(peso) FROM public.user_info WHERE username = '$user' AND data = current_date
                                         AND ora >= '$i:00' AND ora <= '$i:59'";
    $result = pg_query($conn, $query);
    //print result
    $row = pg_fetch_row($result);
    if ($row[0] != null)
        $output[$i] = $row[0];
    else
        $output[$i] = 0;
}
echo  json_encode(array_values($output));
?>