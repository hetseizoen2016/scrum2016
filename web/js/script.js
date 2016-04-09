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
    $('#menu_formules_info').val();
    $('#menu_formules_info').trigger('autoresize');

}); // end of document ready



