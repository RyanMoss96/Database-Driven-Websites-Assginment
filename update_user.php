<?php
    require_once 'config.php';

    
    $query = $conn->prepare("SELECT hashed_password FROM users WHERE uid = :uid");
    $query->bindParam(':uid', $_POST['uid']);
    
    $result = $query->execute();
    if($result)
    {
        $password = $_POST['confirmPassword'];
        $results = $query->fetch();
        if(password_verify($password, $results['hashed_password']))
        {
            $query = $conn->prepare("UPDATE users SET firstname = :firstname,lastname = :lastname,username = :username ,email = :email WHERE uid = :uid");
            $query->bindParam(':firstname', $_POST['firstname']);
            $query->bindParam(':lastname', $_POST['lastname']);
            $query->bindParam(':username', $_POST['username']);
            $query->bindParam(':email', $_POST['email']);
            $query->bindParam(':uid', $_POST['uid']);
            $result = $query->execute();
            if($result)
            {
                
                session_start();
                
                $_SESSION["uid"] = $_POST['uid'];
                $_SESSION["user"] = $_POST['username'];
                $_SESSION["firstname"] = $_POST['firstname'];
                $_SESSION["lastname"] = $_POST['lastname'];
                $_SESSION["email"] = $_POST['email'];
                
                header('Location: account_info.php?');
            } else {
        
            }
        } else 
        {
            echo "pass";
            $results['hashed_password'];
        }
    } else {
        echo "log";
    }
        
    
?>





              