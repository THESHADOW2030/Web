var images = [];

images[0] = "resources/images/login/6999301.jpg";
images[1] = "resources/images/login/6999299.jpg";
images[2] = "resources/images/login/6999309.jpg";
images[3] = "resources/images/login/6999319.jpg";


var i = 0;
setInterval(fadeDivs, 3000);

function fadeDivs()
{
    i = i < images.length ? i : 0;
    $('.image-fader img').fadeOut(1000, function()
    {
        $(this).attr('src', images[i]).fadeIn(1000);
    })
    i++;
}

function registration()
{
    var form = $("#formRegistration");
    var actionUrl = form.attr('action');
    var elementUsername = $("#userRegistration")[0];
    var elementEmail = $("#email")[0];

    var elementPassword = $("#repeatpassword")[0];

    elementUsername.addEventListener('input',e => {
        elementUsername.setCustomValidity(''); //this was missing
    });
    elementEmail.addEventListener('input',e => {
        elementEmail.setCustomValidity(''); //this was missing
    });
    elementPassword.addEventListener('input',e => {
        elementPassword.setCustomValidity(''); //this was missing
    });

    var output = '0';
    console.log("sending data...");
    var request = $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            console.log(response);
            if(response==='1')
            {
                window.location.href = "homepage/homepage.php";
                output = '1';
                console.log("registration ok");
                return '1';
            }
            else if(response==='10')
            {
                elementUsername.setCustomValidity('Username già esistente!');
                elementUsername.reportValidity();

                console.log('10');


            }
            else if(response==='11')
            {
                elementEmail.setCustomValidity('Email già esistente!');
                elementEmail.reportValidity();

            }
            else if(response === '20'){

                console.log("20");

                elementPassword.setCustomValidity('Password non corrispondenti');
                elementPassword.reportValidity();
               // return false;

            }
        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });

   request.done(function(response)
   {
       console.log(response);
       console.log(output);
       if (response === '1')
       {
           window.location.href = "homepage/homepage.php";
       }
      // window.location.href = "homepage/homepage.php";
       return false;
   });

 return false;
}

function login()
{
    var form = $("#formLogin");
    var actionUrl = form.attr('action');
    var element = $("#passwordLogin")[0];
    element.addEventListener('input',e => {
        element.setCustomValidity(''); //this was missing

    });

    console.log("sending data...");
    var request = $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form.serialize(),
        success: function(response)
        {
            console.log(response);
            if(response==='1') {
                console.log("success");
                //Redirect to the page
                window.location.href = "homepage/homepage.php";
            }
            else
            {
                element.setCustomValidity('Username o Password non corretti!');
                element.reportValidity();
            }
        },
        error: function(xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });

    request.done(function(response)
    {
        console.log(response);
        console.log(output);
        if (response === '1')
        {
            window.location.href = "homepage/homepage.php";
        }
        // window.location.href = "homepage/homepage.php";
        return false;
    });

    return false;
}


