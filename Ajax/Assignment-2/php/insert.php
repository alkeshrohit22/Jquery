<?php
include "connection.php";
//table creation and insert data into table

$user_id = $post_title = $post_description = "";
$id = $title = $description = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get data from user input
    $id = $_POST['id'];
    $title = $_POST['name'];
    $description = $_POST['desc'];

    //remove unwanted space
    $user_id = (int)test_input($id);
    $post_title = test_input($title);
    $post_description = test_input($description);

    try {

        $conn->query('use MyDatabase');

        //create table query
        $tableSql = "CREATE TABLE IF NOT EXISTS Posts (
            id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(20),
            post_title VARCHAR(500) NOT NULL,
            post_description LONGTEXT NOT NULL
            )";
        $conn->exec($tableSql);

        //user id validation
        $fetch_id = $conn->query("SELECT * FROM Posts WHERE `user_id`='$user_id'");
        while ($row = $fetch_id->fetch(PDO::FETCH_ASSOC)) {
            if ($row['user_id'] == $user_id) {
                echo json_encode(array("success" => false, "message" => "Already registred User Id!!!"));
                exit;
            }
        }
        if($user_id <= 0) {
            echo json_encode(array("success" => false, "message" => "Negative value or Zero Value not exepted!!!"));
            exit;
        }
        if ($user_id > 20000000000000000000) {
            echo json_encode(array("success" => false, "message" => "To Long User Id!!!"));
            exit;
        }

        //name valdiation
        if (strlen($post_title) <= 2) {
            echo json_encode(array("success" => false, "message" => "To less character in name!!!"));
            exit;
        }
        if (strlen($post_title) > 500) {
            echo json_encode(array("success" => false, "message" => "To much character in name!!!"));
            exit;
        }

        //description validation
        if (strlen($post_description) < 5) {
            echo json_encode(array("success" => false, "message" => "To less character in description!!!"));
            exit;
        }
        if (strlen($post_description) > 10000) {
            echo json_encode(array("success" => false, "message" => "To Much character in description!!!"));
            exit;
        }

        // insert post data into table
        $stm = $conn->prepare("INSERT INTO Posts (user_id, post_title, post_description)
        VALUES (:user_id, :post_title, :post_description)");

        $stm->bindParam(':user_id', $user_id);
        $stm->bindParam(':post_title', $post_title);
        $stm->bindParam(':post_description', $post_description);

        if ($stm->execute() == true) {
            echo json_encode(array("success" => true, "message" => "Insert sucssesfully."));
            exit;
        } else {
            echo "Data not insert into database!!!";
        }

    } catch (PDOException $e) {
        echo 'Error ' . $e->getMessage();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
