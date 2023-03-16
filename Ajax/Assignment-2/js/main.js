$(document).ready(function () {
    $("#loginform").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "php/db_creation.php",
            type: "POST",
            data: {
                username: $('#username').val(),
                password: $('#password').val()
            },
            datatype: "json",
            success: function (resp) {
                console.log(resp);
            },  
            error: function (resp) {
                //console.log('Error : ' + resp);
                alert("Error : " + resp);
            }
        });
    });
});