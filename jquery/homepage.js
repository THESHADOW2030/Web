function sendAliment()
{
    var form = $("#formAliment");
    var actionUrl = form.attr('action');
    var element = $("table-alimenti");
    console.log("sending data...");
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            $('#table-alimenti').load('homepage.php #table-alimenti');
            $('#modalViewAlimento').modal('hide');
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
    var element = $("table-attivita");
    console.log("sending data...");
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            $('#table-attivita').load('homepage.php #table-attivita');
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
