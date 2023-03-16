<?php
include_once 'connection.php';

$return_array = array();
$db_array = array();

try {
    //fetch record from database
    $db_value = $conn->query("SELECT * FROM movie_form");
    while ($row = $db_value->fetch(PDO::FETCH_ASSOC)) {
        $db_id = $row['id'];
        $db_title = $row['title'];
        $db_rating = $row['rating'];

        $db_array = array("id" => $db_id,
            "title" => $db_title,
            "rating" => $db_rating);

        array_push($return_array, $db_array);
    }

    echo json_encode($return_array);
    exit;

} catch (PDOException $error) {
    echo 'Error in view : ' . $e;
}
