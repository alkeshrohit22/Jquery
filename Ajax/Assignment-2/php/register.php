<?php 

$servername = "localhost";
$username = "admin";
$password = "admin";

$first_name = $last_name = $email = $user_password = '';

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $DBsql = 'CREATE DATABASE IF NOT EXISTS MyDatabase';
    $conn->exec($DBsql);

    $conn->query('use MyDatabase');

    //creating table query
    $Tabsql = "CREATE TABLE IF NOT EXISTS Users (
        id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(25) NOT NULL,
        last_name VARCHAR(25) NOT NULL,
        email VARCHAR(50) NOT NULL,
        user_password VARCHAR(20) NOT NULL
        )";
    $conn->exec($Tabsql);

    // insert post data into table
    $stm = $conn->prepare("INSERT INTO Users (first_name, last_name, email, user_password)
    VALUES (:first_name, :last_name, :email, :user_password)");

    $stm->bindParam(':first_name', $first_name);
    $stm->bindParam(':last_name', $last_name);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':user_password', $user_password);

    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    if($stm->execute() == true ){
        echo json_encode(array("success"=>true,"message" => "Register sucssesfully."));
        exit;
    } else {
        echo "Data Not insterted !!!";
        exit;
    }

} catch (PDOException $e) {
    echo  'Error '. $e->getMessage();
}

$conn = null;
?>