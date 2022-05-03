function sendWorkout()
{

}

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
            console.log(response);
        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;

}