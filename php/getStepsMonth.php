<?php

//connect to database
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
session_start();

//get the user from session
$user = $_SESSION['user'];


$output = array();


for ($i = 1; $i<=31; $i++)
{
    $query = "SELECT AVG(passi) FROM public.user_activity WHERE username = '$user' 
                                           AND EXTRACT(DAY FROM data) = $i  AND EXTRACT(YEAR FROM data) = extract(YEAR FROM CURRENT_DATE)" ;
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
