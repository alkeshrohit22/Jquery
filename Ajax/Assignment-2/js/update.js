$(document).ready(function () {
    var data = sessionStorage.getItem("fetch_value");
    const value = JSON.parse(data);
    console.log(value);
    var delete_key = value['primary_id'];

    $("#id").val(Number(value['fet_id']));
    $("#name").val(value['fet_title']);
    $("#desc").val(value['fet_desc']);

    console.log('delete key' + delete_key);
    $("#updateForm").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: 'php/change.php',
            type: 'POST',
            data: {
                delete_key: delete_key,
                id: $('#id').val(),
                name: $('#name').val(),
                desc: $('#desc').val()
            },
            datatype: 'JSON',
            success: function (resp) {
                const response = JSON.parse(resp);

                if (response['success'] == true) {
                    window.location.href = 'view.html';
                } else {
                    alert(response["message"]);
                }
            },
            error: function (resp) {
                alert('Error : ' + resp);
            }

        });
    });


});