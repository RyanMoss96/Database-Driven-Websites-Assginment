<?php
    require_once 'config.php';
    
    $query = $conn->prepare("INSERT INTO users (firstname,lastname,username,email,hashed_password) VALUES (:firstname, :lastname, :username, :email, :hashed_password)");
    $query->bindParam(':firstname', $_POST['firstname']);
    $query->bindParam(':lastname', $_POST['lastname']);
    $query->bindParam(':username', $_POST['username']);
    $query->bindParam(':email', $_POST['email']);
    $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query->bindParam(':hashed_password', $hashed_password);
    $result = $query->execute();
        
    if($result)
    {
        header('Location: login.php?success=true');
    } else {
        header('Location: register.php?error=true');
    }
?>