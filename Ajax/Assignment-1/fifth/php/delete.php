<?php

include_once 'connection.php';

$return_array = array();

try {
    $ID = (int)$_POST['id'];

    $dbSQL = "DELETE FROM movie_form WHERE `id`=$ID";
    // if($conn->exec($dbSQL) == true){
    //     $return_array = array("Sucess"=>"Sucess");
    //     echo json_encode($return_array);
    //     exit;
    // }
}catch (PDOException $error){
    echo 'Error : '. $error;
}

?>