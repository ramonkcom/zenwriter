/* ========================================================================== */
/* SCRIPT
/* This file contains all main application-wide scripts.
/* ========================================================================== */

/* -------------------------------------------------------------------------- */
/* Stop Scrolling
/* -------------------------------------------------------------------------- */
document.querySelector('.navigation__checkbox').addEventListener('change', function() {
    let body = document.querySelector('body');
    if (this.checked) {
        body.classList.add('no-scrolling');
    } else {
        body.classList.remove('no-scrolling');
    }
});

/* -------------------------------------------------------------------------- */
/* Focus
/* -------------------------------------------------------------------------- */
var contentFocus = function () {
    // observer callback
    function focus(elements) {
        elements.forEach(element => {
            if (element.isIntersecting) {
                element.target.classList.add('focus');
            } else {
                element.target.classList.remove('focus');
            }
        });
    }

    // scroll listener control variables
    var observer = null;
    var observerMargin = 'none';
    var observerFired = false;

    //scrolling control
    window.addEventListener('scroll', function(e){
        // variables
        let bodyHeight = Math.max( 
            document.body.scrollHeight, 
            document.body.offsetHeight, 
            document.documentElement.clientHeight, 
            document.documentElement.scrollHeight, 
            document.documentElement.offsetHeight
        );
        let windowHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        let regularMargin = Math.round(windowHeight / 2.7);
        let smallMargin = Math.round(windowHeight / 4);
        let observerRootMarginTop =     '-' + smallMargin   + 'px 0px -' + regularMargin + 'px 0px';
        let observerRootMarginMiddle =  '-' + regularMargin + 'px 0px -' + regularMargin + 'px 0px';
        let observerRootMarginBottom =  '-' + regularMargin + 'px 0px -' + smallMargin   + 'px 0px';

        if (window.pageYOffset < regularMargin) {
            if (observerMargin != 'top') {
                if (observer) observer.disconnect();
                // instantiate a new IntersectionObserver
                observer = new IntersectionObserver(focus, {root: null, threshold: 0, rootMargin: observerRootMarginTop});
                observerMargin = 'top';
                observerFired = false;
                // console.log(observer);
            }
            // console.log('edging TOP');
        } else if (window.pageYOffset > bodyHeight - windowHeight - regularMargin) {
            if (observerMargin != 'bottom') {
                if (observer) observer.disconnect();
                // instantiate a new IntersectionObserver
                observer = new IntersectionObserver(focus, {root: null, threshold: 0, rootMargin: observerRootMarginBottom});
                observerMargin = 'bottom';
                observerFired = false;
                // console.log(observer);
            }
            // console.log('edging BOTTOM');
        } else {
            if (observerMargin != 'middle') {
                if (observer) observer.disconnect();
                // instantiate a new IntersectionObserver
                observer = new IntersectionObserver(focus, {root: null, threshold: 0, rootMargin: observerRootMarginMiddle});
                observerMargin = 'middle';
                observerFired = false;
                // console.log('window.pageYOffset:' + window.pageYOffset);
                // console.log(observer);
            } 
            // console.log('not edging')
        }

        if (!observerFired) {
            // list of elements to observe
            let elements = document.querySelectorAll('.post--brief, .post--full .post__content > *');

            // loop through all elements
            for (let element of elements) {
                // pass each element to observe method
                observer.observe(element);
            }

            //flag that observe() has been called
            observerFired = true;
        }
    });

    //trigger the scroll event listener
    window.dispatchEvent(new CustomEvent('scroll'));
}

var interactionFocus = function () {
    var lastScrollTop = 100;
    var header = document.querySelector('.header');
    var scrollToTop = document.querySelector('.scroll-to-top');

    header.addEventListener("mouseover",  function(){
        this.classList.remove('focus');
    }, false);

    window.addEventListener("scroll", function () {
        var distanceFromTop = window.pageYOffset || document.documentElement.scrollTop;
        var distanceFromBottom = document.body.scrollHeight - window.innerHeight - window.scrollY;

        var menuCheckbox = document.querySelector('.navigation__checkbox');
        if (distanceFromTop > lastScrollTop && !menuCheckbox.checked) {
            header.classList.add('focus');
            scrollToTop.classList.add('focus');
        } else {
            header.classList.remove('focus');
            scrollToTop.classList.remove('focus');
        }
        if (distanceFromBottom < 50) {
            scrollToTop.classList.remove('focus');
        }
        lastScrollTop = distanceFromTop <= 0 ? 0 : distanceFromTop; // For Mobile or negative scrolling
    }, false);
}

window.onload = function() {
    interactionFocus();
    contentFocus();
}