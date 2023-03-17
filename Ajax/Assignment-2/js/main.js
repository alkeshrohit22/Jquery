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

                if(response['success'] == false){
                    alert('You are not register user!!!');
                    window.location.href = 'registration.html';
                }
                console.log(resp);
                // const response = JSON.parse(resp);
                // respLen = Object.keys(response).length;
                // console.log(respLen);

                // for (var i = 0; i < respLen; i++) {
                //     success = response['success'];
                // }

                // if (success == true) {
                //     window.location.href = 'form.html';
                // } else {
                //     alert('you are not register user!!!');
                //     window.location.href = 'registration.html';
                // }
            },
            error: function (resp) {
                alert("Error : " + resp);
            }
        });
    });
});