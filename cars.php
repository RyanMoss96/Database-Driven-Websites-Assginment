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


    
    $CAR_ID = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM cars WHERE car_id = :car_id");
    $query->bindParam(':car_id', $CAR_ID);
    $result = $query->execute();

    if($result)
    {
    $car = $query->fetch();

   
?>


    <body>

    <div class="container ">
        <div class="container col-md-8">
            <div class="page-header">
                <h1>Car Details</h1>
            </div>

            <div class="container">
                <dl class="dl-horizontal">
                    <dt>Car ID</dt>
                    <dd><?php echo $car['car_id']; ?></dd>
                    <dt>Car Make</dt>
                    <dd><?php echo $car['car_make']; ?></dd>
                    <dt>Car Model</dt>
                    <dd><?php echo $car['car_model']; ?></dd>
                    <dt>Number Available</dt>
                    <dd><?php echo $car['number_available']; ?></dd>
                    <dt>Cost Per Day</dt>
                    <dd><?php echo $car['rent_cost_per_day']; ?></dd>
                </dl>
            </div>
            

            

        </div>

        <div class="container col-md-4">
            <div class="page-header">
                <h1>Rent</h1>
            </div>

            <div class="container-fluid">
	            <form name="rent_date" action="rent.php" method="GET">
                <div class="form-group">
		            <label for 'start'>Start Date: </label>
		            <input type="date" id="start" name="start" class="form-control">
		
		            <label for 'end'>End Date: </label>
	                <input type="date" id="end" name="end" class="form-control">

                    <input type="hidden" id="id" name="id" class="form-control" value="<?= $CAR_ID; ?>">

                   
                </div>
                <button class="btn btn-default" id="submit" type="submit" >Submit</button>
                </form>
            </div>
        </div> 
    </div> <!--Container-->
    </body>
</html>

<?php
    } else {

    }


?>