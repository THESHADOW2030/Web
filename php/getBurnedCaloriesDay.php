<?php

//connect to database
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
session_start();

//get the user from session
$user = $_SESSION['user'];

$output = array();


for ($i = 0; $i<24; $i++)
{
    $query = "SELECT AVG(calorie_bruciate) FROM public.user_activity WHERE username = '$user' AND data = CURRENT_DATE 
                                         AND ora >= '$i:00' AND ora <= '$i:59'";
    $result = pg_query($conn, $query);
    $row = pg_fetch_row($result);
    if ($row[0] != null)
        $output[$i] = $row[0];
    else
        $output[$i] = 0;
}

//send the array
echo  json_encode(array_values($output));

?>