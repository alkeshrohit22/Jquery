$(document).ready(function () {
    viewData();
    $('#addValue').on('click', function () {
        window.location.href = 'form.html';
    });
});

function moveToDelete(id) {
    if (confirm("Sure You Want to delete?")) {
        $.ajax({
            url: 'php/delete.php',
            type: 'POST',
            data: {
                id: id
            },
            datatype: 'JSON',
            success: function (resp) {
                const response = JSON.parse(resp);

                if(response['success'] == true){
                    viewData();
                }
            },
            error: function (resp) {
                alert('Error : ' + resp);
            }
        });
    }
}

function moveToUpdate(id) {
    $.ajax({
        url: 'php/update.php',
        type: 'POST',
        data: {
            id: id
        },
        datatype: 'JSON',
        success: function (resp) {
            if(confirm("Sure you want to Update???")){
                sessionStorage.setItem('fetch_value', resp);
                window.location.href = 'updateform.html';
            }
        },
        error: function (resp) {
            alert('Error : ' + resp);
        }
    });
}

function viewData() {
    $.ajax({
        url: 'php/view.php',
        type: "POST",
        datatype: "JSON",
        success: function (resp) {
            const response = JSON.parse(resp);

            let tableRows = "";

            for (let i = 0; i < response.length; i++) {
                tableRows += "<tr>";
                // tableRows += "<td>" + myObj[i].id + "</td>";
                tableRows += "<td>" + response[i].userid + "</td>";
                tableRows += "<td>" + response[i].title + "</td>";
                tableRows += "<td>" + response[i].description + "</td>";
                tableRows += "<td><button type='button' class='UpdateBtn' id='UpdateBtn' onclick='moveToUpdate(" + response[i].id + ")'>Update</button></td>";
                tableRows += "<td><button type='button' class='deleteBtn' id='deleteBtn' onclick='moveToDelete(" + response[i].id + ")'>Delete</button></td>";
                tableRows += "</tr>";
            }
            //$('#tbody').remove();
            $("#tbody").html(tableRows);
        },
        error: function (resp) {
            alert('Error : ' + resp);
        }
    });
}