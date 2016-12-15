<html>
    <head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	    
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/checkuser.js"></script>
	<script>
        $( document ).ready(function() {
        $("#submitPassword").prop('disabled',true);
        });
    </script>
    </head>

<?php
    session_start();
    include("header.php");
    require_once 'config.php';
    if (!$_SESSION["loggedin"]){
         header('Location: login.php');
    } else {
          
        
    

?>
<div class="container">
  <div class="page-header">
    <h1>Update Account Information</h1>
  </div>
</div>

<div class="container">
	<form id="updateInfo" action="update_user.php"  method="POST">
        <div class="form-group">
            <label for "uid">User ID </label>
            <input name="uid" id="userID" type="text" class="form-control"  value="<?= $_SESSION['uid'] ?>" readonly="readonly" > 
            <input type="hidden" id="uid" value="<?= $_SESSION['uid'] ?>" />
            </br>

            <label for "firstname">First name </label>
            <input name="firstname" id="firstname" type="text" class="form-control"  value="<?= $_SESSION['firstname'] ?>">
            </br>

            <label for "lastname">Surname</label>
            <input name="lastname" id="lastname" type="text" class="form-control"  value="<?= $_SESSION['lastname'] ?>" >
            </br>
            
            <label for "email">Email </label>
            <input name="email" id="email" type="email" class="form-control"  value="<?= $_SESSION['email'] ?>" required pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="Email must be in a valid format.">
            </br>
            
            <label for "username">Username</label>
            <input name="username" id="username" type="text" class="form-control"  value="<?= $_SESSION['user'] ?>" >
            <span id="msg_username"></span>
            </br>

            <label for 'password'>Confirm Password: </label>
		    <input name="confirmPassword" id="confirmPassword" type="password" class="form-control"  placeholder="Password" onblur="checkPass()">
            <span id="msg_password"></span>
        </div>
        <button class="btn btn-default" id="submit-form" type="submit" >Submit</button>
    </form>
</div>
    
 <div class="container">
    <div class="page-header">
        <h1>Change Password</h1>
    </div>
</div>

<div class="container">
	<form id="updatePassword" action="update_pass.php"  method="POST">
        <div class="form-group">
            

            <label for 'password'>Current Password: </label>
		    <input name="password" id="current_password" type="password" class="form-control"  placeholder="Password">
            <br>

            <label for "new_password">New Password</label>
            <input name="password" id="password" type="password" class="form-control"  placeholder="Password">
            </br>
            
            <label for "retype_password">Retype New Password </label>
            <input name="retype_password" id="retype_password" type="password" class="form-control"  placeholder="Retype Password" onblur="checkPasswords()" >
            <span id="msg_password"></span>
        </div>
        <button class="btn btn-default" id="submitPassword" type="submit" >Submit</button>
    </form>
</div>

<?php

$query = $conn->prepare("SELECT * FROM bookings WHERE user_id = :user_id");
        $query->bindParam(':user_id', $_SESSION['uid']);
        $result = $query->execute();

    if($result)
    {
       


?>

  <div class="container">
    <div class="page-header">
        <h1>Car Rentals</h1>
    </div>

    <div class="row">
       
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Car ID</th>
                <th>Start Date</th>
                <th>Return Date</th>
                <th>Cost per Day (£)</th>
                
              </tr>
            </thead>

            <tbody>
              <?php while($row = $query->fetch()) { ?>
              <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['car_id']; ?></td>
                <td><?php echo $row['start_date']; ?></td>
                <td><?php echo $row['return_date']; ?></td>
                <td><?php echo $row['cost_per_day']; ?></td>
                
              </tr>
              <?php } ?>
            </tbody>
          </table>
       
      </div>
</div>

</html>

<?php
    }
}

    
?>