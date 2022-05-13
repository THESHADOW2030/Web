<?php
//$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");
$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

if(!$conn)
{
    echo "Errore: impossibile raggiungere i nostri database";
}
else
{
    session_start();
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



   //insert into public.user_alimenti the values of username, alimento, calorie_assunte, data ora
    $query = "INSERT INTO public.user_alimenti (username, alimento, calorie_assunte, data, ora) VALUES ('$user', '$alimento', '$calorieAssunte', '$date', '$orario')";
    $result = pg_query($conn, $query);
    if(!$result)
    {
        echo "0";
    }
    else
    {
        //Added
        echo '<table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">Data</th>
            <th scope="col">Orario</th>
            <th scope="col">Alimento</th>
            <th scope="col">Calorie Assunte</th>
        </tr>
        </thead>
        <tbody>';
        $q1 = "SELECT * FROM public.user_alimenti WHERE username = $1";
        $result = pg_query_params($conn, $q1, array($_SESSION['user']));

        while ($rowUser_info = pg_fetch_assoc($result))
        {
            echo '<tr>';
            echo '<td>' . $rowUser_info['data'] . '</td>';
            echo '<td>' . $rowUser_info['ora'] . '</td>';

            echo '<td>' . $rowUser_info['alimento'] . '</td>';
            echo '<td>' . $rowUser_info['calorie_assunte'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
}
?>
