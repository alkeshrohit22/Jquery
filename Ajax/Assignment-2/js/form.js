$(document).ready(function() {
    $("#frm").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "php/insert.php",
            type: "POST",
            data: {
                id: $('#id').val(),
                name: $('#name').val(),
                desc: $('#desc').val()
            },
            dataType: 'json',
            success: function(response) {
                
                if(response.success == true){
                    alert(response.message);
                    window.location.href = 'view.html';
                } else {
                    alert(response.message);
                }
               
            },
            statusCode: {
                409: function(response) {
                    // Handle primary key violation
                    alert(response.responseJSON.message);
                }
            }
        });
    });
});
