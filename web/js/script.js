/**
 * Created by Geert on 31/03/2016.
 */

(function ($) {
    $(function () {

        $('.button-collapse').sideNav();
        $('.parallax').parallax();
        $('select').material_select();
        $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrain_width: false, // Does not change width of dropdown to that of the activator
            hover: true, // Activate on hover
            gutter: 0, // Spacing from edge
            belowOrigin: false, // Displays dropdown below the button
            alignment: 'left' // Displays dropdown with edge aligned to the left of button
        }
        );

        //BXSLIDER INIT
        $('.bxslider').bxSlider({
            mode: 'fade',
            pause: 8000,
            speed: 1000,
            auto: true,
            controls: false
        });

        $(".reservatie-form").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft"
            
        });

    }); // end of document ready
})(jQuery); // end of jQuery name space