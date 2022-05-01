function resetPassword()
{
    var form = $("#formReset");
    var actionUrl = form.attr('action');
    var element = $("#email")[0];
    element.addEventListener('input',e => {
            element.setCustomValidity(''); //this was missing

    });

    console.log("sending data...");
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            console.log(response);
                if(response==='1')
                {
                    element.setCustomValidity('Email inviata!');
                    element.reportValidity();
                }
                else
                {
                    element.setCustomValidity('Email non è registrata, forse hai sbagliato a scrivere!');
                    element.reportValidity();
                }
        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
    return false;
}
