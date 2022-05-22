function updateWeightDay()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getWeightDay.php', success: function (dataChart)
        {
            weightDay.data.datasets[0].data = JSON.parse(dataChart);
            weightDay.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}
function updateWeightMonth()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getWeightMonth.php', success: function (dataChart)
        {
            weightMonth.data.datasets[0].data = JSON.parse(dataChart);
            weightMonth.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}
function updateWeightYear()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getWeightYear.php', success: function (dataChart)
        {
            weightYear.data.datasets[0].data = JSON.parse(dataChart);
            weightYear.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}


function updateBurnedCaloriesDay()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getBurnedCaloriesDay.php', success: function (dataChart)
        {
            burnedCaloriesDay.data.datasets[0].data = JSON.parse(dataChart);
            burnedCaloriesDay.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}
function updateBurnedCaloriesMonth()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getBurnedCaloriesMonth.php', success: function (dataChart)
        {
            burnedCaloriesMonth.data.datasets[0].data = JSON.parse(dataChart);
            burnedCaloriesMonth.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}
function updateBurnedCaloriesYear()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getBurnedCaloriesYear.php', success: function (dataChart)
        {
            burnedCaloriesYear.data.datasets[0].data = JSON.parse(dataChart);
            burnedCaloriesYear.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}


function updateTakenCaloriesDay()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getTakenCaloriesDay.php', success: function (dataChart)
        {
            takenCaloriesDay.data.datasets[0].data = JSON.parse(dataChart);
            takenCaloriesDay.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}
function updateTakenCaloriesMonth()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getTakenCaloriesMonth.php', success: function (dataChart)
        {
            takenCaloriesMonth.data.datasets[0].data = JSON.parse(dataChart);
            takenCaloriesMonth.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}
function updateTakenCaloriesYear()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getTakenCaloriesYear.php', success: function (dataChart)
        {
            takenCaloriesYear.data.datasets[0].data = JSON.parse(dataChart);
            takenCaloriesYear.update();
        }, error: function (xhr, status, error)
        {

        }
    });
}


function updateStepsDay()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getStepsDay.php', success: function (dataChart)
        {
            stepsDay.data.datasets[0].data = JSON.parse(dataChart);
            stepsDay.update();
        }, error: function (xhr, status, error)
        {

        }
    });

}
function updateStepsMonth()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getStepsMonth.php', success: function (dataChart)
        {
            stepsMonth.data.datasets[0].data = JSON.parse(dataChart);
            stepsMonth.update();
        }, error: function (xhr, status, error)
        {

        }
    });

}
function updateStepsYear()
{
    jQuery.ajax({
        type: 'POST', url: '../php/getStepsYear.php', success: function (dataChart)
        {
            stepsYear.data.datasets[0].data = JSON.parse(dataChart);
            stepsYear.update();
        }, error: function (xhr, status, error)
        {

        }
    });

}


function sendAliment()
{
    var form = $("#formAliment");
    var actionUrl = form.attr('action');
    console.log("sending data...");
    $.ajax({
        type: 'POST', url: actionUrl, data: form.serialize(), success: function (response)
        {
            $('#table-alimenti').load('homepage.php #table-alimenti');
            $('#row-cards').load('homepage.php #row-cards');

            updateTakenCaloriesDay();
            updateTakenCaloriesMonth();
            updateTakenCaloriesYear();

            $('#modalViewAlimento').modal('hide');
        }, error: function (xhr, status, error)
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
        type: 'POST', url: actionUrl, data: form.serialize(), success: function (response)
        {
            $('#row-cards').load('homepage.php #row-cards');

            updateWeightDay();
            updateWeightMonth();
            updateWeightYear();

            $('#modalViewPeso').modal('hide');
            console.log("Data sent");
        }, error: function (xhr, status, error)
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
        type: 'POST', url: actionUrl, data: form.serialize(), success: function (response)
        {
            $('#table-attivita').load('homepage.php #table-attivita');
            $('#row-cards').load('homepage.php #row-cards');

            updateBurnedCaloriesDay();
            updateBurnedCaloriesMonth();
            updateBurnedCaloriesYear();

            updateStepsDay();
            updateStepsMonth();
            updateStepsYear();

            $('#modalViewAttivita').modal('hide');
        }, error: function (xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;
}


function refreshTable()
{
    $('#table-alimenti').load('homepage.php #table-alimenti', function ()
    {
        setTimeout(refreshTable, 5000);
        console.log("testo");
    });
}


function sendSettings()
{
    var form = $("#formSettings");
    var actionUrl = form.attr('action');
    console.log("sending data...");

    //print the data in the form

    $.ajax({
        type: 'POST', url: actionUrl, data: form.serialize(), success: function (response)
        {
            $('#row-cards').load('homepage.php #row-cards');
            $('#helloUser').load('homepage.php #helloUser');

            updateWeightDay();
            updateWeightMonth();
            updateWeightYear();

            $('#ImpostazioniModal').modal('hide');
            console.log("Data sent settings");
        }, error: function (xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;
}




