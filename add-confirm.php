

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="register.css">
<title>Login</title>
<style>
 
</style>
</head>
<body>

    <?php include 'nav.php'; ?>

	<div class="container">

<?php if( isset($error) && !empty($error)) :?>
<!--  	session_start();
 -->
	<div class="text-danger">
		<?php echo $error; ?>
	</div>

<?php else: ?>
	 
	  <?php
		// Server-side validation to make sure all required fields are filled out

	if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

	if ( !isset($_POST['uname']) || empty($_POST['uname']) || !isset($_POST['psw']) || empty($_POST['psw']) 
			 )
			  {

			$error = "Please fill out all required fields.";
		}
	else 
{

	require 'config.php';

	// DB Connection.
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->errno ) {
			echo $mysqli->error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$sql = "SELECT * FROM login;";
		$results = $mysqli->query($sql);
		if ( $results == false ) {
			echo $mysqli->error;
			exit();
 }

		// Submit the SQL query
		  $results = $mysqli->query($sql);
		  if ( !$results ) {
		  	echo $mysqli->error;
		  	exit();
		 }
		$uname = $_POST['uname']; 
		$password = $_POST['psw'];
 
		$message="";
		// $results = mysqli_query($mysqli , "SELECT * FROM login WHERE uname='" . $_POST["uname"] . "' and psw= '". $_POST["psw"]."'");
	    $results = mysqli_query($mysqli , "SELECT * FROM login WHERE uname='" . $_POST["uname"] . "'");
	    $res = mysqli_fetch_array($results);
        $current_password = $res['psw'];
         
  		$count  = mysqli_num_rows($results);
		if(!$count) {
			$message = "Invalid Username or Password!";
 			echo $message;
			exit();
 
		} else {
			if (password_verify($password, $current_password)){
			 
					// we log them in!
					$_SESSION['logged_in'] = true;
					$_SESSION['uname'] = $_POST['uname'];

					// redirect them to thes home page :)
			     	header('Location: index.php');  }
			else {
				$message = "Invalid Username or Password!";
 			     echo $message;
		         exit();
		         }


			     }
		}      
	     					 
		  $mysqli->close();
	}

?>
    <?php endif; ?>

</div>
				 
  </body>
</html>


 