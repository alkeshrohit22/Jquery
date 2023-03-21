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

    //user id validation
    if (strlen($fet_id) > 20) {
        echo json_encode(array("success" => false, "message" => "To Long User Id!!!"));
        exit;
    }

    //name valdiation
    if (strlen($fet_title) <= 2) {
        echo json_encode(array("success" => false, "message" => "To less character in name!!!"));
        exit;
    }
    if (strlen($fet_title) > 500) {
        echo json_encode(array("success" => false, "message" => "To much character in name!!!"));
        exit;
    }

    //description validation
    if (strlen($fet_desc) < 5) {
        echo json_encode(array("success" => false, "message" => "To less character in description!!!"));
        exit;
    }
    if (strlen($fet_desc) > 10000) {
        echo json_encode(array("success" => false, "message" => "To Much character in description!!!"));
        exit;
    }



    //update data
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
