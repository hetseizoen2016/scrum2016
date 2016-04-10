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

    var reservatieForm = $("[name*='form']");

    reservatieForm.steps({
        /* Labels */
        labels: {
            current: "",
            finish: "Bevestig",
            next: "Volgende",
            previous: "Vorige",
        },
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            if (newIndex == 1) {
                console.log(newIndex);
                aantalDeelnemers = $("#form_aantalDeelnemers").val();
                formules = $("option");
                formules.each(function (i) {
                    if (formules[i].dataset.minpers || formules[i].dataset.maxpers) {
                        $(formules[i]).css("display", "block").prop("disabled", false);
                        if (formules[i].dataset.minpers) {
                            var minpers = parseInt(formules[i].dataset.minpers);
                            if (minpers > aantalDeelnemers) {
                                $(formules[i]).css("display", "none").prop("disabled", true);
                            }
                        }

                        if (formules[i].dataset.maxpers) {
                            var maxpers = parseInt(formules[i].dataset.maxpers);
                            if (maxpers < aantalDeelnemers) {
                                $(formules[i]).css("display", "none").prop("disabled", true);
                            }
                        }
                    } else {
                        $(formules[i]).css("display", "block").prop("disabled", false);
                    }
                });

            }
            // Allways allow step back to the previous step even if the current step is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Clean up if user went backward before
            if (currentIndex < newIndex)
            {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", reservatieForm).remove();
                $(".body:eq(" + newIndex + ") .error", reservatieForm).removeClass("error");
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
            reservatieForm.submit();
        }
    });
    $('.datepicker').pickadate({
        monthsFull: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
        weekdaysFull: ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'],
        weekdaysShort: ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
        today: 'vandaag',
        clear: 'wissen',
        close: 'sluit',
        format: 'd mmmm, yyyy',
        formatSubmit: 'yyyy-mm-dd',
    });
    reservatieForm.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            "form[datum]": {
                required: true,
                date: true
            },
            "form[aanvang]": {
                required: true
            },
            "form[aantalDeelnemers]": {
                required: true
            },
            "reservatie[Hoofdgerecht]": {
                required: true
            },
            "form[naam]": {
                required: true
            },
            "form[email]": {
                required: true,
                email: true
            },
            "form[telefoon]": {
                required: true
            },
            "form[rekening]": {
                required: true,
                number: true
            },
            "form[afdeling]": {
                required: true
            },
            "form[product]": {
                required: true
            },
            "form[project]": {
                required: true
            }
        },
        messages: {
            "form[datum]": {
                required: "Selecteer een datum",
                date: "Dit is geen geldige datum"
            },
            "form[aanvang]": {
                required: "Voer een aankomstuur in"
            },
            "form[aantalDeelnemers]": {
                required: "Voer het aantal personen in"
            },
            "reservatie[Hoofdgerecht]": {
                required: "Selecteer minstens één hoofdgerecht"
            },
            "form[naam]": {
                required: "Voer uw naam in"
            },
            "form[email]": {
                required: "Voer een mailadres in",
                email: "Voer een geldig mailadres in"
            },
            "form[telefoon]": {
                required: "Voer een telefoonnummer in"
            },
            "form[rekening]": {
                required: "Voer een rekeningnummer in",
                number: "Geen geldig rekeningnummer"
            },
            "form[afdeling]": {
                required: "Voer een afdeling in"
            },
            "form[product]": {
                required: "Voer een product in"
            },
            "form[project]": {
                required: "Voer een project in"
            }
        }
    });

    $('.datepicker').pickadate({
        monthsFull: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
        weekdaysFull: ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'],
        weekdaysShort: ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
        today: 'vandaag',
        clear: 'wissen',
        close: 'sluit',
        format: 'd mmmm yyyy',
        formatSubmit: 'yyyy-mm-dd'
    });

    $(".radio").change(changeCheck);
    changeCheck();
    function changeCheck() {
        var betalen = $(".radio:checked").val();
        if (betalen == "cash") {
            $(".betaling div").css("display", "none").find("input").prop("disabled", true);
        } else {
            $(".betaling div").css("display", "block").find("input").prop("disabled", false);
        }
    }

}); // end of document ready



