 <?php 
  session_start();
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    </style>
  </head>
  <body>
    
    <?php include 'nav.php'; ?> 
    <div class="form">
        
    <div class="img-text">

      <button onclick="registerFunction()"type="button" class="btn">Register</button>
      <br />
      <br />
      <button onclick="loginFunction()" type="button" class="btn">Login</button>
      <br />
      <br />
       <form class="search" action="wine.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
      </form>
     </div>

   </div>

    <script>
      function loginFunction() {
        location.replace("login.php");
      }
      function registerFunction(){
        location.replace("register.php");
      }
    </script>
  </body>
</html>
