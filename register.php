<?php

session_start();
include("header.php");

$Register_error = $_GET['error'];

if($Register_error){
    echo "<script>
            alert('Account failed to create');
        </script>";
}

if (!$_SESSION["loggedin"]){
?>

<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="js/checkuser.js"></script>
	<script>
        $( document ).ready(function() {
        $("#submit").prop('disabled',true);
        });
    </script>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


<div class="container">
	<form id="registration" action="insert_user.php"  onsubmit="return checkempty();" method="POST">
        <div class="form-group">

            <label for "firstname">First name </label>
            <input name="firstname" id="firstname" type="text" class="form-control"  placeholder="First Name">
            </br>

            <label for "lastname">Surname</label>
            <input name="lastname" id="lastname" type="text" class="form-control"  placeholder="Last Name" >
        </br>
            
            <label for "email">Email </label>
            <input name="email" id="email" type="email" class="form-control"  placeholder="Email" required pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="email must be in a valid format" >
        </br>
            
            <label for "username">Username</label>
            <input name="username" id="username" type="text" class="form-control"  placeholder="Username" onblur="checkUser()" >
            <span id="msg_username"></span>
      </br>
            
            <label for "password">Password</label>
            <input name="password" id="password" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" title="Password must contain at least one number and one uppercase and one lowercase letter, and at least 7 or more characters" class="form-control"  placeholder="Password">
       </br>
            
            <label for "retype_password">Retype Password </label>
            <input name="retype_password" id="retype_password" type="password" class="form-control"  placeholder="Retype Password" onblur="checkPasswords()" >
            <span id="msg_password"></span>
            
        </div>

        <button class="btn btn-default" id="submit" type="submit" >Submit</button>
        
    </form>
  
    <button class="btn btn-default" id="login" type="submit" onclick="location.href='login.php'" >Already have an Account? Login</button>
    
    
  
</div>
</body>


</html>
<?php

} else {
        header('Location: index.php');
} 
?>