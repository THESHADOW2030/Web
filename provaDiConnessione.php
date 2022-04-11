<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

    echo "Hello World";

    #connect to postgresql
    $conn = pg_connect("host=localhost port=5432 dbname=infohealth user=postgres password=password");
    if(!$conn){
        echo "Not connected to database";
    }
    else{
        echo "Connected to database";
    }
    
    


    ?>
    
</body>
</html>
