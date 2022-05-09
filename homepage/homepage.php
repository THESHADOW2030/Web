<?php
//TODO: Add preselected arguments on modal views (example: preset day as actual day)
//TODO: Execute php using ajax
//TODO: fix top and button padding in nav class (they are actually different)
//TODO: add icons inside cards
//TODO: Idea: Add button to scroll down with animation (less important)
//NON MOSTRARE IL PROGETTO CON LO USERNAME LUPOSAYMON. IL TESTO VIENE TAGLIATO
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
    <link rel="stylesheet" type="text/css" href="../resources/css/index.css">
    <link rel="stylesheet" type="text/css" href="./homepage.css">
    <link rel="stylesheet" type="text/css" href="actionButton.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoHealth</title>
    <link rel="icon" href="../resources/images/logo4000x4000.png">
</head>
<body style="">
<div id="container-floating">
    <a class="nd4 nds" data-toggle="modal" data-target="#modalViewAlimento">
        <div class="tooltipss">
            <span class="tooltiptextss">Aggiungi Alimento</span>
            <img class="reminder" src="../resources/icons/food24x24white.png">
        </div>
    </a>

    <a class="nd3 nds" data-toggle="modal" data-target="#modalViewAllenamento">
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
                <button type="button" class="li" data-toggle="modal" data-target="#ImpostazioniModal" style="background-color: transparent;
                                                                                                        color: white;
                                                                                                         font-size: 18px;
                                                                                                         font-weight: bold;
                                                                                                         border: none">
                    Impostazioni
                </button>

            <li><a href="../php/logout.php">Logout</a></li>
        </ul>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ImpostazioniModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form method="post" action="settings.php" >

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Impostazioni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">



                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default" >Username</span>
                        <input type="text" class="form-control" name="username" id = "username" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default" >Password</span>
                        <input type="text" class="form-control" id = "passwordUtente" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default" >Email</span>
                        <input type="text" class="form-control" id="emailUtente"name="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default" >Altezza</span>
                        <input type="text" id="altezzaUtente" class="form-control"name="altezza" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default" >Peso</span>
                        <input type="text" id="pesoUtente" class="form-control" name="peso" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary">Salva</button>
            </div>
        </div>
    </div>
    </form>
