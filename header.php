<?php
  session_start();
  if (!$_SESSION["loggedin"]) {

?>

<html>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Database Driven Website</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
          </ul>
  
          <ul class="nav navbar-nav navbar-right">
            <li><a id="login" href="login.php">Login</a></li>
            <li><a id="register" href="register.php">Create an Account</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </body>

<?php
    } else {  
?>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Database Driven Website</a>        
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home </a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a id="user" href="account_info.php">Account Information</a></li>
            <?php 
              if( $_SESSION["admin"] == True) {
            ?> 
              
              <li><a href="admin.php">Admin</a></li>

            <?php
              }
            ?>
           
             <li><a href="logout.php">Logout</a></li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </body>
</html>

<?php
  }   
?>
