<?php
include "connection.php";
//table creation and insert data into table

$user_ID = $PostTitle = $PostDescription = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get data from user input
    $user_id = $_POST['id'];
    $post_title = $_POST['name'];
    $post_description = $_POST['desc'];

    try {

        $conn->query('use MyDatabase');

        //create table query
        $tableSql = "CREATE TABLE IF NOT EXISTS Posts (
            id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(20),
            post_title VARCHAR(500) NOT NULL,
            post_description VARCHAR(10000) NOT NULL
            )";
        $conn->exec($tableSql);

        // insert post data into table
        $stm = $conn->prepare("INSERT INTO Posts (user_id, post_title, post_description)
        VALUES (:user_id, :post_title, :post_description)");

        $stm->bindParam(':user_id', $user_id);
        $stm->bindParam(':post_title', $post_title);
        $stm->bindParam(':post_description', $post_description);
        

        if ($stm->execute() == true) {
            echo json_encode(array("success"=>true,"message" => "Insert sucssesfully."));
            exit;
        } else {
            echo "Data not insert into database!!!";
        }

    } catch (PDOException $e) {
        echo 'Error ' . $e->getMessage();
    }

}

?>