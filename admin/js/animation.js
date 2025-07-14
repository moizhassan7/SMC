
function isElementInViewport(elem) {
    var $elem = $(elem);

    // Get the scroll position of the page.
    var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
    var viewportTop = $(scrollElem).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    // Get the position of the element on the page.
    var elemTop = Math.round( $elem.offset().top);
    var elemBottom = elemTop + $elem.height();

    return ((elemTop <= viewportBottom) && (elemBottom >= viewportTop));
}

// Check if it's time to start the animation.
function checkAnimation($element) {
    var $elem = $($element);

    // If the animation has already been started
    if ($elem.hasClass('count')) {
        return false;
    }

    if (isElementInViewport($elem)) {
        // Start the animation
        $elem.addClass('count');
        // dynamically setting the width value for inner_div in skill progress bar
        return true;
    } else {
        return false;
    }
}

