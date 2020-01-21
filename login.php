 
<?php
require 'config.php';
// DB Connection.
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
  echo $mysqli->connect_error;
  exit();
}

$mysqli->set_charset('utf8');

 $sql = "SELECT * FROM login";
 $sql_r = $mysqli->query($sql);
if ( $sql_r == false ) {
  echo $mysqli->error;
  exit();
}

// Close DB Connection
$mysqli->close();
?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login.css" />
    
    <title>Login</title>
   </head>
  <body>
         
       <?php 
         include 'nav.php'; 
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
          $message = "you are login";
          echo "<script type='text/javascript'>alert('$message'); document.location='index.php'</script>";
        } 
        
       ?>  
        
    <form action="add-confirm.php" method="POST" class="form">
      <div class="container">

      <div class="imgcontainer">
        <img src="rose2.jpg" alt="Avatar" class="avatar" >
      </div>

        <label for="uname-id"><b>Username</b></label>
        <input type="text" id="uname-id" placeholder="Enter Username" name="uname" maxlength="10" required/>

        <label for="psw-id"><b>Password</b></label>
   
        <input type="password" id="psw-id" placeholder="Enter Password" name="psw" maxlength="10" required/>
        <hr>

        <button type="submit" class="loginbutton" >Login</button>
        </div> 
    </form>
    
  
  </body>
</html>
