<?php
include "connection.php";

$first_name = $last_name = $email = $user_password = '';

try {

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

    // first name validation
    $regex_name = "/^[a-zA-Z]+$/";
    if (strlen($first_name) <= 2) {
        echo json_encode(array("success" => false, "message" => "To less character in first name!!!"));
        exit;
    }
    if (strlen($first_name) > 26) {
        echo json_encode(array("success" => false, "message" => "To much character in first name!!!"));
        exit;
    }
    if (!preg_match($regex_name, $first_name)) {
        echo json_encode(array("success" => false, "message" => "Invalid First name!!!"));
        exit;
    }

    //last name validation
    if (strlen($last_name) <= 2) {
        echo json_encode(array("success" => false, "message" => "To less character in last name!!!"));
        exit;
    }
    if (strlen($last_name) > 26) {
        echo json_encode(array("success" => false, "message" => "To much character in last name!!!"));
        exit;
    }
    if (!preg_match($regex_name, $last_name)) {
        echo json_encode(array("success" => false, "message" => "Invalid Last name!!!"));
        exit;
    }

    //already register email validation
    $email_reg = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $fetch_email = $conn->query("SELECT * FROM Users WHERE `email`='$email'");
    while ($row = $fetch_email->fetch(PDO::FETCH_ASSOC)) {
        if ($row['email'] == $email) {
            echo json_encode(array("success" => false, "message" => "This email already registred!!!"));
            exit;
        }
    }
    if (!preg_match($email_reg, $email)) {
        echo json_encode(array("success" => false, "message" => "Invalid Email!!!"));
        exit;
    }

    //password validation
    $password_RegExp = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
    if (strlen($user_password) < 8) {
        echo json_encode(array("success" => false, "message" => "To less character in password!!!"));
        exit;
    }
    if (!preg_match($password_RegExp, $user_password)) {
        echo json_encode(array("success" => false, "message" => "Invalid Password!!!"));
        exit;
    }

    if ($stm->execute() == true) {
        echo json_encode(array("success" => true, "message" => "Register sucssesfully."));
        exit;
    } else {
        echo "Data Not insterted !!!";
        exit;
    }

} catch (PDOException $e) {
    echo 'Error ' . $e->getMessage();
}
