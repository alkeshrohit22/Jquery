$(document).ready(function () {
    $("#loginform").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "php/db_creation.php",
            type: "POST",
            data: {
                username: $('#username').val(),
                password: $('#password').val()
            },
            datatype: 'JSON',
            success: function (resp) {
                const response = JSON.parse(resp);
                respLen = Object.keys(response).length;
                console.log(respLen);

                for (var i = 0; i < respLen; i++) {
                    username = response['username'];
                    password = response['password'];
                }

                if (username == 'success' && password == 'success') {
                    window.location.href = 'form.html';
                } else if (username == 'failed' && password == 'success') {
                    alert('Incorrect username!!!');
                } else if (username == 'success' && password == 'failed') {
                    alert('Incorrect password!!!');
                } else {
                    alert('Enter username and password!!!');
                }
            },
            error: function (resp) {
                alert("Error : " + resp);
            }
        });
    });
});