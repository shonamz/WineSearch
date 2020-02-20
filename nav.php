<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 -->  
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #D8BFD8">
   <a class="navbar-brand" >WineSearch</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="wine.php"><button type="submit"><i class="fa fa-search"></i></button></a>
      </li>
         
    </ul>
    <ul class="nav navbar-nav ml-auto">
         
        <?php if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) : ?>
        <li class="nav-item"><a  class="nav-link" href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li class="nav-item"><a class="nav-link"href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php else : ?>
          <li class="nav-item"><span class="nav-link" style="vertical-align:bottom">Hello <?php echo $_SESSION['uname']; ?></span></li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></span></li>
       <?php endif; ?>
    </ul>
  </div>  
</nav>
<br>

</body>
</html>



