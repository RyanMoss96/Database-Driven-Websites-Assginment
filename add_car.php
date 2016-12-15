<?php
    require_once 'config.php';
    
    $query = $conn->prepare("INSERT INTO cars (car_make, car_model, number_available, rent_cost_per_day) VALUES (:make, :model, :num_avai, :cost)");
    $query->bindParam(':make', $_POST['make']);
    $query->bindParam(':model', $_POST['model']);
    $query->bindParam(':num_avai', $_POST['num_avai']);
    $query->bindParam(':cost', $_POST['cost']);
    
    $result = $query->execute();
        

   

    if($result)
    {
        header('Location: admin.php');
    } else {
         header('Location: admin.php');
    }
?>