function sendAliment()
{
    var form = $("#formAliment");
    var actionUrl = form.attr('action');
    console.log("sending data...");
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            $('#table-alimenti').load('homepage.php #table-alimenti');
            $('#row-cards').load('homepage.php #row-cards');




            calorieAssunteChartDay
            console.log(response);

            var array = JSON.parse(response);
            console.log(array);

            //get the month from array[1] formatted like yyyy-mm-dd
            //var month = array[1].substring(5,7);
            // console.log(month);
            calorieAssunteChartDay.data.datasets[0].data =  array;
            calorieAssunteChartDay.update();



            $('#modalViewAlimento').modal('hide');
        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;
}


function sendWeight()
{
    var form = $("#formWeight");
    var actionUrl = form.attr('action');
    console.log("sending data...");
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            $('#row-cards').load('homepage.php #row-cards');




            //get the month from array[1] formatted like yyyy-mm-dd
            //var month = array[1].substring(5,7);
            // console.log(month);

            pesoChartDay.update();

            $('#modalViewPeso').modal('hide');
            console.log("Data sent");
        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;
}


function sendActivity()
{
    var form = $("#formActivity");
    var actionUrl = form.attr('action');
    console.log("sending data...");
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            $('#table-attivita').load('homepage.php #table-attivita');
            $('#row-cards').load('homepage.php #row-cards');

            console.log(response);

            var array = JSON.parse(response);
            console.log(array);

            //get the month from array[1] formatted like yyyy-mm-dd
            //var month = array[1].substring(5,7);
            // console.log(month);
            calorieBruciateChartDay.data.datasets[0].data =  array[0];
            calorieBruciateChartDay.update();

            passiChartDay.data.datasets[0].data =  array[1];
            passiChartDay.update();




            $('#modalViewAttivita').modal('hide');
        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;
}


function refreshTable(){
    $('#table-alimenti').load('homepage.php #table-alimenti', function(){
        setTimeout(refreshTable, 5000);
        console.log("testo");
    });
}


function sendSettings(){
    var form = $("#formSettings");
    var actionUrl = form.attr('action');
    console.log("sending data...");

    //print the data in the form

    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            //print the response
            //console.log(response);

            $('#row-cards').load('homepage.php #row-cards');
            $('#helloUser').load('homepage.php #helloUser');


            //transfrom the string response to array
            var array = JSON.parse(response);
            console.log(array);

            //get the month from array[1] formatted like yyyy-mm-dd
            //var month = array[1].substring(5,7);
           // console.log(month);
            pesoChart.data.datasets[0].data =  array;
            pesoChart.update();




            $('#ImpostazioniModal').modal('hide');

            console.log("Data sent settings");

        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;
}

$(function() {
    $("input[name$='radio']").on("click",function() {
        var test = $(this).val();
        console.log("test");
        $("div.chartGroup").hide();
        $("#chart" + test).show();

    });
});



