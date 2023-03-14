<?php

include_once 'connection.php';

$result = '';

//get data from html form
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$comment = $_POST['comment'];

try{

    $stm ="INSERT INTO FORM (firstname, lastname, email, comment)
    VALUES ('$fname', '$lname', '$email', '$comment')";
    $conn->exec($stm);
    // $stm->bindParam(':fname', $fname);
    // $stm->bindParam(':lname', $lname);
    // $stm->bindParam(':email', $email);
    // $stm->bindParam(':comment', $comment);

    //fetching data from database
    $selectVal = $conn->query("SELECT * FROM FORM");

    $result .= '<table border=1>';
    $result .= '<tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Comment</th>
        </tr>';

    while($row = $selectVal->fetch(PDO::FETCH_ASSOC)){
        $result .= '<tr><td>'.$row['id'].'</td>';
        $result .= '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
        $result .= '<td>'.$row['email'].'</td>';
        $result .= '<td>'.$row['comment'].'</td>';
        $result .= '</tr>';
    }
    $result .= '</table>';
    echo $result;
    exit;
} catch(PDOException $e) {
    echo "Error : ".$e->getMessage();
}

?>