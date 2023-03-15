<?php

include_once 'connection.php';

try {
    $ID = (int)$_POST['id'];

    $dbSQL = "DELETE FROM movie_form WHERE `id`=$ID";
    if($conn->exec($dbSQL) == true){
        
        exit;
    }
}catch (PDOException $error){
    echo 'Error : '. $error;
}

?>