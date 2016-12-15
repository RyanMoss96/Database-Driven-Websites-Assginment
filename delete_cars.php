
<?php
    session_start();
    
    require_once 'config.php';
    
        $car = $_GET['car_id'];

        $carquery = $conn->prepare("DELETE FROM cars WHERE car_id = :car_id");
        $carquery->bindParam(':car_id', $car);
        $carresult = $carquery->execute();
       

       header('Location: admin.php');


    
?>