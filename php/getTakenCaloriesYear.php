<?php

//connect to database
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
session_start();

//get the user from session
$user = $_SESSION['user'];


$output = array();


//get the avarage peso for each day in the current month and year
for ($i = 1; $i<=12; $i++)
{
    $query = "SELECT AVG(calorie_assunte) FROM public.user_alimenti WHERE username = '$user' AND
                                        EXTRACT(MONTH FROM data) = $i  AND EXTRACT(YEAR FROM data) = extract(YEAR FROM CURRENT_DATE)"  ;

    $result = pg_query($conn, $query);
    //print result
    $row = pg_fetch_row($result);
    if ($row[0] != null) {
        $output[$i] = $row[0];
    }
    else {
        $output[$i] = 0;
    }
}
echo  json_encode(array_values($output));

?>