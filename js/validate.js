// validate signup form on keyup and submit
$(document).ready(function(){
    $(function() {

        $( "#data_urodzenia" ).datepicker({
            yearRange: '1900:2019',
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            minDate: '-90Y',
            maxDate: '-18Y',
        });

        $( "#do_kiedy_kontrakt" ).datepicker({
            yearRange: '2019:2099',
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            minDate: '+1M',
            maxDate: '+30Y',
        });

        $( "#data" ).datepicker({
            yearRange: '2000:2099',
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });

    $.validator.addMethod("nameRegex", function(value, element) {
        return this.optional(element) || /^[a-z-ZąęćżźńłóśĄĆĘŁŃÓŚŹŻ0-9\-\s]+$/i.test(value);
    });
    $.validator.addMethod("sqlDate", function(value, element) {
        return value.match(/^\d\d\d\d?\-\d\d?\-\d\d$/);
        }, "Please enter a date in the format dd/mm/yyyy."
    );

    $.validator.addMethod('rozegranyDate', function(value) {
        var today = new Date().toJSON().slice(0,10);
        var inputedDate = $("#data").val();
        //alert(inputedDate+" "+today);
        if($('#rozegrany').is(':checked')){
            return inputedDate < today;
        }else{
            return true;
        }
    }, 'Jeżeli mecz został rozegrany, proszę wprowadzić wcześniejszą date od dzisiejszej');

	$("#signupForm").validate({
		rules: {
            // Drużyna
			nazwa: {
                required: true,
                nameRegex: true,
                minlength: 2
            },
			id_liga: "required",
            logo: {
                accept: "image/*"
            },
            // Mecz
            druzyna_gospodarz: "required",
            druzyna_gosc: "required",
            data: {
                required : true,
                sqlDate : true,
                rozegranyDate: true
            },
            godzina: {
                required: true,
                time: true
            },
            wynik_gosc:{
                required : "#rozegrany:checked"
            },
            wynik_gospodarz:{
                required : "#rozegrany:checked"
            },
            rozegrany:{
                required: function(element) {
                    return $("#wynik_gosc").val() != '' && $("#wynik_gospodarz").val() != '';
                }
            },
            // Zawodnik
            imie: {
                required: true,
                nameRegex: true,
                minlength: 2
            },
            nazwisko: {
                required: true,
                nameRegex: true,
                minlength: 2
            },
            data_urodzenia: {
                required : true,
                sqlDate : true
            },
            wzrost: {
                required : true,
                number : true,
                max: 220,
                minlength: 3
            },
            narodowosc: {
                required : true,
                nameRegex: true,
                minlength: 2
            },
            do_kiedy_kontrakt: {
                required : true,
                sqlDate : true
            },
            id_druzyna: "required",
            id_pozycja: "required"
		},
		messages: {
			nazwa: {
                required:"Proszę wprowadzić nazwę",
                nameRegex:"Wprowadzono niedopuszczalne znaki",
                minlength:"Minimalna ilość znaków to {0}"
            },
			id_liga: "Proszę wybrać ligę",
            logo: "Proszę wybrać odpowiedni format pliku",
            druzyna_gospodarz: "Proszę wybrać drużynę",
            druzyna_gosc: "Proszę wybrać drużynę",
            data:{
                 required: "Proszę wprowadzić datę",
                 sqlDate: "Nieprawidłowy format daty"
            },
            godzina: "Proszę wprowadzić godzinę",
            imie : {
                required:"Proszę wprowadzić nazwisko",
                nameRegex:"Wprowadzono niedopuszczalne znaki",
                minlength:"Minimalna ilość znaków to {0}"
            },
            nazwisko : {
                required:"Proszę wprowadzić nazwisko",
                nameRegex:"Wprowadzono niedopuszczalne znaki",
                minlength:"Minimalna ilość znaków to {0}"
            },
            data_urodzenia : {
                required:"Proszę wprawdzić datę urodzenia",
                sqlDate:"Nieprawidłowy format daty"
            },
            wzrost : {
                minlength:"Minimalny wzrost to 100cm",
                required:"Proszę wprowadzić wzrost"
            },
            narodowosc :{
                required:"Proszę wprowadzić narodowość",
                minlength:"Minimalna ilość znaków to {0}",
                nameRegex:"Wprowadzono niedopuszczalne znaki"
            },
            do_kiedy_kontrakt : "Proszę wprwadzić datę",
            id_druzyna : "Proszę wybrać drużynę",
            id_pozycja : "Proszę wybrać pozycję",
            wynik_gosc : "Jeżeli mecz został rozegrany, podaj wynik",
            wynik_gospodarz : "Jeżeli mecz został rozegrany, podaj wynik"
			}
		});

        $('#rozegrany').click(function() {
            $("#wynik").slideToggle();
            if ($('#rozegrany').not(':checked').length) {
                //$(this).prop('checked',false);
                $('#wynik_gosc').val('');
                $('#wynik_gospodarz').val('');
            }
        });
});
