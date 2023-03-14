<?php

$servername = "localhost";
$username = "admin";
$password = "admin";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbsql = "CREATE DATABASE IF NOT EXISTS FORMDATA";
    $conn->exec($dbsql);

    $selDB = 'use FORMDATA';
    $conn->exec($selDB);

    $dbtable = "CREATE TABLE IF NOT EXISTS movie_form(
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(30) NOT NULL,
        rating INTEGER(10) NOT NULL
        )";
    $conn->exec($dbtable);

//   echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
