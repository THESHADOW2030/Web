<?php
//$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");



if(!$conn)
{
    // echo "Errore: impossibile raggiungere i nostri database";
}
else
{
    session_start();
    // echo "Connessione riuscita";
    //// echo $_SESSION['user'];
    if(isset($_SESSION['user']))
        $user = $_SESSION['user'];
    if (isset($_POST["dateAllenamento"]))
        $date = $_POST['dateAllenamento'];


    if (isset($_POST['attivita']))
        $attivita = $_POST['attivita'];



    if (isset($_POST['calorie_bruciateInput']))
        $calorie_bruciateInput = $_POST['calorie_bruciateInput'];


    if (isset($_POST['passiInput']))
        $passiInput = $_POST['passiInput'];

    if (isset($_POST['durata']))
        $durata = $_POST['durata'];

    if (isset($_POST['orarioAllenamento']))
        $orarioAllenamento = $_POST['orarioAllenamento'];

    // echo $user;
    // echo $date;
    // echo $attivita;
    // echo $calorie_bruciateInput;
    // echo $passiInput;

    //insert into user_activity(username, activity, calorie_bruciate, durata_minuti, data, passi ) values ('$user', '$attivita', $calorie_bruciateInput, $durata, '$date', $passiInput);

    $query = "INSERT INTO public.user_activity (username, activity, calorie_bruciate, durata_minuti, data, passi, ora ) VALUES ('$user', '$attivita', '$calorie_bruciateInput', '$durata', '$date', '$passiInput', '$orarioAllenamento')";

    $result = pg_query($conn, $query);
    if(!$result)
    {
        // echo "Errore: impossibile inserire i dati nel database";
    }
    else
    {
        // echo "Inserimento avvenuto con successo";
    }



    $user = $_SESSION['user'];

    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
    //get all the rows from the user_info table where username is the same as the user logged in
    $query = "SELECT * FROM user_activity WHERE username = '$user'";
    $result = pg_query($conn, $query);
    //define an array to store the data
    $calorieBruciateSomma2 = array();
    $occorrenze = array();

    //initializing the array in this manner: the key is a string of two digits representing the year, the value is an array of two digits representing the month
    $calorieBruciateSomma2["01"] = 0;
    $calorieBruciateSomma2["02"] = 0;
    $calorieBruciateSomma2["03"] = 0;
    $calorieBruciateSomma2["04"] = 0;
    $calorieBruciateSomma2["05"] = 0;
    $calorieBruciateSomma2["06"] = 0;
    $calorieBruciateSomma2["07"] = 0;
    $calorieBruciateSomma2["08"] = 0;
    $calorieBruciateSomma2["09"] = 0;
    $calorieBruciateSomma2["10"] = 0;
    $calorieBruciateSomma2["11"] = 0;
    $calorieBruciateSomma2["12"] = 0;
    $occorrenze["01"] = 0;
    $occorrenze["02"] = 0;
    $occorrenze["03"] = 0;
    $occorrenze["04"] = 0;
    $occorrenze["05"] = 0;
    $occorrenze["06"] = 0;
    $occorrenze["07"] = 0;
    $occorrenze["08"] = 0;
    $occorrenze["09"] = 0;
    $occorrenze["10"] = 0;
    $occorrenze["11"] = 0;
    $occorrenze["12"] = 0;


    while ($rowUser_info = pg_fetch_assoc($result)) {

        $data = $rowUser_info['data'];

        $year = substr($data, 0, 4);
        $currentYear = date("Y");
        if ($year != $currentYear) {
            continue;
        }
        //if data is not null, then print the data
        //get the current month from data
        $month = substr($data, 5, 2);






        //see if the month is already in the array

        //if the month is already in the array, then add the calorie_brucitate to the value
        $calorieBruciateSomma2[$month] += $rowUser_info['calorie_bruciate'];
        //increment the number of occurences
        $occorrenze[$month] += 1;
    }
    //for each element in the array, divide the peso by the number of occurences to get the average
    foreach ($calorieBruciateSomma2 as $key => $value) {
        //if value is 0, then don't divide by 0
        if ($value != 0) {
            $calorieBruciateSomma2[$key] = $value / $occorrenze[$key];
        }
        //$calorieBruciateSomma2[$key] = $value / $occorrenze[$key];

    }


  //  echo  json_encode(array_values($calorieBruciateSomma2));



    $user = $_SESSION['user'];

    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
    //get all the rows from the user_info table where username is the same as the user logged in
    $query = "SELECT * FROM user_activity WHERE username = '$user'";
    $result = pg_query($conn, $query);
    //define an array to store the data
    $calorieBruciateSomma = array();
    $occorrenze = array();

    //initializing the array in this manner: the key is a string of two digits representing the year, the value is an array of two digits representing the month
    $calorieBruciateSomma["01"] = 0;
    $calorieBruciateSomma["02"] = 0;
    $calorieBruciateSomma["03"] = 0;
    $calorieBruciateSomma["04"] = 0;
    $calorieBruciateSomma["05"] = 0;
    $calorieBruciateSomma["06"] = 0;
    $calorieBruciateSomma["07"] = 0;
    $calorieBruciateSomma["08"] = 0;
    $calorieBruciateSomma["09"] = 0;
    $calorieBruciateSomma["10"] = 0;
    $calorieBruciateSomma["11"] = 0;
    $calorieBruciateSomma["12"] = 0;
    $occorrenze["01"] = 0;
    $occorrenze["02"] = 0;
    $occorrenze["03"] = 0;
    $occorrenze["04"] = 0;
    $occorrenze["05"] = 0;
    $occorrenze["06"] = 0;
    $occorrenze["07"] = 0;
    $occorrenze["08"] = 0;
    $occorrenze["09"] = 0;
    $occorrenze["10"] = 0;
    $occorrenze["11"] = 0;
    $occorrenze["12"] = 0;


    while ($rowUser_info = pg_fetch_assoc($result)) {

        $data = $rowUser_info['data'];
        //if data is not null, then print the data
        //get the current month from data

        $year = substr($data, 0, 4);
        $currentYear = date("Y");
        if ($year != $currentYear) {
            continue;
        }


        $month = substr($data, 5, 2);






        //see if the month is already in the array

        //if the month is already in the array, then add the calorie_brucitate to the value
        $calorieBruciateSomma[$month] += $rowUser_info['passi'];
        //increment the number of occurences
        $occorrenze[$month] += 1;
    }
    //for each element in the array, divide the peso by the number of occurences to get the average
    foreach ($calorieBruciateSomma as $key => $value) {
        //if value is 0, then don't divide by 0
        if ($value != 0) {
            $calorieBruciateSomma[$key] = $value / $occorrenze[$key];
        }
        //$calorieBruciateSomma[$key] = $value / $occorrenze[$key];

    }


    echo  json_encode(array_values(array(array_values($calorieBruciateSomma2), array_values($calorieBruciateSomma))));














}
?>
