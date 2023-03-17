<?php

include_once 'connection.php';

$fet_id = $fet_desc = $fet_desc = $fet_primary_id = '';
$return_array = array();

try {
    //fetch data 
    $id = (int)$_POST['id'];

    $conn->query('use MyDatabase');

    $db_value = $conn->query("SELECT id,user_id, post_title, post_description FROM Posts WHERE `id`=$id");
    while ($row = $db_value->fetch(PDO::FETCH_ASSOC)) {
        $fet_primary_id = $row['id'];
        $fet_id = $row['user_id'];
        $fet_title = $row['post_title'];
        $fet_desc = $row['post_description'];
    }

    $return_array = array('primary_id' => $fet_primary_id, 'fet_id' => $fet_id, 'fet_title' => $fet_title, 'fet_desc' => $fet_desc);

    echo json_encode($return_array);
    exit;

} catch (PDOException $error){
    echo "Error : " + $error;
}

?>