<?php

include_once('connection.php');

$return_array = array();
$db_array = array();

try {

    //selecting database
    $conn->query('use MyDatabase');

    //fetch record from database
    $db_value = $conn->query("SELECT * FROM Posts");
    
    while ($row = $db_value->fetch(PDO::FETCH_ASSOC)) {
        $db_id = $row['id'];
        $db_userid = $row['user_id'];
        $db_title = $row['post_title'];
        $db_desc = $row['post_description'];

        $db_array = array("id" => $db_id,
            "userid" => $db_userid,
            "title" => $db_title,
            "description" => $db_desc);

        array_push($return_array, $db_array);
    }
    echo json_encode($return_array);
    exit;

}catch (PDOException $e){
    echo "Error : " + $e;
}

?>