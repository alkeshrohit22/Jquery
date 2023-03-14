$(document).ready(function () {
    $('#submitBtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/table_creation.php',
            type: 'POST',
            data: {
                title : $('#title').val(),
                rating : $('#rating').val()
            },
            dataType: 'text',
            success: function (resp) {
                console.log(resp);
                $('.formdata').html(resp);
            },
            error: function (resp) {
                console.log(resp);
                alert("Error : " + resp);
            }
        });
    });
});