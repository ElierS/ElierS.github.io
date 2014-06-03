$(document).ready(function($) {
    var text = '1 + 1';
    var test = 2;
    var nmax = 5; // número máximo
    var n1 = Math.floor (Math.random() * nmax + 1);
    var n2 = Math.floor (Math.random() * nmax + 1);
    text = n1 + ' + ' + n2;
    test = n1 + n2;
    $('#NOMIKOS_CAPTCHA_TEXT').html(text);
    
    $("#NOMIKOS_FORM_COMMENT").submit(function() {
        if ($('#NOMIKOS_CAPTCHA_TEST').val() != test)
        {
            alert('Por favor resuelva el test captcha.');

            // bloquear el envío retornando falso
            return false;
        }
    });    
});