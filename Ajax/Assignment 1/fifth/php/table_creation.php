<?php

include_once 'connection.php';

$movie_title = $movie_rating = '';

try {

    //echo '<pre>';print_r($_POST);
    $movie_title = $_POST['title'];
    $movie_rating = (int)$_POST['rating'];

    //checking movie rating
    if($movie_rating > 10){
        echo "<h2>You Enter More than 10 value!!!</h2>";
        exit;
    }

    else

    exit;
    // $movie_title = $_POST['title'];

} catch(PDOException $error) {
    echo "Error : ".$error->getMessage();
}

?>