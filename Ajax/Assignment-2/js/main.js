$(document).ready(function () {
    $("#loginform").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "php/valdiate_user.php",
            type: "POST",
            data: {
                username: $('#username').val(),
                password: $('#password').val()
            },
            datatype: 'JSON',
            success: function (resp) {
                const response = JSON.parse(resp);

                if(response['success'] == true){
                    window.location.href = 'view.html';
                } else if(response['success'] == false){
                    alert('You are not register user!!!');
                    window.location.href = 'registration.html';
                } else {
                    alert('Register First!!!');
                }
            },
            error: function (resp) {
                alert("Error : " + resp);
            }
        });
    });
});