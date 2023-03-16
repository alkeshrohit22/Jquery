$(document).ready(function(){
    $('#addValue').on('click', function(){
        alert('called!');
        window.location.href = 'form.html';
    });
});

function moveToDelete(id){
    if(confirm("Sure You Want to delete?")){
        console.log(id);
        window.location.href = "delete.php?id="+id;
    }
}

function moveToUpdate(value){
    if(confirm("Sure You Want to Update?")){
        console.log(value);
        window.location.href = "update.php?id="+value;
    }
}