/**
 * Created by Geert on 31/03/2016.
 */

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

    /*var reservatieForm = $(".reservatie-form");
     reservatieForm.steps({
     /* Labels */
    /*labels: {
     current: "",
     finish: "Bevestig",
     next: "Volgende",
     previous: "Vorige"
     },
     headerTag: "h3",
     bodyTag: "section",
     transitionEffect: "slideLeft",
     onStepChanging: function (event, currentIndex, newIndex)
     {
     // Allways allow step back to the previous step even if the current step is not valid!
     if (currentIndex > newIndex)
     {
     return true;
     }
     reservatieForm.validate().settings.ignore = ":disabled,:hidden";
     return reservatieForm.valid();
     },
     onFinishing: function (event, currentIndex)
     {
     reservatieForm.validate().settings.ignore = ":disabled";
     return reservatieForm.valid();
     },
     onFinished: function (event, currentIndex)
     {
     alert("Submitted!");
     }
     });
     
     reservatieForm.validate({
     errorPlacement: function errorPlacement(error, element) {
     element.before(error);
     }
     });*/
}); // end of document ready