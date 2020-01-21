<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <title>Login First</title>
    <style>

      body{
        padding-top: 80px;
      }

    </style>
  </head>

  <body>
     
  <?php include 'nav.php'; ?>
  <?php 
     $nameErr="Please Register and login ";
   ?> 
    <div class="error" style="color:red;padding:30px;" ><?php echo $nameErr;?></div> 
   <script>document.getelementById("error").innerhtml= $nameErr</script>

  </body>
</html>