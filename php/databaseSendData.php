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
    if (isset($_POST['date2']))
        $date = $_POST['date2'];
    if (isset($_POST['orario']))
        $orario = $_POST['orario'];
    if (isset($_POST['alimentoInput']))
        $alimento = $_POST['alimentoInput'];
    if (isset($_POST['calorieBruciateInput']))
        $calorieAssunte = $_POST['calorieBruciateInput'];

    echo $user;
    echo $date;
    echo $orario;
    echo $alimento;
    echo $calorieAssunte;

    $q1 = "INSERT INTO public.user_alimenti (username, alimento, calorieAssunte, data, ora) VALUES ($1, $2, $3, $4, $5)";

    $result = pg_query_params($conn, $q1, array($user, $alimento, $calorieAssunte, $date, $orario));
    if(!$result)
    {
        echo "Errore: impossibile inserire i dati";
    }
    else
    {
        echo "Dati inseriti correttamente";
    }


}



?>
