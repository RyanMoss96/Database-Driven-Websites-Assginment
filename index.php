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
    $query = $conn->prepare("SELECT * FROM cars");
    $result = $query->execute();
    
    if($result)
    {
        
?>

  <body>
    <div id="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Car ID</th>
                <th>Car Make</th>
                <th>Car Model</th>
                <th>Number Available</th>
                <th>Cost per Day (£)</th>
                <th>View</th>
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
                <td><a class="btn btn-default" href="cars.php?id=<?php echo $row['car_id']; ?>">View</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
      } else {
       
      }
?>