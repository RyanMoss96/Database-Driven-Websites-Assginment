<?php
require_once 'config.php';

    $model = $_POST['model'];
    $make =  $_POST['make'];
  
   

    $jsonReply = array(); //Create an array for the JSON response
    $query = $conn->prepare ("SELECT * FROM cars WHERE car_make = :make AND car_model = :model"); //Write the query
    $query->bindParam(':make', $make); 
    $query->bindParam(':model', $model);//Bind parameters
    
    $query->execute(); //Run the query
    $count = $query->rowCount();
    
     if ($count > 0) { //Do we have any results?
        $jsonReply['availability'] = true;//Set availability to false
        header('Content-Type:application/json;');
        echo json_encode($jsonReply); //Encode the array to JSON
    } else {
        $jsonReply['availability'] = false; //Set availability to true
        header('Content-Type:application/json;');
        echo json_encode($jsonReply); //Encode the array to JSON
    }
        
  
    
    

?>