<?php
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
if(!$conn)
{
    echo "Errore: impossibile raggiungere i nostri database";
}
else
{
    session_start();
    echo "Connessione riuscita";
    //echo $_SESSION['user'];
    if(isset($_SESSION['user']))
        $user = $_SESSION['user'];
    if (isset($_POST["date2"]))
        $date = $_POST['date2'];
    if (isset($_POST['orario']))
        $orario = $_POST['orario'];
    if (isset($_POST['alimentoInput']))
        $alimento = $_POST['alimentoInput'];
    if (isset($_POST['calorieAssunteInput']))
        $calorieAssunte = $_POST['calorieAssunteInput'];

    echo $user;     //la mettiamo
    echo $_POST["date2"];     //la mettiamo
  //  echo isset($_POST['date2']). "dadasadsa";
    echo $orario;
    echo $alimento;
    echo $calorieAssunte;

   //insert into public.user_alimenti the values of username, alimento, calorie_assunte, data ora
    $query = "INSERT INTO public.user_alimenti (username, alimento, calorie_assunte, data, ora) VALUES ('$user', '$alimento', '$calorieAssunte', '$date', '$orario')";
    $result = pg_query($conn, $query);
    if(!$result)
    {
        echo "Errore: impossibile inserire i dati nel database";
    }
    else
    {
        echo "Inserimento avvenuto con successo";
    }

    //return to the page
    header("Location: ../homepage/homepage.php");





}



?>
