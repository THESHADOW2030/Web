// function to detect if an element is scrolled into view
function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
};

// listen for scroll event
$(window).scroll(function () {
    // check if element is scrolled into view
    if (isScrolledIntoView($('#our-project-text-id')))
    {
        // element is scrolled into view, add animation class
        $('#our-project-text-id').addClass('our-project-text-animation');
        $('#our-project-title-id').addClass('our-project-title-animation');
        $('#our-project-logo-id').addClass('our-project-logo-animation');
    }
    else if (!isScrolledIntoView($('#our-project-text-id')))
    {

        /*
        $('#our-project-text-id').removeClass('our-project-text-animation');
        $('#our-project-title-id').removeClass('our-project-title-animation');
        $('#our-project-logo-id').removeClass('our-project-logo-animation');
        $('#our-project-text-id').offsetWidth = $('#our-project-text-id').offsetWidth;
        $('#our-project-title-id').offsetWidth = $('#our-project-title-id').offsetWidth;
        $('#our-project-logo-id').offsetWidth = $('#our-project-logo-id').offsetWidth;
        $('#our-project-text-id').addClass('our-project-text-animation-end');
        $('#our-project-title-id').addClass('our-project-title-animation-end');
        $('#our-project-logo-id').addClass('our-project-logo-animation-end');*/
    }
    if (isScrolledIntoView($('#our-team-text-id')))
    {
        // element is scrolled into view, add animation class
        $('#our-team-text-id').addClass('our-team-text-animation');
        $('#our-team-title-id').addClass('our-team-title-animation');
        $('#our-team-logo-id').addClass('our-team-logo-animation');
    }
});