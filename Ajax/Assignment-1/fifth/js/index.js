$(document).ready(function () {
    $('#submitBtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/insert.php',
            type: 'POST',
            data: {
                title : $('#title').val(),
                rating : $('#rating').val()
            },
            dataType: 'JSON',
            success: function (resp) {
                var len = Object.keys(resp).length;

                for(var i = 0; i<len; i++){
                    var movie_id = resp[i].id;
                    var title = resp[i].title;
                    var rating = resp[i].rating;

                    var tr_str = "<tr>" +
                    "<td align='center'>" + title + "</td>" +
                    "<td align='center'>" + rating + "</td>" +
                    "<td><button type='button' id='deleteBtn' onclick='moveToDelete("+ movie_id +")'>Delete</button></td>";
                    "</tr>";

                    var result = result + tr_str;
                }

                $('#tbody').append(result);
            },
            error: function (resp) {
                alert("Error : " + resp);
            }
        });
    });
});

function moveToDelete(id){
    const value = {'id' : id};
    // alert('id' + id);
    $.ajax ({
        url : 'php/delete.php',
        type : 'POST',
        data : value,
        dataType : 'JSON',
        success : function(resp){
            console.log('db id : '+ resp);
        }
    });
}
