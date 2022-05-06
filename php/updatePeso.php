<?php
//$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

if(!$conn)
{
    echo "Errore: impossibile raggiungere i nostri database";
}
else {
    session_start();
    echo "Connessione riuscita";
    //echo $_SESSION['user'];
    if (isset($_SESSION['user']))
        $user = $_SESSION['user'];
    if (isset($_POST["pesoNuovo"]))
        $pesoNuovo = $_POST['pesoNuovo'];

    echo $user;
    echo $pesoNuovo;

    //update user_info with new weight
    $query = "UPDATE user_info SET peso = $pesoNuovo WHERE username = '$user'";
    $result = pg_query($conn, $query);
    if (!$result) {
        echo "Errore nell'esecuzione della query";
    }
    else {
        echo "Peso aggiornato";
    }
    //return to the page
    header("Location: ../homepage/homepage.php");


}
?>