</div>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <?php
        // echo $_SESSION['user'];
        if (isset($_SESSION['user'])) {
            echo '<h1 class="display-3 main-title" style="padding: 90px 0px 0px 0px">Benvenuto ' . $_SESSION['user'] . '</h1>';
        } else {
            echo '<h1 class="display-4">Benvenuto</h1>';
        }

        ?>
        <!--<h1 class="display-3" id ="benvenuto">Benvenuto GigaChad</h1> -->
        <p class="lead">É bello rivederti</p>

    </div>


    <div class="row cards">
        <div class="col-sm-3">
            <div class="card">

                <div class="card-body">
                    <h3 class="card-title">Peso</h3>
                    <?php
                    $q1 = "SELECT * FROM public.user_info WHERE username = $1";
                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));
                    $rowUser_info = pg_fetch_assoc($result);
                   // while ($rowUser_info = pg_fetch_assoc($result)) {
                        echo '<p class="card-text">' . $rowUser_info['peso'] . 'Kg</p>';
                   // }
                    ?>

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
                                <form method="post" id="formAliment" action="../php/updatePeso.php">
                                    <div class="modal-body">
                                        <div class="it-datepicker-wrapper theme-dark">
                                            <div class="form-group">
                                                <label for="pesoNuovo ">Nuovo Peso</label>
                                                <input class="form-control it-date-datepicker" id="pesoNuovo"
                                                       name="pesoNuovo" type="number">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Scarta
                                        </button>
                                        <button type="submit" class="btn btn-primary">Aggiorna Peso</button>
                                    </div>
                                </form>
                            </div>
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
                    $q1 = "SELECT * FROM public.user_activity WHERE username = $1";


                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));

                    $totale = 0;
                    while ($rowUser_info = pg_fetch_assoc($result)) {

                        $totale = $totale + $rowUser_info['calorie_bruciate'];

                    }
                    echo '<p class="card-text">' . $totale . 'Kcal</p>';
                    ?>
                    </div>
                    <div class="col-sm-6">
                       test
                    </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title ">Calorie Assunte</h3>
                    <?php
                    $q1 = "SELECT * FROM public.user_alimenti WHERE username = $1";

                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));
                    $totale = 0;
                    while ($rowUser_info = pg_fetch_assoc($result)) {


                        $totale = $totale + $rowUser_info['calorie_assunte'];

                    }
                    echo '<p class="card-text">' . $totale . 'Kcal</p>';
                    ?>

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Passi</h3>
                    <?php
                    $q1 = "SELECT * FROM public.user_activity WHERE username = $1";


                    $result = pg_query_params($conn, $q1, array($_SESSION['user']));

                    $totale = 0;
                    while ($rowUser_info = pg_fetch_assoc($result)) {

                        $totale = $totale + $rowUser_info['passi'];

                    }
                    echo '<p class="card-text">' . $totale . '</p>';
                    ?>
                    <!-- <a href="#" class="btn btn-primary float-right mybtn">Aggiorna</a> -->
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row" style="margin: 30px;">
    <div class="col-sm-6">
        <h2>Storico Allenamenti</h2>
    </div>
    <div class="col-sm-6">
        <!-- Button trigger modal -->

        <div class="modal fade" id="modalViewAllenamento" tabindex="-1" role="dialog"
             aria-labelledby="modalViewAllenamentoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nuovo Allenamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="" action="../php/insertItemsInuser_activity.php">

                        <div class="modal-body">
                            <div class="it-datepicker-wrapper theme-dark">
                                <div class="form-group">
                                    <label for="dateAllenamento">Data Allenamento</label>
                                    <input class="form-control it-date-datepicker" id="dateAllenamento"
                                           name="dateAllenamento" type="date">

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
                            <button type="submit" class="btn btn-primary">Aggiungi Allenamento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <a href="#" class="btn btn-dark float-right ">Aggiungi Allenamento</a> -->
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
        <tbody name="bodyAllenamento" id = "bodyAllenamento">


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


<div class="row" style="margin: 30px;">
    <div class="col-sm-6">
        <h2>Alimenti Mangiati</h2>
    </div>
    <div class="col-sm-6">
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
                    <form method="post" id="formAliment" action="../php/insertItemsInuser_alimenti.php">
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
                            <button type="submit" class="btn btn-primary">Aggiungi Alimento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="table-responsive table-dark table-striped table-borderless table-hover">
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



<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-5" style="margin-bottom: 30px;">Non sai come allenarti? Niente paura, i nostri esperti hanno
            un video per te!</h1>
        <div class="rwd-video">
            <?php

            $myMagicNumber = rand(0,3);

            if ($myMagicNumber == 0) {
                echo '<iframe width="886" height="498" src="https://www.youtube.com/embed/tmmwtLWLBlI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            } elseif ($myMagicNumber == 1) {
                echo '<iframe width="768" height="752" src="https://www.youtube.com/embed/Auo8veVyRIY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }elseif ($myMagicNumber == 2) {
                echo '<iframe width="956" height="538" src="https://www.youtube.com/embed/UItWltVZZmE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }elseif ($myMagicNumber == 3) {
                echo '<iframe width="956" height="538" src="https://www.youtube.com/embed/UheajlsZ72E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

            }

            $arrayVideo = array("https://www.youtube.com/embed/Auo8veVyRIY","https://www.youtube.com/embed/tmmwtLWLBlI");

            //$randomVideo = $arrayVideo[array_rand($arrayVideo, 1)];
            //echo $randomVideo;


            ?>
          <!--  <iframe width="886" height="498" src="https://www.youtube.com/embed/tmmwtLWLBlI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </div>
    </div>
</div>


</body>
</html>