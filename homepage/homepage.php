<?php

    session_start();
    //connect to database
    $conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");
    if(!$conn)
    {
        echo "Errore: impossibile raggiungere i nostri database";
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../resources/css/index.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/login.css">
    <link rel="stylesheet" type="text/css" href="./homepage.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova boh</title>
</head>
<body style="">




<div class="nav">
    <img src="../resources/images/logo4000x4000.png" alt="InfoHealth" class="nav-logo" id = "profilePicture">
    <div class="nav-menu">
        <ul>
            <li><a href="#">Impostazioni</a></li>
            <li><a href="#">Home</a></li>
        </ul>
    </div>
</div>



<div class="" style="margin-top: 90px;;">



    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <?php
           // echo $_SESSION['user'];
            if(isset($_SESSION['user'])){
                echo '<h1 class="display-3">Benvenuto '.$_SESSION['user'].'</h1>';
            }
            else{
                echo '<h1 class="display-4">Benvenuto</h1>';
            }

            ?>
          <!--<h1 class="display-3" id ="benvenuto">Benvenuto GigaChad</h1> -->
            <p class="lead">É bello rivederti</p>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="card" style="background-color: rgb(44, 66, 63);">
                <div class="card-body">
                    <h5 class="card-title text-white">Peso</h5>



                    <?php



                    $q1 = "SELECT * FROM public.user_info WHERE username = $1";

                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));

                    while($rowUser_info = pg_fetch_assoc($result)){

                        echo '<p class="card-text text-white">'.$rowUser_info['peso'].'Kg</p>';

                    }













                    ?>

                    <a href="#" class="btn btn-primary float-right mybtn">Aggiorna</a>

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="background-color: rgb(130, 145, 145);">
                <div class="card-body">
                    <h5 class="card-title text-white">Calorie Bruciate</h5>
                    <?php
                    $q1 = "SELECT * FROM public.user_activity WHERE username = $1";


                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));

                    $totale = 0;
                    while($rowUser_info = pg_fetch_assoc($result)) {

                        $totale = $totale + $rowUser_info['calorieBruciate'];

                    }
                    echo '<p class="card-text text-white">' . $totale . 'Kcal</p>';
                    ?>

                   <!-- <a href="#" class="btn btn-primary float-right mybtn">Aggiorna</a> -->
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="background-color: rgb(76, 91, 97);">
                <div class="card-body">
                    <h5 class="card-title text-white">Calorie Assunte</h5>
                    <?php
                    $q1 = "SELECT * FROM public.user_alimenti WHERE username = $1";

                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));
                    $totale = 0;
                    while($rowUser_info = pg_fetch_assoc($result)) {


                        $totale = $totale + $rowUser_info['calorieAssunte'];

                    }
                    echo '<p class="card-text text-white">' . $totale . 'Kcal</p>';
                    ?>

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="background-color: rgb(148, 155, 150);">
                <div class="card-body">
                    <h5 class="card-title text-white">Passi</h5>
                    <?php
                    $q1 = "SELECT * FROM public.user_activity WHERE username = $1";


                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));

                    $totale = 0;
                    while($rowUser_info = pg_fetch_assoc($result)) {

                        $totale = $totale + $rowUser_info['passi'];

                    }
                    echo '<p class="card-text text-white">' . $totale . '</p>';
                    ?>
                   <!-- <a href="#" class="btn btn-primary float-right mybtn">Aggiorna</a> -->
                </div>
            </div>
        </div>
    </div>





    <div class="row" style="margin: 30px;">
        <div class="col-sm-6">
            <h2>Storico Allenamenti</h2>
        </div>
        <div class="col-sm-6">
            <a href="#" class="btn btn-dark float-right ">Aggiungi Allenamento</a>
        </div>
    </div>

    <div class="table-responsive table-dark table-striped table-borderless table-hover">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Data</th>
                <th scope="col">Attività</th>
                <th scope="col">Calorie Bruciate</th>
                <th scope="col">Durata Minuti</th>

            </tr>
            </thead>
            <tbody>


            <?php
            $q1 = "SELECT * FROM public.user_activity WHERE username = $1";
            $result = pg_query_params($conn, $q1, array($_SESSION['user']));

            while($rowUser_info = pg_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>'.$rowUser_info['data'].'</td>';
                echo '<td>'.$rowUser_info['activity'].'</td>';
                echo '<td>'.$rowUser_info['calorieBruciate'].'</td>';
                echo '<td>'.$rowUser_info['durataMinuti'].'</td>';
                echo '</tr>';

            }

            ?>

            </tbody>
        </table>
    </div>
</div>


<div class="row" style="margin: 30px;">
    <div class="col-sm-6">
        <h2>Alimenti Mangiati</h2>
    </div>
    <div class="col-sm-6">
        <a href="#" class="btn btn-dark float-right ">Aggiungi Alimento</a>
    </div>
</div>



<div class="table-responsive table-dark table-striped table-borderless table-hover">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">Data</th>
            <th scope="col">Alimento</th>
            <th scope="col">Calorie Assunte</th>



        </tr>
        </thead>
        <tbody>

         <?php
            $q1 = "SELECT * FROM public.user_alimenti WHERE username = $1";
            $result = pg_query_params($conn, $q1, array($_SESSION['user']));

         while($rowUser_info = pg_fetch_assoc($result)) {
             echo '<tr>';
             echo '<td>'.$rowUser_info['data'].'</td>';
             echo '<td>'.$rowUser_info['alimento'].'</td>';
             echo '<td>'.$rowUser_info['calorieAssunte'].'</td>';
             echo '</tr>';

         }

            ?>



        </tbody>
    </table>
</div>
</div>




<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-5" style="margin-bottom: 30px;">Non sai come allenarti? Niente paura, i nostri esperti hanno un video per te!</h1>
        <div class="rwd-video">
            <iframe width="886" height="498" src="https://www.youtube.com/embed/tmmwtLWLBlI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>





</body>
</html>