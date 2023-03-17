<?php

include_once 'connection.php';

$final_return = array();
$return_array = array();
$db_array = array();
$db_email = $db_password = '';

try {

    $login_username = $_POST['username'];
    $login_password = $_POST['password'];

    $DBsql = 'CREATE DATABASE IF NOT EXISTS MyDatabase';
    $conn->exec($DBsql);

    $conn->query('use MyDatabase');

    // SQL query to check if the table exists
    $table_name = "Users";
    $sql = "SHOW TABLES LIKE '$table_name'";

    // Execute the query
    $stmt = $conn->query($sql);

    // Check if the query returned any results
    if ($stmt->rowCount() > 0) {
        $table_exists = true;
    } else {
        $table_exists = false;
    }

    // Output the result
    if ($table_exists) {
        //fetch record from database
        $db_value = $conn->query("SELECT email, user_password FROM Users");
        while ($row = $db_value->fetch(PDO::FETCH_ASSOC)) {

            $db_email = $row['email'];
            $db_password = $row['user_password'];

            $db_array = array("username" => $db_email,
                "password" => $db_password);

            array_push($return_array, $db_array);
        }

        $len = count($return_array);

        for($i = 0; $i < $len; $i++){
            $username = $return_array[$i]['username'];
            $password = $return_array[$i]['password'];

            if($username == $login_username && $password == $login_password){
                $final_return['success'] = true;
                echo json_encode($final_return);
                exit;
            }
        }
        $final_return['success'] = false;
        echo json_encode($final_return);
        exit;
    } else {
        $final_return['success'] = false;
        echo json_encode($final_return);
        exit;
    }
} catch (PDOException $e) {
    echo 'Error ' . $e->getMessage();
}
