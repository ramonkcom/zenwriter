/* ========================================================================== */
/* SCRIPT
/* This file contains all main application-wide scripts.
/* ========================================================================== */

/* -------------------------------------------------------------------------- */
/* Focus
/* -------------------------------------------------------------------------- */
var startContentFocusController = function () {
    function focus(elements) {
        elements.forEach(element => {
            if (element.isIntersecting) {
                element.target.classList.add('focus');
            } else {
                element.target.classList.remove('focus');
            }
        });
    }

    // list of options
    let h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    let margin = '-' + Math.round(h / 3) + 'px 0px -' + Math.round(h / 3) + 'px 0px';
    let options = {
        root: null,
        threshold: 0,
        rootMargin: margin
    };

    // instantiate a new Intersection Observer
    let observer = new IntersectionObserver(focus, options);

    // list of elements
    let elements = document.querySelectorAll('.post--brief, .post__content *');

    // loop through all elements
    // pass each element to observe method
    // ES2015 for-of loop can traverse through DOM Elements
    for (let element of elements) {
        observer.observe(element);
    }
}

var startInteractionFocusController = function () {
    var lastScrollTop = 100;
    var header = document.querySelector('.header');
    var scrollToTop = document.querySelector('.scroll-to-top');

    header.addEventListener("mouseover",  function(){
        this.classList.remove('focus');
    }, false);

    window.addEventListener("scroll", function () {
        var distanceFromTop = window.pageYOffset || document.documentElement.scrollTop;
        var menuCheckbox = document.querySelector('.navigation__checkbox');
        if (distanceFromTop > lastScrollTop && !menuCheckbox.checked) {
            header.classList.add('focus');
            scrollToTop.classList.add('focus');
        } else {
            header.classList.remove('focus');
            scrollToTop.classList.remove('focus');
        }
        lastScrollTop = distanceFromTop <= 0 ? 0 : distanceFromTop; // For Mobile or negative scrolling
    }, false);
}

window.onload = function() {
    startInteractionFocusController();
    startContentFocusController();
}

