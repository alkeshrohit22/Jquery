<?php

include_once 'connection.php';

$movie_title = $movie_rating = '';
$result = '';

$return_array = array();

try {

    $movie_title = $_POST['title'];
    $movie_rating = (int) $_POST['rating'];

    //checking movie rating
    if ($movie_rating > 10) {
        echo "<h2>You Enter More than 10 value!!!</h2>";
        exit;
    }

    //insert into database
    $stmt = $conn->prepare("INSERT INTO movie_form (title, rating)
    VALUES (:title, :rating)");

    $stmt->bindParam(':title', $movie_title);
    $stmt->bindParam(':rating', $movie_rating);
    $stmt->execute();

    $return_array = array('Success'=>'Success');
    echo json_encode($return_array);
    exit;

} catch (PDOException $error) {
    echo "Error : " . $error->getMessage();
}
?>