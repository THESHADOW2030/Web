<?php
//$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

if(!$conn)
{
    // echo "Errore: impossibile raggiungere i nostri database";
}
else {
    session_start();
    // echo "Connessione riuscita";
    //// echo $_SESSION['user'];
    if (isset($_SESSION['user']))
        $user = $_SESSION['user'];
    if (isset($_POST["pesoNuovo"]))
        $pesoNuovo = $_POST['pesoNuovo'];
    if (isset($_POST["dataPesoNuovo"]))
        $dataNuovoPeso = $_POST['dataPesoNuovo'];

    // echo $user;
    // echo $pesoNuovo;
    // echo $dataNuovoPeso;

    //update user_info with new weight
//    $query = "UPDATE user_info SET peso = $pesoNuovo WHERE username = '$user'";
    //insert new peso with the new date
    $query2 = "INSERT INTO user_info (username, peso, data) VALUES ('$user', $pesoNuovo, '$dataNuovoPeso')";


    $result = pg_query($conn, $query2);
    if (!$result) {
        // // echo "Errore nell'esecuzione della query";
    }
    else {












        $query = "SELECT * FROM user_info WHERE username = '$user'";
        $result = pg_query($conn, $query);
        //define an array to store the data
        $pesoSomma = array();
        $occorrenze = array();
        //initializing the array in this manner: the key is a string of two digits representing the year, the value is an array of two digits representing the month
        $pesoSomma["01"] = 0;
        $pesoSomma["02"] = 0;
        $pesoSomma["03"] = 0;
        $pesoSomma["04"] = 0;
        $pesoSomma["05"] = 0;
        $pesoSomma["06"] = 0;
        $pesoSomma["07"] = 0;
        $pesoSomma["08"] = 0;
        $pesoSomma["09"] = 0;
        $pesoSomma["10"] = 0;
        $pesoSomma["11"] = 0;
        $pesoSomma["12"] = 0;
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

            //if the month is already in the array, then add the peso to the value
            $pesoSomma[$month] += $rowUser_info['peso'];
            //increment the number of occurences
            $occorrenze[$month] += 1;
        }
        //for each element in the array, divide the peso by the number of occurences to get the average
        foreach ($pesoSomma as $key => $value) {
            //if value is 0, then don't divide by 0
            if ($value != 0) {
                $pesoSomma[$key] = $value / $occorrenze[$key];
            }
            //$pesoSomma[$key] = $value / $occorrenze[$key];

        }
        echo  json_encode(array_values($pesoSomma));


    }
}
?>