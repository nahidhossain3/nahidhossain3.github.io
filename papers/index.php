<?php
session_start();
if(isset($_SESSION['nahid_faculty_user'])){
    if($_SESSION['nahid_faculty_user']=="NHn"){
        header("Location: proc.php"); 
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="img/favicon.ico" rel="icon">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src=
        "https://www.google.com/recaptcha/api.js" async defer>
    </script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
#login{
    width:350px;
    height:200px;
    margin:15% 0 0 40%;
}
</style>
</head>
<body>

<div id="login">
<form action="moni2e.php" method="post">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="nahid_username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="nahid_password" required>
    <div class="g-recaptcha" 
                data-sitekey="6LcI5m4jAAAAABmxn90fXzivysHP7WCIHvFSdw3R">
            </div>    
    <button type="submit">Login</button>
    <?php
        if(isset($_SESSION['nahid_faculty_error']) and $_SESSION['nahid_faculty_error'] == "passwordnotmatched" ){
            echo "<b><font color='red'>Username and password did not match.</font></b>";
        }
        else if(isset($_SESSION['nahid_faculty_error']) and $_SESSION['nahid_faculty_error'] == "recaptcha"){
          echo "<b><font color='red'>Complete the reCAPTCHA challenge</font></b>";
        }
        unset($_SESSION['nahid_faculty_error']);
    ?>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
  </div>
</form>
</div>
</body>
</html>
