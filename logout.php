<?php
	session_start();

	// to "log out" destory the session
	session_destroy();
	header('Location: index.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

   	<div class="container">
		<div class="row">
            <div class="col-12">You are now logged out.</div>
			<div class="col-12 mt-3">You can go to <a href="index.php">home page</a> or <a href="login.php">log in</a> again.</div>
			 
								 
		</div> <!-- .row -->
	</div> <!-- .container -->


</body>
</html>

 