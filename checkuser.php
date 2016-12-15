<?php
require_once 'config.php';
if (isset($_POST['username'])) { //Check if form data has actually been posted
    $username = $_POST['username']; //Retrieve username from POST data
  
    $jsonReply = array(); //Create an array for the JSON response
    $query = $conn->prepare ("SELECT * FROM users WHERE username = :user"); //Write the query
    $query->bindParam(':user', $username); //Bind parameters
    $query->execute(); //Run the query
    $count = $query->rowCount();
    
    if ($count > 0) { //Do we have any results?
        $jsonReply['availability'] = false; //Set availability to false
        header('Content-Type:application/json;');
        echo json_encode($jsonReply); //Encode the array to JSON
    } else {
        $jsonReply['availability'] = true; //Set availability to true
        header('Content-Type:application/json;');
        echo json_encode($jsonReply); //Encode the array to JSON
    }
}
?>