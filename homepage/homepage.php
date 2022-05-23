<?php
//TODO: Add preselected arguments on modal views (example: preset day as actual day)
//TODO: Idea: Add button to scroll down with animation (less important)
//TODO: Change settings modal view, adding maybe profile picture
//TODO: Add charts by week,mounth and year
//TODO: Add "steps done" separately
//TODO: Add Dark Mode
//TODO: Fix steps card!!
session_start();
//connect to database
//$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=password");

$conn = pg_connect("host=localhost port=5432 dbname=InfoHealth user=postgres password=THEDARK2030");

if (!$conn) {
    echo "Errore: impossibile raggiungere i nostri database";
}

if (!isset($_SESSION['user'])) {
    header("Location: ../index.html");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../resources/images/logo4000x4000.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="./homepage.css">
    <link rel="stylesheet" type="text/css" href="actionButton.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script src="../jquery/homepage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoHealth</title>
    <link rel="icon" href="../resources/images/logo4000x4000.png">
</head>
<body>
<div id="container-floating">
    <a class="nd4 nds" data-toggle="modal" data-target="#modalViewAlimento">
        <div class="tooltipss">
            <span class="tooltiptextss">Aggiungi Alimento</span>
            <img class="reminder" src="../resources/icons/food24x24white.png">
        </div>
    </a>

    <a class="nd3 nds" data-toggle="modal" data-target="#modalViewAttivita">
        <div class="tooltipss">
            <span class="tooltiptextss">Aggiungi Allenamento</span>
            <img class="reminder" src="../resources/icons/running24x24white.png"/>
        </div>
    </a>

    <a class="nd1 nds" data-toggle="modal" data-target="#modalViewPeso" style="color: #ffffff">
        <div class="tooltipss">
            <span class="tooltiptextss">Aggiungi Peso</span>
            <img class="reminder" title="Aggiungi Peso" src="../resources/icons/scale24x24white.png"/>
        </div>
    </a>

    <div id="floating-button">
        <p class="plus">+</p>

        <img class="edit" src="https://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
    </div>
</div>


<div class="nav">
    <img src="../resources/images/logo4000x4000.png" alt="InfoHealth" class="nav-logo" id="profilePicture">
    <div class="nav-menu">
        <ul>

            <li><a href="#">Home</a></li>
            <li>
                <a type="button" class="li" data-toggle="modal" data-target="#ImpostazioniModal">Impostazioni</a>
                <!--
                <button type="button" class="li" data-toggle="modal" data-target="#ImpostazioniModal" style="background-color: transparent;
                                                                                                        color: white;
                                                                                                         font-size: 18px;
                                                                                                         font-weight: bold;
                                                                                                         border: none">
                    Impostazioni
                </button>
                -->
            <li><a href="../php/logout.php">Logout</a></li>
        </ul>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ImpostazioniModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <form method="post" id="formSettings" onsubmit="return sendSettings();"
          action="../php/settings.php">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Impostazioni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">


                    <div class="modal-body">
                        <div class="it-datepicker-wrapper theme-dark">
                            <div class="form-group">
                                <label for="username ">Username</label>
                                <input class="form-control it-date-datepicker" id="username" name="username"
                                       type="text">
                                <label for="password" style="padding-top: 15px">Password</label>
                                <input class="form-control it-date-datepicker" id="password" name="password">
                                <label for="email" style="padding-top: 15px">Email</label>
                                <input class="form-control it-date-datepicker" id="email" name="email" type="email">
                                <label for="altezza" style="padding-top: 15px">Altezza</label>
                                <input class="form-control it-date-datepicker" id="altezza" name="altezza"
                                       type="number">
                                <label for="peso" style="padding-top: 15px">Peso</label>
                                <input class="form-control it-date-datepicker" id="peso" name="peso" type="number">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick=" return deleteProfile()">Elimina Profilo</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Scarta</button>
                        <button type="submit" class="btn btn-dark">Salva</button>
                    </div>


                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="modalViewAttivita" tabindex="-1" role="dialog"
     aria-labelledby="modalViewAttivitaTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nuovo Allenamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formActivity" onsubmit="return sendActivity();"
                  action="../php/insertItemsInuser_activity.php">
                <div class="modal-body">
                    <div class="it-datepicker-wrapper theme-dark">
                        <div class="form-group">
                            <label for="dateAllenamento">Data Allenamento</label>
                            <input class="form-control it-date-datepicker" id="dateAllenamento"
                                   name="dateAllenamento" type="date">

                            <label for="orarioAllenamento" style="padding-top: 15px"> Orario Allenamento</label>
                            <input class="form-control it-time-picker" id="orarioAllenamento" name="orarioAllenamento"
                                   type="time">

                            <label for="durata">Durata Allenamento</label>
                            <input class="form-control it-date-datepicker" id="durata" name="durata"
                                   type="number">


                            <label for="attivita" style="padding-top: 15px">Attività Svolta</label>
                            <input class="form-control" id="attivita" name="attivita" type="text">
                            <label for="calorie_bruciateInput" style="padding-top: 15px">Calorie
                                Bruciate</label>
                            <input class="form-control" id="calorie_bruciateInput" name="calorie_bruciateInput"
                                   type="number">
                            <label for="passiInput" style="padding-top: 15px">Passi Effettuati</label>
                            <input class="form-control" id="passiInput" name="passiInput" type="number">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Scarta</button>
                    <button type="submit" class="btn btn-dark">Aggiungi Allenamento</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalViewAlimento" tabindex="-1" role="dialog" aria-labelledby="modalViewAlimento"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nuovo Alimento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formAliment" onsubmit="return sendAliment();"
                  action="../php/insertItemsInuser_alimenti.php">
                <div class="modal-body">
                    <div class="it-datepicker-wrapper theme-dark">
                        <div class="form-group">
                            <label for="date2 ">Data Alimento</label>
                            <input class="form-control it-date-datepicker" id="date2" name="date2" type="date">
                            <label for="orario" style="padding-top: 15px"> Orario Pasto</label>
                            <input class="form-control it-time-picker" id="orario" name="orario" type="time">
                            <label for="alimentoInput" style="padding-top: 15px">Alimento Mangiato</label>
                            <input class="form-control" id="alimentoInput" name="alimentoInput" type="text">
                            <label for="calorie_bruciateInput" style="padding-top: 15px">Calorie
                                Alimento</label>
                            <input class="form-control" id="calorieAssunteInput" name="calorieAssunteInput"
                                   type="number">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Scarta</button>
                    <button type="submit" class="btn btn-dark">Aggiungi Alimento</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalViewPeso" tabindex="-1" role="dialog"
     aria-labelledby="modalViewPeso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nuovo Peso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formWeight" onsubmit="return sendWeight();"
                  action="../php/updatePeso.php">
                <div class="modal-body">
                    <div class="it-datepicker-wrapper theme-dark">
                        <div class="form-group">
                            <label for="DataPesoNuovo ">Data</label>
                            <input class="form-control it-date-datepicker" id="dataPesoNuovo"
                                   name="dataPesoNuovo" type="date">
                            <label for="orarioPeso" style="padding-top: 15px"> Orario Peso</label>
                            <input class="form-control it-time-picker" id="orarioPeso" name="orarioPeso" type="time">
                            <label for="pesoNuovo ">Nuovo Peso</label>
                            <input class="form-control it-date-datepicker" id="pesoNuovo"
                                   name="pesoNuovo" type="number">


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Scarta
                    </button>
                    <button type="submit" class="btn btn-dark">Aggiorna Peso</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="jumbotron jumbotron-fluid">
    <div class="container" id="helloUser">
        <?php
        // echo $_SESSION['user'];
        if (isset($_SESSION['user'])) {
            echo '<h1 class="display-3 main-title" style="padding: 50px 0px 0px 0px">Benvenuto ' . $_SESSION['user'] . '</h1>';
        } else {
            echo '<h1 class="display-4">Benvenuto</h1>';
        }

        ?>
        <!--<h1 class="display-3" id ="benvenuto">Benvenuto GigaChad</h1> -->
        <p class="lead">É bello rivederti.</p>

    </div>


    <div id="row-cards">
        <div class="row cards">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Peso</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                $q1 = "SELECT * FROM public.user_info WHERE username = $1";
                                $result = pg_query_params($conn, $q1, array($_SESSION['user']));
                                $peso = 0;
                                $data = 0;

                                while ($rowUser_info = pg_fetch_assoc($result))
                                {
                                    if ($rowUser_info['data'] > $data)
                                    {
                                        $peso = $rowUser_info['peso'];
                                        $data = $rowUser_info['data'];
                                    }
                                }
                                echo '<p class="card-text">' . $peso . 'Kg</p>';

                                ?>
                            </div>
                            <div class="col-sm-6">
                                <img class="card-img icona" src="../resources/icons/wight.png">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Calorie Bruciate</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                $user = $_SESSION['user'];
                                $q1 = "SELECT SUM(calorie_bruciate) FROM public.user_activity WHERE username = '$user' AND data = CURRENT_DATE";
                                $result = pg_query($conn, $q1);

                                $totale = pg_fetch_row($result);
                                if ($totale[0] != null)
                                    echo '<p class="card-text">' . $totale[0] . 'Kcal</p>';
                                else
                                    echo '<p class="card-text">' . 0  . 'Kcal</p>';

                                ?>
                            </div>
                            <div class="col-sm-6">
                                <img class="card-img" src="../resources/images/fire6000x6000.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title ">Calorie Assunte</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php

                                $user = $_SESSION['user'];
                                $q1 = "SELECT SUM(calorie_assunte) FROM public.user_alimenti WHERE username = '$user' AND data = CURRENT_DATE";
                                $result = pg_query($conn, $q1);
                                $totale = pg_fetch_row($result);
                                if ($totale[0] != null)
                                    echo '<p class="card-text">' . $totale[0] . 'Kcal</p>';
                                else
                                    echo '<p class="card-text">' . 0  . 'Kcal</p>';
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <img class="card-img" src="../resources/images/pizza6000x6000.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Passi</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                $user = $_SESSION['user'];
                                $q1 = "SELECT SUM(passi) FROM public.user_activity WHERE username = '$user' AND data = CURRENT_DATE";
                                $result = pg_query($conn, $q1);
                                $totale = pg_fetch_row($result);
                                if ($totale[0] != null)
                                    echo '<p class="card-text">' . $totale[0] . ' passi</p>';
                                else
                                    echo '<p class="card-text">' . 0  . ' passi</p>';
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <img class="card-img" src="../resources/images/step6000x6000.png">
                            </div>
                        </div>
                        <!-- <a href="#" class="btn btn-dark float-right mybtn">Aggiorna</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="grafico" id="grafico">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="chartGroup" id="chart0">
                    <div class="row" style="justify-content: center">
                        <div class="col-md-5">
                            <canvas id="pesoChartDay"></canvas>
                            <script id="scriptPesoDay">
                                var labelsPeso = [
                                    '00:00',
                                    '01:00',
                                    '02:00',
                                    '03:00',
                                    '04:00',
                                    '05:00',
                                    '06:00',
                                    '07:00',
                                    '08:00',
                                    '09:00',
                                    '10:00',
                                    '11:00',
                                    '12:00',
                                    '13:00',
                                    '14:00',
                                    '15:00',
                                    '16:00',
                                    '17:00',
                                    '18:00',
                                    '19:00',
                                    '20:00',
                                    '21:00',
                                    '22:00',
                                    '23:00'
                                ];

                                var dataPesoDay = {
                                    labels: labelsPeso,
                                    datasets: [{
                                        label: 'Peso Medio',
                                        backgroundColor: '#d3a411',
                                        borderColor: '#d3a411',
                                        data: {}
                                    }]
                                };
                                var configPesoDay = {
                                    type: 'line',
                                    data: dataPesoDay,
                                    options: {}
                                };
                                var weightDay = new Chart(
                                    document.getElementById('pesoChartDay'),
                                    configPesoDay
                                );
                                updateWeightDay();
                            </script>

                        </div>
                        <div class="col-md-5">
                            <canvas id="calorieBruciateChartDay"></canvas>
                            <script>
                                var labelsBruciateDay = [
                                    '00:00',
                                    '01:00',
                                    '02:00',
                                    '03:00',
                                    '04:00',
                                    '05:00',
                                    '06:00',
                                    '07:00',
                                    '08:00',
                                    '09:00',
                                    '10:00',
                                    '11:00',
                                    '12:00',
                                    '13:00',
                                    '14:00',
                                    '15:00',
                                    '16:00',
                                    '17:00',
                                    '18:00',
                                    '19:00',
                                    '20:00',
                                    '21:00',
                                    '22:00',
                                    '23:00'
                                ];
                                var dataBruciateDay = {
                                    labels: labelsBruciateDay,
                                    datasets: [{
                                        label: 'Calorie Bruciate Medie',
                                        backgroundColor: '#3c80f6',
                                        borderColor: '#3c80f6',
                                        data: {}
                                    }]
                                };
                                var configBruciateDay = {
                                    type: 'line',
                                    data: dataBruciateDay,
                                    options: {}
                                };
                                var burnedCaloriesDay = new Chart(
                                    document.getElementById('calorieBruciateChartDay'),
                                    configBruciateDay
                                );
                                updateBurnedCaloriesDay();
                            </script>
                        </div>
                    </div>
                    <div class="row" style="justify-content: center">
                        <div class="col-md-5">
                            <canvas id="calorieAssunteChartDay"></canvas>

                            <script>
                                var labelsAssunteDay = [
                                    '00:00',
                                    '01:00',
                                    '02:00',
                                    '03:00',
                                    '04:00',
                                    '05:00',
                                    '06:00',
                                    '07:00',
                                    '08:00',
                                    '09:00',
                                    '10:00',
                                    '11:00',
                                    '12:00',
                                    '13:00',
                                    '14:00',
                                    '15:00',
                                    '16:00',
                                    '17:00',
                                    '18:00',
                                    '19:00',
                                    '20:00',
                                    '21:00',
                                    '22:00',
                                    '23:00'

                                ];

                                var dataAssunteDay = {
                                    labels: labelsAssunteDay,
                                    datasets: [{
                                        label: 'Calorie Assunte Medie',
                                        backgroundColor: '#158a23',
                                        borderColor: '#158a23',
                                        data: {}
                                    }]
                                };

                                var configAssunteDay = {
                                    type: 'line',
                                    data: dataAssunteDay,
                                    options: {}
                                };

                                var takenCaloriesDay = new Chart(
                                    document.getElementById('calorieAssunteChartDay'),
                                    configAssunteDay
                                );
                                updateTakenCaloriesDay();
                            </script>
                        </div>
                        <div class="col-md-5">
                            <canvas id="passiChartDay"></canvas>
                            <script>

                                var labelsPassiDay = [
                                    '00:00',
                                    '01:00',
                                    '02:00',
                                    '03:00',
                                    '04:00',
                                    '05:00',
                                    '06:00',
                                    '07:00',
                                    '08:00',
                                    '09:00',
                                    '10:00',
                                    '11:00',
                                    '12:00',
                                    '13:00',
                                    '14:00',
                                    '15:00',
                                    '16:00',
                                    '17:00',
                                    '18:00',
                                    '19:00',
                                    '20:00',
                                    '21:00',
                                    '22:00',
                                    '23:00'
                                ];

                                var dataPassiDay = {
                                    labels: labelsPassiDay,
                                    datasets: [{
                                        label: 'Passi Medie',
                                        backgroundColor: '#00d29f',
                                        borderColor: '#00d29f',
                                        data: {}
                                    }]
                                };

                                var configPassiDay = {
                                    type: 'line',
                                    data: dataPassiDay,
                                    options: {}
                                };
                                var stepsDay = new Chart(
                                    document.getElementById('passiChartDay'),
                                    configPassiDay
                                );
                                updateStepsDay();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="chartGroup" id="chart1">
                    <div class="row" style="justify-content: center">
                        <div class="col-md-5">
                            <canvas id="pesoChart"></canvas>
                            <script id="scriptPesoMonth">
                                var labelsPeso = [
                                    '1',
                                    '2',
                                    '3',
                                    '4',
                                    '5',
                                    '6',
                                    '7',
                                    '8',
                                    '9',
                                    '10',
                                    '11',
                                    '12',
                                    '13',
                                    '14',
                                    '15',
                                    '16',
                                    '17',
                                    '18',
                                    '19',
                                    '20',
                                    '21',
                                    '22',
                                    '23',
                                    '24',
                                    '25',
                                    '26',
                                    '27',
                                    '28',
                                    '29',
                                    '30',
                                    '31'

                                ];

                                var dataPeso = {
                                    labels: labelsPeso,
                                    datasets: [{
                                        label: 'Peso Medio',
                                        backgroundColor: '#d3a411',
                                        borderColor: '#d3a411',
                                        data: {}
                                    }]
                                };
                                var configPeso = {
                                    type: 'line',
                                    data: dataPeso,
                                    options: {}
                                };
                                var weightMonth = new Chart(
                                    document.getElementById('pesoChart'),
                                    configPeso
                                );
                                updateWeightMonth();
                            </script>
                        </div>
                        <div class="col-md-5">

                            <canvas id="calorieBruciateChartMonth"></canvas>

                            <script>
                                var labelsBruciate = [
                                    '1',
                                    '2',
                                    '3',
                                    '4',
                                    '5',
                                    '6',
                                    '7',
                                    '8',
                                    '9',
                                    '10',
                                    '11',
                                    '12',
                                    '13',
                                    '14',
                                    '15',
                                    '16',
                                    '17',
                                    '18',
                                    '19',
                                    '20',
                                    '21',
                                    '22',
                                    '23',
                                    '24',
                                    '25',
                                    '26',
                                    '27',
                                    '28',
                                    '29',
                                    '30',
                                    '31'

                                ];

                                var dataBruciate = {
                                    labels: labelsBruciate,
                                    datasets: [{
                                        label: 'Calorie Bruciate Medie',
                                        backgroundColor: '#3c80f6',
                                        borderColor: '#3c80f6',
                                        data: {}
                                    }]
                                };

                                var configBruciate = {
                                    type: 'line',
                                    data: dataBruciate,
                                    options: {}
                                };
                                var burnedCaloriesMonth = new Chart(
                                    document.getElementById('calorieBruciateChartMonth'),
                                    configBruciate
                                );
                                updateBurnedCaloriesMonth();
                            </script>
                        </div>
                    </div>
                    <div class="row" style="justify-content: center">
                        <div class="col-md-5">
                            <canvas id="calorieAssunteChartMonth"></canvas>

                            <script>
                                var labelsAssunte = [
                                    '1',
                                    '2',
                                    '3',
                                    '4',
                                    '5',
                                    '6',
                                    '7',
                                    '8',
                                    '9',
                                    '10',
                                    '11',
                                    '12',
                                    '13',
                                    '14',
                                    '15',
                                    '16',
                                    '17',
                                    '18',
                                    '19',
                                    '20',
                                    '21',
                                    '22',
                                    '23',
                                    '24',
                                    '25',
                                    '26',
                                    '27',
                                    '28',
                                    '29',
                                    '30',
                                    '31'

                                ];

                                var dataAssunte = {
                                    labels: labelsAssunte,
                                    datasets: [{
                                        label: 'Calorie Assunte Medie',
                                        backgroundColor: '#158a23',
                                        borderColor: '#158a23',
                                        data: {}
                                    }]
                                };

                                var configAssunte = {
                                    type: 'line',
                                    data: dataAssunte,
                                    options: {}
                                };
                                var takenCaloriesMonth = new Chart(
                                    document.getElementById('calorieAssunteChartMonth'),
                                    configAssunte
                                );
                                updateTakenCaloriesMonth();
                            </script>
                        </div>
                        <div class="col-md-5">


                            <canvas id="passiChartMonth"></canvas>

                            <script>
                                var labelsPassi = [
                                    '1',
                                    '2',
                                    '3',
                                    '4',
                                    '5',
                                    '6',
                                    '7',
                                    '8',
                                    '9',
                                    '10',
                                    '11',
                                    '12',
                                    '13',
                                    '14',
                                    '15',
                                    '16',
                                    '17',
                                    '18',
                                    '19',
                                    '20',
                                    '21',
                                    '22',
                                    '23',
                                    '24',
                                    '25',
                                    '26',
                                    '27',
                                    '28',
                                    '29',
                                    '30',
                                    '31'

                                ];

                                var dataPassi = {
                                    labels: labelsPassi,
                                    datasets: [{
                                        label: 'Passi Medie',
                                        backgroundColor: '#00d29f',
                                        borderColor: '#00d29f',
                                        data: {}
                                    }]
                                };

                                var configPassi = {
                                    type: 'line',
                                    data: dataPassi,
                                    options: {}
                                };
                                var stepsMonth = new Chart(
                                    document.getElementById('passiChartMonth'),
                                    configPassi
                                );
                                updateStepsMonth();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="chartGroup" id="chart2">
                    <div class="row" style="justify-content: center">
                        <div class="col-md-5">


                            <canvas id="pesoChartYear"></canvas>

                            <script>
                                var labelsPeso = [
                                    'Gennaio',
                                    'Febbraio',
                                    'Marzo',
                                    'Aprile',
                                    'Maggio',
                                    'Giugno',
                                    'Luglio',
                                    'Agosto',
                                    'Settembre',
                                    'Ottobre',
                                    'Novembre',
                                    'Dicembre',

                                ];

                                var dataPeso = {
                                    labels: labelsPeso,
                                    datasets: [{
                                        label: 'Peso Medio',
                                        backgroundColor: '#d3a411',
                                        borderColor: '#d3a411',
                                        data: {}
                                    }]
                                };

                                var configPeso = {
                                    type: 'line',
                                    data: dataPeso,
                                    options: {}
                                };

                                var weightYear = new Chart(
                                    document.getElementById('pesoChartYear'),
                                    configPeso
                                );
                                updateWeightYear();
                            </script>

                        </div>
                        <div class="col-md-5">

                            <canvas id="calorieBruciateChartYear"></canvas>

                            <script>
                                var labelsBruciate = [
                                    'Gennaio',
                                    'Febbraio',
                                    'Marzo',
                                    'Aprile',
                                    'Maggio',
                                    'Giugno',
                                    'Luglio',
                                    'Agosto',
                                    'Settembre',
                                    'Ottobre',
                                    'Novembre',
                                    'Dicembre',
                                ];

                                var dataBruciate = {
                                    labels: labelsBruciate,
                                    datasets: [{
                                        label: 'Calorie Bruciate Medie',
                                        backgroundColor: '#3c80f6',
                                        borderColor: '#3c80f6',
                                        data: {}
                                    }]
                                };

                                var configBruciate = {
                                    type: 'line',
                                    data: dataBruciate,
                                    options: {}
                                };
                                var burnedCaloriesYear = new Chart(
                                    document.getElementById('calorieBruciateChartYear'),
                                    configBruciate
                                );
                                updateBurnedCaloriesYear();
                            </script>
                        </div>
                    </div>
                    <div class="row" style="justify-content: center">
                        <div class="col-md-5">
                            <canvas id="calorieAssunteChartYear"></canvas>

                            <script>
                                var labelsAssunte = [
                                    'Gennaio',
                                    'Febbraio',
                                    'Marzo',
                                    'Aprile',
                                    'Maggio',
                                    'Giugno',
                                    'Luglio',
                                    'Agosto',
                                    'Settembre',
                                    'Ottobre',
                                    'Novembre',
                                    'Dicembre',

                                ];

                                var dataAssunte = {
                                    labels: labelsAssunte,
                                    datasets: [{
                                        label: 'Calorie Assunte Medie',
                                        backgroundColor: '#158a23',
                                        borderColor: '#158a23',
                                        data: {}
                                    }]
                                };
                                var configAssunte = {
                                    type: 'line',
                                    data: dataAssunte,
                                    options: {}
                                };
                                var takenCaloriesYear = new Chart(
                                    document.getElementById('calorieAssunteChartYear'),
                                    configAssunte
                                );
                                updateTakenCaloriesYear();
                            </script>
                        </div>
                        <div class="col-md-5">
                            <canvas id="passiChartYear"></canvas>
                            <script>
                                var labelsPassi = [
                                    'Gennaio',
                                    'Febbraio',
                                    'Marzo',
                                    'Aprile',
                                    'Maggio',
                                    'Giugno',
                                    'Luglio',
                                    'Agosto',
                                    'Settembre',
                                    'Ottobre',
                                    'Novembre',
                                    'Dicembre',

                                ];
                                var dataPassi = {
                                    labels: labelsPassi,
                                    datasets: [{
                                        label: 'Passi Medie',
                                        backgroundColor: '#00d29f',
                                        borderColor: '#00d29f',
                                        data: {}
                                    }]
                                };
                                var configPassi = {
                                    type: 'line',
                                    data: dataPassi,
                                    options: {}
                                };
                                var stepsYear = new Chart(
                                    document.getElementById('passiChartYear'),
                                    configPassi
                                );
                                updateStepsYear();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <br>
        <br>
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
    </div>


</div>

<div class="tables">
    <div class="containerTableCards">

        <div class="card cardTable">


            <div class="card-body">
                <h3 class="card-title">Storico Allenamenti</h3>

                <div id="table-attivita">
                    <div class="table-responsive  table-striped table-borderless table-hover">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Attività</th>
                                <th scope="col">Calorie Bruciate</th>
                                <th scope="col">Durata Minuti</th>
                            </tr>
                            </thead>
                            <tbody name="bodyAllenamento" id="bodyAllenamento">


                            <?php
                            $q1 = "SELECT * FROM public.user_activity WHERE username = $1";
                            $result = pg_query_params($conn, $q1, array($_SESSION['user']));

                            while ($rowUser_info = pg_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $rowUser_info['data'] . '</td>';
                                echo '<td>' . $rowUser_info['activity'] . '</td>';
                                echo '<td>' . $rowUser_info['calorie_bruciate'] . '</td>';
                                echo '<td>' . $rowUser_info['durata_minuti'] . '</td>';
                                echo '</tr>';

                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="containerTableCards">

        <div class="card cardTable">


            <div class="card-body">
                <h3 class="card-title">Alimenti Mangiati</h3>

                <div id="table-alimenti">
                    <div class="table-responsive table-striped table-borderless table-hover">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Orario</th>
                                <th scope="col">Alimento</th>
                                <th scope="col">Calorie Assunte</th>


                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $q1 = "SELECT * FROM public.user_alimenti WHERE username = $1";
                            $result = pg_query_params($conn, $q1, array($_SESSION['user']));

                            while ($rowUser_info = pg_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $rowUser_info['data'] . '</td>';
                                echo '<td>' . $rowUser_info['ora'] . '</td>';

                                echo '<td>' . $rowUser_info['alimento'] . '</td>';
                                echo '<td>' . $rowUser_info['calorie_assunte'] . '</td>';
                                echo '</tr>';

                            }

                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>


<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-5" style="margin-bottom: 30px;">Non sai come allenarti? Niente paura, i nostri esperti hanno
            un video per te!</h1>
        <div class="rwd-video">
            <?php

            $myMagicNumber = rand(0, 3);

            if ($myMagicNumber == 0) {
                echo '<iframe width="886" height="498" src="https://www.youtube.com/embed/tmmwtLWLBlI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            } elseif ($myMagicNumber == 1) {
                echo '<iframe width="768" height="752" src="https://www.youtube.com/embed/Auo8veVyRIY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            } elseif ($myMagicNumber == 2) {
                echo '<iframe width="956" height="538" src="https://www.youtube.com/embed/UItWltVZZmE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            } elseif ($myMagicNumber == 3) {
                echo '<iframe width="956" height="538" src="https://www.youtube.com/embed/UheajlsZ72E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

            }

            $arrayVideo = array("https://www.youtube.com/embed/Auo8veVyRIY", "https://www.youtube.com/embed/tmmwtLWLBlI");

            //$randomVideo = $arrayVideo[array_rand($arrayVideo, 1)];
            //echo $randomVideo;

            ?>
            <!--  <iframe width="886" height="498" src="https://www.youtube.com/embed/tmmwtLWLBlI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </div>
    </div>
</div>


</body>
</html>