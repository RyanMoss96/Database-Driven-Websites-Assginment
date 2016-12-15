<html>
    <head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="js/bootstrap.min.js"></script>
      <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>


<?php
    session_start();
    include("header.php");
    require_once 'config.php';

    if (!$_SESSION["loggedin"]){
        $_SESSION['location'] = $_SERVER['REQUEST_URI'];
        header("Location:login.php");
    } else {

        $car = $_GET['id'];
        $start = $_GET['start'];
        $end = $_GET['end'];

        $carquery = $conn->prepare("SELECT * FROM cars WHERE car_id = :car_id");
        $carquery->bindParam(':car_id', $car);
        $carresult = $carquery->execute();
        $cardetails = $carquery->fetch();

        $car_total = $cardetails['number_available'];
        $cost = $cardetails['rent_cost_per_day'];

        $query = $conn->prepare("INSERT INTO bookings (user_id,car_id,start_date,return_date,cost_per_day) VALUES (:user_id, :car_id, :start_date, :return_date, :cost)");
        $query->bindParam(':user_id', $_SESSION["uid"]);
        $query->bindParam(':car_id', $car);
        $query->bindParam(':start_date', $start);
        $query->bindParam(':return_date', $end);
        $query->bindParam(':cost', $cost);
        $result = $query->execute();  


        if($result)
        {
            $car_total = $car_total - 1;

            $query = $conn->prepare("UPDATE cars SET number_available = :total WHERE car_id = :car_id");
            $query->bindParam(':total', $car_total);
            $query->bindParam(':car_id', $car);
            $result = $query->execute();

            if($result)
            {
         
       
  
?>

    <body>
        <div class="container">
            <div class="page-header">
                <h1>Booking Confirmed</h1>
            </div>
        </div>

        <div id="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Car ID</th>
                            <th>Car Make</th>
                            <th>Car Model</th>
                           
                            <th>Cost per Day (£)</th>
                            <th>Return Date</th>
                        </tr>
                    </thead>

                    <tbody>
                    
                        <tr>
                            <td><?php echo $cardetails['car_id']; ?></td>
                            <td><?php echo $cardetails['car_make']; ?></td>
                            <td><?php echo $cardetails['car_model']; ?></td>
                            
                            <td><?php echo $cardetails['rent_cost_per_day']; ?></td>
                            <td><?php echo $end; ?></td>
                         

                        </tr>
                    
                    </tbody>
                    </table>
                    <a class="btn btn-default" href="index.php">Home</a>
                </div>
            </div>
        </div>

       
</body>

</html>

<?php
    } else {
            echo "error";
        }
    }
}
?>
