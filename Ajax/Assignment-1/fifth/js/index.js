$(document).ready(function () {
    $('#movie_form').submit(function (e) {
        $.ajax({
            url: 'php/insert.php',
            type: 'POST',
            data: {
                title: $('#title').val(),
                rating: $('#rating').val()
            },
            dataType: 'JSON',
            success: function (resp) {
                //console.log(resp);
                var value = resp['Success'];

                if (value == 'Success') {
                    viewData();
                } else {
                    alert("Wrong Value rating value!!!");
                }
            },
            error: function (resp) {
                console.log('Error : ' + resp);
                alert("Error : " + resp);
            }
        });
        e.preventDefault();
    });

});

function moveToDelete(id) {
    const value = { 'id': id };
    // alert('id' + id);
    $.ajax({
        url: 'php/delete.php',
        type: 'POST',
        data: value,
        dataType: 'JSON',
        success: function (resp) {
            var value = resp['Sucess'];
            if (value == 'Sucess') {
                viewData();
            }
        }
    });
}

function viewData() {
    $.ajax({
        url: 'php/view.php',
        type: 'POST',
        dataType: 'JSON',
        success: function (resp) {
            var len = Object.keys(resp).length;

            for (var i = 0; i < len; i++) {
                var movie_id = resp[i].id;
                var title = resp[i].title;
                var rating = resp[i].rating;

                var tr_str = "<tr class='trRows'>" +
                    "<td align='center' class='tdColumn'>" + title + "</td>" +
                    "<td align='center' class='tdColumn'>" + rating + "</td>" +
                    "<td align='center' class='tdColumn'><button type='button' id='deleteBtn' onclick='moveToDelete(" + movie_id + ")'>Delete</button></td>";
                "</tr>";

                var result = result + tr_str;
            }
            $("#myTable").find("tr:gt(0)").remove();
            $("#tbody").html(result);
            $('#title').val('');
            $('#rating').val('');
        },
        error: function (resp) {
            alert("Error in viewData : " + resp);
        }
    });
}


function ascOrder(n) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;

    //getting table
    table = document.getElementById("myTable");

    switching = true;

    while (switching) {

        switching = false;
        rows = table.getElementsByTagName("TR");

        for (i = 1; i < rows.length - 1; i++) {

            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            //condition for rating column
            if (n === 1) {
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
                //condition for movie title
            } else if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        }
    }
}

function descOrder(n) {
    var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;

    //getting table
    table = document.getElementById("myTable");

    switching = true;

    while (switching) {

        switching = false;
        rows = table.getElementsByTagName("TR");

        for (i = 1; i < rows.length - 1; i++) {

            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            //condition for rating column
            if (n === 1) {
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
                //condition for movie title
            } else if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        }
    }
}
