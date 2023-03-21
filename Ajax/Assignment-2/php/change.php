<?php

include_once 'connection.php';

$primary_id = $fet_id = $fet_title = $fet_desc = '';
$id = $title = $desc = "";

try {
    $primary_id = (int)$_POST['delete_key']; 
    $id = $_POST['id'];
    $title = $_POST['name'];
    $desc = $_POST['desc'];

    $fet_id = (int)test_input($id);
    $fet_title = test_input($title);
    $fet_desc = test_input($desc);

    //selecting database
    $conn->query('use MyDatabase');

    //user id validation
    if($fet_id <= 0 ){
        echo json_encode(array("success" => false, "message" => "Negative value and Zeros are not excepted!!!"));
        exit;
    }
    if ($fet_id > 20000000000000000000) {
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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
