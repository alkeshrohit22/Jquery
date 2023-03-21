<?php
include "connection.php";

$first_name = $last_name = $email = $user_password = '';
$first = $last = $email_trim = $password_trim = "";

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

    
    $first= $_POST['firstname'];
    $last = $_POST['lastname'];
    $email_trim = strtolower($_POST['email']);
    $password_trim = $_POST['password'];

    $first_name = test_input($first);
    $last_name = test_input($last);
    $email = test_input($email_trim);
    $user_password = test_input($password_trim);

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
        echo json_encode(array("success" => false, "message" => "Should be Alphabets only in First name (No blank Space Expexted)!!!"));
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
        echo json_encode(array("success" => false, "message" => "Should be Alphabets only in last name (No blank Space Expexted)!!!"));
        exit;
    }

    //already register email validation
    $email_reg = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $fetch_email = $conn->query("SELECT * FROM Users WHERE `email`='$email'");
    while ($row = $fetch_email->fetch(PDO::FETCH_ASSOC)) {
        if (strtolower($row['email']) == $email) {
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
        echo json_encode(array("success" => false, "message" => "Password should be contain Alphabet, Number, One uppercase letter and Special Character!!!"));
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

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
