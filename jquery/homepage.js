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
            console.log(response);

            $('#row-cards').load('homepage.php #row-cards');
            $('#helloUser').load('homepage.php #helloUser');
        //    $('#grafico').load('homepage.php #grafico');
          //  $('#pesoChart').load('homepage.php #pesoChart');

        //


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



