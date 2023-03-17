<?php

include_once 'connection.php';

$primary_id = $fet_id = $fet_title = $fet_desc = '';

try {
    $primary_id = (int)$_POST['delete_key']; 
    $fet_id = $_POST['id'];
    $fet_title = $_POST['name'];
    $fet_desc = $_POST['desc'];

    //selecting database
    $conn->query('use MyDatabase');

    $update = "UPDATE Posts SET `user_id` = '$fet_id', `post_description` = '$fet_desc', `post_title` = '$fet_title' WHERE `ID` = $primary_id";

    //prepare statement
    $stmt = $conn->prepare($update);

    if ($stmt->execute() == true) {
        echo json_encode(array("success" => true, "message" => "Update sucssesfully."));
        exit;
    }

} catch (PDOException $error) {
    echo "Error : "+$error;
}
