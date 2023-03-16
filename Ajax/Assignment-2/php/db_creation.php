<?php

$servername = "localhost";
$username = "admin";
$password = "admin";

$db_username = $db_password = '';
$user_username = $user_password = '';
$return_array = array();

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $DBsql = 'CREATE DATABASE IF NOT EXISTS MyDatabase';
    $conn->exec($DBsql);

    $conn->query('use MyDatabase');

    //creating table query
    $Tabsql = "CREATE TABLE IF NOT EXISTS userlogin (
        username VARCHAR(25) PRIMARY KEY,
        userPassword VARCHAR(25)
        )";
    $conn->exec($Tabsql);

    //insert data
    $valsql = "INSERT IGNORE INTO userlogin (username, userPassword)
    VALUES ('admin', 'admin')";
    $conn->exec($valsql);

    //fetch data from database
    $stmt = $conn->query("SELECT username, userPassword FROM userlogin");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $db_username = $row[0];
        $db_password = $row[1];
    }

    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    if($user_username == $db_username ){
        $return_array = array('username_success' => 'success');
    }

    if($user_password == $db_password) {
        $return_array = array('password_success' => 'success');
        //array_push($return_array, 'password_suceess' => 'success');
    }

    echo json_encode($return_array);
    exit;

} catch (PDOException $e) {
    echo  'Error '. $e->getMessage();
}

?>
