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
    if ( empty( $_POST ) ) {
        $car = $_GET['car_id'];

        $carquery = $conn->prepare("SELECT * FROM cars WHERE car_id = :car_id");
        $carquery->bindParam(':car_id', $car);
        $carresult = $carquery->execute();
        $cardetails = $carquery->fetch();
?>

<body>
    <div class="container">
    <div class="page-header">
        <h1>Edit Car Information</h1>
    </div>
    </div>

    <div class="container">
        <form id="updateInfo" action="edit_cars.php"  method="POST">
            <div class="form-group">
                <label for "id">Car ID </label>
                <input name="id" id="carID" type="text" class="form-control"  value="<?= $cardetails['car_id']; ?>" readonly="readonly" > 
                <input type="hidden" id="id" value="<?= $cardetails['car_id'];  ?>" />
                </br>

                <label for "make">Car Make </label>
                <input name="make" id="make" type="text" class="form-control"  value="<?= $cardetails['car_make'];  ?>">
                </br>

                <label for "model">Car Model</label>
                <input name="model" id="model "type="text" class="form-control"  value="<?= $cardetails['car_model'];  ?>" >
                </br>
                
                <label for "num_avai">Number Available</label>
                <input name="num_avai" id="num_avai" type="text" class="form-control"  value="<?= $cardetails['number_available'];  ?>">
                </br>
                
                <label for "cost">Cost Per Day</label>
                <input name="cost" id="cost" type="text" class="form-control"  value="<?= $cardetails['rent_cost_per_day']; ?>" >

                </br>

               
            </div>
            <button class="btn btn-default" id="submit-form" type="submit" >Submit</button>
        </form>
    </div>
</body>



</html>

<?php
    } else {
            $query = $conn->prepare("UPDATE cars SET car_make = :carmake, car_model = :carmodel, number_available = :num ,rent_cost_per_day = :rent WHERE car_id = :id");
            $query->bindParam(':id', $_POST['id']);
            $query->bindParam(':carmake', $_POST['make']);
            $query->bindParam(':carmodel', $_POST['model']);
            $query->bindParam(':num', $_POST['num_avai']);
            $query->bindParam(':rent', $_POST['cost']);
            $result = $query->execute();
            if($result)
            {
                header('Location: admin.php');
            } else {
        
            }
    }
    
?>