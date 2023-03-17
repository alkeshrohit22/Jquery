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
                console.log(response.success);
                if(response.success == true){
                    alert(response.message);
                    window.location.href = 'view.html';
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

// function viewData(){
//     $.ajax({
//         url : 'php/view.php',
//         type : 'post',
//         dataType : 'JSON',
//         success : function(response){
//             console.log(response);
//         },
//         error : function(response){
//             alert("Error : " + response);
//         }
//     })
// }