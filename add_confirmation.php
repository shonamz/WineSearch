
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="register.css">
<title>Register</title>
<style>
</style>
</head>

<body>

<?php include 'nav.php'; ?>
<?php 
$passe="";
$nameErr="";
$phpVar=true;
$valid=true;
if($_POST['psw'] !=$_POST['psw-repeat']){
$passe="Password not match, please enter your password again";
$valid=false;
$phpVar=false;
}
if ( !isset($_POST['uname']) || empty($_POST['uname']) || !isset($_POST['psw']) || empty($_POST['psw']) 
)
{
$error = "Please fill out all required fields.";
$valid=false;
}
$username= $_POST['uname'];
$password= $_POST['psw'];
$repPassword =$_POST['psw-repeat'];
 

// Everything good, connect to database to insert this information. 
require 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->errno ) {
echo $mysqli->error;
exit();
}
$mysqli->set_charset('utf8');
/// check for username that are in Database
$uname = $_POST['uname']; 
$results = mysqli_query($mysqli , "SELECT * FROM login WHERE uname='$uname'");
$count  = mysqli_num_rows($results);
if($count==1) {
$nameErr ="Username already exists please try another username";
$valid=false;
$mysqli->close();
}
if ($valid){
require 'server.php';
exit();
}     
?>

<div class="container">
 <form action="add_confirmation.php" method="POST" class="form">
    <h1>Register</h1>
    <p class="error" style="color:red;"><?php echo $nameErr;?></p> 
    <p>Please fill in this form to create an account.</p>
<!--     <br>
 --><label for="uname-id"><b>Username</b></label>
    <input type="text"  id="uname-id" placeholder="Enter User Name" name="uname" maxlength="10" title="Must be max 10 characters" required>
    <script> document.getElementById("uname-id").value= <?php echo json_encode($username) ;?>;</script>
		
    <label for="psw-id"><b>Password</b></label>
    <input type="password" id="psw-id" placeholder="Enter Password" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" maxlength="10" onChange="checkPasswordMatch();" required>
    <script> document.getElementById("psw-id").value= <?php echo json_encode($password) ;?>;</script>
  
    <div id="message">
                <h3>Password must contain the following:</h3>
              <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
              <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
              <p id="number" class="invalid">A <b>number</b></p>
              <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>

    <script >
    var myInput = document.getElementById("psw-id");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
 
    letter.classList.remove("invalid");
    letter.classList.add("valid");
    capital.classList.remove("invalid");
    capital.classList.add("valid");
    number.classList.remove("invalid");
    number.classList.add("valid");
    length.classList.remove("invalid");
    length.classList.add("valid");
     
      
    </script>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" id="psw-repeat" placeholder="Repeat Password" name="psw-repeat" onChange="checkPasswordMatch();" maxlength="10" required>
    <script> document.getElementById("psw-repeat").value= <?php echo json_encode($repPassword) ;?>;</script>

    <div class="invalid" id ="passMatch" style="color:" ><?php echo $passe;?></div> 
    <div class="invalid" id="divCheckPasswordMatch"><b>Password match</b></div>
    <script>
       var varPass = "<?php echo $phpVar; ?>";
       var match= document.getElementById("divCheckPasswordMatch");
      if (varPass){
      match.classList.remove("invalid");
      match.classList.add("valid");
      document.getElementById("passMatch").style.display ="none";

    }

    </script>
    <hr>
    <button type="submit" class="registerbtn" id="submit">Register</button>
 </form>
</div>   


<script>
 
var rep = document.getElementById("psw-repeat");
var error =false;
var matchPassword =false;
  
 // When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  if (error)
  document.getElementById("message").style.display = "block";
else 
  document.getElementById("message").style.display = "none";
}

rep.onfocus = function() {
  document.getElementById("divCheckPasswordMatch").style.display = "block";
  if (matchPassword){
       document.getElementById("passMatch").style.display = "none";
  }

}
rep.onblur = function() {

  if (!matchPassword)
  document.getElementById("divCheckPasswordMatch").style.display = "block";
  else 
   document.getElementById("divCheckPasswordMatch").style.display = "none";

  if (matchPassword){
       document.getElementById("passMatch").style.display = "none";
  }
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {

  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
     error = false;
  }
 else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
     error = true;
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
     error = false;
  }
 else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
     error = true;
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
     error = false;
   }
   else {
    number.classList.remove("valid");
     number.classList.add("invalid");
     error = true;
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
     error = false;
  }
  else {
    length.classList.remove("valid");
    length.classList.add("invalid");
     error = true;
      }

 //match

 var password = $("#psw-id").val();
 var confirmPassword = $("#psw-repeat").val();

 if ((password == confirmPassword) && (error==true)){
   match.classList.remove("invalid");
   match.classList.add("valid");
   matchPassword = true;

    }

 if ((password == confirmPassword) && (error==false))
 {
 match.classList.remove("invalid");
 match.classList.add("valid");
 matchPassword = true;

  }

 if ((password != confirmPassword) && (error==true)){
 match.classList.remove("valid");
 match.classList.add("invalid");
 matchPassword = false;
   }
 if ((password != confirmPassword) && (error==false)){

 match.classList.remove("valid");
 match.classList.add("invalid");
  
  matchPassword =false;
  // document.getElementById("psw-repeat").focus();
   
 }

}
  
function checkPasswordMatch() {
    var password = $("#psw-id").val();
    var confirmPassword = $("#psw-repeat").val();

   if ((password == confirmPassword) && (error==true)){
      
         match.classList.remove("invalid");
         match.classList.add("valid");
         matchPassword = true;

           }
   if ((password == confirmPassword) && (error==false))
   {
   match.classList.remove("invalid");
   match.classList.add("valid");
   matchPassword = true;
     
    }
   if ((password != confirmPassword) && (error==true))
   {
   match.classList.remove("valid");
   match.classList.add("invalid");
    matchPassword = false;
    
    }
   if ((password != confirmPassword) && (error==false)){

   match.classList.remove("valid");
   match.classList.add("invalid");
     
  matchPassword = false;
  // document.getElementById("psw-repeat").focus();
   
   }
     }


rep.onkeyup = function() {

    var password = $("#psw-id").val();
    var confirmPassword = $("#psw-repeat").val();
    
  if ((password == confirmPassword) && (error==true)){
    
       match.classList.remove("invalid");
       match.classList.add("valid");
       matchPassword = true;

        }
   if ((password == confirmPassword) && (error==false))
   {
   match.classList.remove("invalid");
   match.classList.add("valid");
   matchPassword = true;

     }
   if ((password != confirmPassword) && (error==true)){

   match.classList.remove("valid");
   match.classList.add("invalid");
    matchPassword = false;
     
   }
   if ((password != confirmPassword) && (error==false)){

   match.classList.remove("valid");
   match.classList.add("invalid");
   matchPassword =false;
  // document.getElementById("psw-repeat").focus();
   }

  if (matchPassword){
  document.getElementById("passMatch").style.display = "none";
}

}

  $(document).ready(function () {
     $("#psw-repeat").keyup(checkPasswordMatch);
     $("#psw").keyup(checkPasswordMatch);
   
  });


 function InvalidMsg(textbox) {
  if (textbox.value === '') {
      textbox.setCustomValidity('Repeat Password');
  } else if (textbox.validity.typeMismatch){
      textbox.setCustomValidity('please repeat passwordd');
  } else {
     textbox.setCustomValidity('');
  }

  return true;
   }

</script>  
						 
</body>
</html>

