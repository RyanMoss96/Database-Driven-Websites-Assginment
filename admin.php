<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/bootstrap.min.js"></script>
         <script src="js/cars.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

<?php
    session_start();
    include("header.php");
    require_once 'config.php';
    
     if (!$_SESSION["admin"]){
         header('Location: index.php');
    } else {

        $admin = $_GET['success'];

        if($admin)
        {
             echo "<script>
                    alert('Admin Added Successfully');
                    </script>";
        }

         $query = $conn->prepare("SELECT * FROM cars");
        $result = $query->execute();

        $bookingquery =$conn->prepare("SELECT * FROM bookings");
        $bookingresult = $bookingquery->execute();
    
    if($result)
    {

?>

<div class="container">
  <div class="page-header">
    <h1>Add New Admin</h1>
  </div>
</div>

<div class="container">
	<form id="addAdmin" action="add_admin.php"  method="POST">
        <div class="form-group">
           
            <label for "username">Username</label>
            <input name="username" id="username" type="text" class="form-control"  value="" >
            </br>

            <label for 'password'>Confirm Password: </label>
		    <input name="confirmPassword" id="confirmPassword" type="password" class="form-control"  placeholder="Password">
        </div>
        <button class="btn btn-default" id="submit-form" type="submit" >Submit</button>
    </form>
</div>

<div class="container">
  <div class="page-header">
    <h1>Add Car</h1>
  </div>

  <div class="container">
        <form id="addCar"  action="add_car.php" method="POST">
            <div class="form-group">
                

                <label for "make">Car Make </label>
                <input name="make" id="make" type="text" class="form-control"  >
                <span id="msg_carmake"></span>
                </br>

                <label for "model">Car Model</label>
                <input name="model" id="model "type="text" class="form-control" onblur="checkcar()"  >
                <span id="msg_carmodel"></span>
                </br>
                
                <label for "num_avai">Number Available</label>
                <input name="num_avai" id="num_avai" type="text" class="form-control">
                </br>
                
                <label for "cost">Cost Per Day</label>
                <input name="cost" id="cost" type="text" class="form-control"   >

                </br>
            </div>
            <button class="btn btn-default" id="submit-car" type="submit" >Submit</button>
        </form>
    </div>

</div>



<div class="container">
  <div class="page-header">
    <h1>Edit Cars</h1>
  </div>

   <div class="row">
       
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Car ID</th>
                <th>Car Make</th>
                <th>Car Model</th>
                <th>Number Available</th>
                <th>Cost per Day (£)</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>
              <?php while($row = $query->fetch()) { ?>
              <tr>
                <td><?php echo $row['car_id']; ?></td>
                <td><?php echo $row['car_make']; ?></td>
                <td><?php echo $row['car_model']; ?></td>
                <td><?php echo $row['number_available']; ?></td>
                <td><?php echo $row['rent_cost_per_day']; ?></td>
                <td><a class="btn btn-default" href="edit_cars.php?car_id=<?php echo $row['car_id']; ?>">Edit</a></td>
                 <td><a class="btn btn-default" href="delete_cars.php?car_id=<?php echo $row['car_id']; ?>">Delete</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        
      </div>
</div>

<div class="container">
  <div class="page-header">
    <h1>Leased Cars</h1>
  </div>

   <div class="row">
       
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Customer ID</th>
                <th>Car ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Cost per Day (£)</th>
                
              </tr>
            </thead>

            <tbody>
              <?php while($row = $bookingquery->fetch()) { ?>
              <tr>
              <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
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
            
            

            

      


<?php
    }
    }
?>