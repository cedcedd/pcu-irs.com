<?php

include 'connection/conn.php';

session_start();

if(isset($_POST['reset'])){
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password = $_POST['psw'];
  $password2 = $_POST['psw-repeat'];
  $sql = "SELECT * FROM users WHERE email='$email' AND contact_no='$contact'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if($count == 1){
    if($password == $password2){
      $sql1 = "UPDATE users SET password='$password' WHERE email='$email'";
      $result1 = mysqli_query($conn, $sql1);
      if($result1){
        echo "<script>window.alert('Password changed successfully!')</script>";
        echo "<script>window.location.href='loginpage.php'</script>";
      }else{
        echo "<script>window.alert('Password not changed!')</script>";
      }
    }else{
      echo "<script>window.alert('Password does not match!')</script>";
    }
  }else{
    echo "<script>window.alert('Email or Contact Number does not exist!')</script>";
  }

}



?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="reset_pw.css">
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
	<title>Reset Password</title>
	
</head>
<body>

  <div class="container w3-animate-top">
      <h1>PCU-IRS</h1>
      <p style="text-align: center;" class="ppp">Please fill in this form to reset your password.</p>
      <hr>
          <form method="POST">
              <label for="email"><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" id="email" required>

              <label for="email"><b>Contact Number</b></label>
              <input type="text" placeholder="Enter Contact Number" name="contact" id="contact" required>

              <label for="psw"><b>Change Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
              
              <label for="psw-repeat"><b>Repeat Password</b></label>
              <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat"   required>

                <hr>
                  <div style="text-align:center;">
                  <center>
                  <button type="button" class="backbtn" onclick="goBack()">Go Back</button>
                  <button type="submit" name="reset" class="resetbtn">Reset</button>  
                  
</center>
<script>
function goBack() {
  window.location.href = 'loginpage.php';
}
</script>
                </div>
            </div>
          </form>
    </div>
  

 

    
    
</body>
</html>
