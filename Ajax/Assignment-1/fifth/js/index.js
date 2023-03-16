$(document).ready(function () {
    $('#submitBtn').click(function (e) {
        e.preventDefault();
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
                }
            },
            error: function (resp) {
                console.log('Error : ' + resp);
                alert("Error : " + resp);
            }
        });
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
            alert("Error : " + resp);
        }
    });
}


function ascOrder(n) {
    alert('called!!');
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

            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            }

            // else if (dir == "desc") {
            //     if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //         //if so, mark as a switch and break the loop:
            //         shouldSwitch = true;
            //         break;
            //     }
            // }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        }
        // else {
        //     if (switchcount == 0 && dir == "asc") {
        //         dir = "desc";
        //         switching = true;
        //     }
        // }
    }
}

function descOrder(n) {
    alert('function desc function callled in movies');
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

            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
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
