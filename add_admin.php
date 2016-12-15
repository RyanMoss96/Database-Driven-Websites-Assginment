<?php
    require_once 'config.php';
    
    $admin = 1;

    $query = $conn->prepare("UPDATE users SET is_admin  = :admin WHERE username = :username");
    $query->bindParam(':admin', $admin);      
    $query->bindParam(':username', $_POST['username']);
    $result = $query->execute();

    if($result)
    {
        header('Location: admin.php?success=true');
    }

?>