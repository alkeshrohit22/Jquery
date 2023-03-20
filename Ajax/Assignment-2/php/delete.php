<?php

include_once('connection.php');

$return_array = array();

try {

    //fetch id
    $id = (int)$_POST['id'];

    $conn->query('use MyDatabase');

    $dbSQL = "DELETE FROM Posts WHERE `id`=$id";
    $stm = $conn->prepare($dbSQL);
    if($stm->execute() == true){
        $return_array = array("success"=>true);
    }

    echo json_encode($return_array);
    exit;

} catch (PDOException $error){
    echo "Error : "  + $error;
}

?>