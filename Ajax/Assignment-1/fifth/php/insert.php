<?php

include_once 'connection.php';

$movie_title = $movie_rating = '';
$result = '';

$db_array = array();
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
    // $stmt->execute();

    //fetch record from database
    $db_value = $conn->query("SELECT * FROM movie_form");
    while($row = $db_value->fetch(PDO::FETCH_ASSOC)){
        $db_id = $row['id'];
        $db_title = $row['title'];
        $db_rating = $row['rating'];

        $db_array = array("id" => $db_id,
        "title" => $db_title, 
        "rating" => $db_rating);

        array_push($return_array, $db_array);
    }

    echo json_encode($return_array);
    exit;

} catch (PDOException $error) {
    echo "Error : " . $error->getMessage();
}
