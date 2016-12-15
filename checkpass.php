<?php
require_once 'config.php';

    $password = $_POST['confirmPassword'];
    $id =  $_POST['id'];
  
    session_start();

    $jsonReply = array(); //Create an array for the JSON response
    $query = $conn->prepare ("SELECT * FROM users WHERE uid = :uid"); //Write the query
    $query->bindParam(':uid', $id); //Bind parameters
    
    $query->execute(); //Run the query
    $result= $query->fetch();
    
     if(password_verify($password, $result['hashed_password']))
     {
        $jsonReply['availability'] = true; //Set availability to false
        header('Content-Type:application/json;');
        echo json_encode($jsonReply); //Encode the array to JSON
     } else {
          $jsonReply['availability'] = false; //Set availability to true
        header('Content-Type:application/json;');
        echo json_encode($jsonReply); //Encode the array to JSON
     }
        
  
    
    

?>