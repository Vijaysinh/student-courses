$(document).ready(function() {
    $('#dob').datepicker();
});

$('#fname').keypress(function(e) {
    $('#fname').css("border", "solid 1px #495057");
    var regex = new RegExp("^[a-zA-Z ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    } else {
        e.preventDefault();
        $('#fname').css("border", "solid 1px red");
        return false;
    }
});

$('#phone').keypress(function(e) {
    $('#phone').css("border", "solid 1px #495057");
    var regex = new RegExp("^[0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    } else {
        e.preventDefault();
        $('#phone').css("border", "solid 1px red");
        return false;
    }
});