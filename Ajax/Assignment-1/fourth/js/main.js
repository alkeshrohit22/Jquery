$(document).ready(function(){
    $("#upload-form").submit(function(e){
        e.preventDefault(); 

        $.ajax({
            url: "main.php", 
            type: "POST", 
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response){ console.log(response);
                $("#image-preview").attr("src", response); 
            },
        });
    });
});