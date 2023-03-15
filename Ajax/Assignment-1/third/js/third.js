$(document).ready(function(){
    $("#submitBtn").click(function(e){
        e.preventDefault();
        var value = $('#myform').serialize();
        $.ajax({
            url : 'third.php',
            type : "POST",
            dataType : 'text',
            data : value,
            success : function(resp){
                console.log(resp);
                $("#formdata").html(resp);
            },
            error : function(resp){
                console.log(resp);
                alert("Error : " + resp);
            }
        });
    });
});