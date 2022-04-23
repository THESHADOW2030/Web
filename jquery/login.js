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

function test()
{

        var form = $("#formRegistration");
        var actionUrl = form.attr('action');
        console.log("sending data...");
        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: form.serialize(),
            success: function(response)
            {
                var jsvar = '<?php echo json_encode($return)?>';
                alert(response);
                return false;
            },
            error: function(xhr, status, error)
            {
                alert(xhr.responseText);
                return false;
            }
        });
        return false;

}

$(function()
{
    $("#buttonLogin").on("click", function()
    {
        var data = "user="+$("#username").val().trim();
        console.log("test");
        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: data,
            dataType: 'json',
            success: function(r)
            {
                if(r=="1")
                {
                    //Exists
                    $("#info").html("Username already exists");
                }else{
                    //Doesn't exist
                    $("#info").html("Username available!");
                }
            }
        });
    });
});