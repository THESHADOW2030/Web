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
});