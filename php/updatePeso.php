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
    if (isset($_POST["orarioPeso"]))
        $orarioPeso = $_POST['orarioPeso'];


    if ((isset($_POST["orarioPeso"])))
        $query2 = "INSERT INTO user_info (username, peso, data, ora) VALUES ('$user', '$pesoNuovo', '$dataNuovoPeso', '$orarioPeso')";
    else
        $query2 = "INSERT INTO user_info (username, peso, data) VALUES ('$user', '$pesoNuovo', '$dataNuovoPeso')";
    $result = pg_query($conn, $query2);


}
?>