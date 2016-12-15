<?php
require_once 'config.php';
include("header.php");
session_start();

$register = $_GET['success'];

if ( empty( $_POST ) ) {
     if (!$_SESSION["loggedin"]){

         if($register)
         {
             echo "<script>
                    alert('Account Created Successfully');
</script>";
         }
?>

<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="js/checkuser.js"></script>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="container">
	<form name="login" action="login.php"  onsubmit="return checkEmptyLogin();" method="POST">
    <div class="form-group">
		<label for 'username'>Username: </label>
		<input name="username" id="username" type="text" class="form-control"  placeholder="Username" >
		
		<label for 'password'>Password: </label>
		<input name="password" id="password" type="password" class="form-control"  placeholder="Password">
		
		 
        </div>
        <button class="btn btn-default" id="submit" type="submit" >Submit</button>
        
	</form>
    
    <button class="btn btn-default" id="register"  onclick="location.href='register.php'" >No Account? Register</button>
    
</div>
</body>


</html>


<?php
     
    } else {
        header('Location: index.php');
    } 
} else {
	
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam(':username', $username); //Bind parameters
        $query->execute();
        $result = $query->fetch();
        if($result)
        {
            if(password_verify($password, $result['hashed_password']))
            {

                
                session_id();
                
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["uid"] = $result['uid'];
                $_SESSION["user"] = $_POST['username'];
                $_SESSION["firstname"] = $result['firstname'];
                $_SESSION["lastname"] = $result['lastname'];
                $_SESSION["email"] = $result['email'];

                if($result['is_admin'] != 1)
                {
                    $_SESSION["admin"] = FALSE;
                } else {
                    $_SESSION["admin"] = TRUE;
                }

                $location = NULL;
                if($_SESSION['location'] != '')
                {
                    $location = $_SESSION['location'];
                    $_SESSION['location'] = NULL;
                    header('Location:' . $location);
                } else {
                    header('Location: index.php');
                }
               
                

                
            } else {
                
                header('Location: login.php');
            }
        } else {
            
            header('Location: login.php');
        }
}
?>