$(document).ready(function(){
    $("#registerForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url : "php/register.php",
            type : "POST",
            data : {
                firstname : $('#firstname').val(),
                lastname : $('#lastname').val(),
                email : $('#email').val(),
                password: $('#password').val()
            },
            datatype : 'JSON',
            success : function (response){
                const resp = JSON.parse(response);
                console.log('response : ' + response);
                if(resp['success'] == true){
                    alert(resp['message']);
                    window.location.href = "index.html";
                }
            },
            error: function(response){
                alert('Error : ' + response);
            }
        });
    })
})