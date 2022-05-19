<head>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



</head>


<?php

session_start();
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
    $month = substr($data, 5, 2);






    //see if the month is already in the array

        //if the month is already in the array, then add the peso to the value
        $calorieBruciateSomma[$month] += $rowUser_info['calorie_bruciate'];
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


echo  json_encode(array_values($calorieBruciateSomma));


?>


<br>
<br>
<br>
<br>
<br>
<div class="grafico" style="">

    <canvas id="pesoChart" ></canvas>

    <script>
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'

        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Peso',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php

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
                    $month = substr($data, 5, 2);
                    $year = substr($data, 0, 4);
                    $currentYear = date("Y");
                    if ($year != $currentYear) {
                        continue;
                    }





                    //see if the month is already in the array

                    //if the month is already in the array, then add the calorie_brucitate to the value
                    $calorieBruciateSomma[$month] += $rowUser_info['calorie_bruciate'];
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


                echo  json_encode(array_values($calorieBruciateSomma));


                ?>
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
    </script>
    <script>
        const pesoChart = new Chart(
            document.getElementById('pesoChart'),
            config
        );
    </script>



</div>
