<?php
include 'connection/conn.php'; 
session_start();


if(isset($_POST['submit'])){
    $userID = "user-". substr(uniqid(rand(), true), 0, 7);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $psw_repeat = $_POST['psw_repeat'];
    $query = "INSERT INTO users (`userID`, `name`, `email`, `contact_no`, `address`, `access`, `password`, `departmentID`, `userStatus`) 
    VALUES ('$userID', '$name', '$email', '$contact_no', '$address', 'customer', '$password', 'cus-1', 'active')";
    $result = mysqli_query($conn,$query);
    if($password == $psw_repeat){
        if($result){
            echo "<script>window.alert('Registration Successful')</script>";
            $_SESSION['userID'] = $email;
            header("Location: loginpage.php");
            exit();
        }else{
            echo "<script>window.alert('Invalid Email or Password')</script>";
            
        }
    }else{
        echo "<script>window.alert('Password does not match')</script>";
    }
}



// $name = filter_input(INPUT_POST, 'name');
// $email= filter_input(INPUT_POST, 'email');
// $contact_num= filter_input(INPUT_POST, 'contact_num');
// $address= filter_input(INPUT_POST, 'address');
// $psw= filter_input(INPUT_POST, 'psw');
// $psw_repeat= filter_input(INPUT_POST, 'psw_repeat');


// if (!empty($username)){
// if (!empty($password)){
// $servername = "localhost";
// $dbusername = "root";
// $dbpassword = "";
// $dbname = "test";
// // Create connection
// $conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);


// if (mysqli_connect_error()){
// die('Connect Error ('. mysqli_connect_errno() .') '
// . mysqli_connect_error());
// }
// else{
// $sql = "INSERT INTO registration (name, email, contact_num, address, psw, psw_repeat)
// values ('$name', '$email', '$contact_num', '$address', '$psw', '$psw_repeat')";
// if ($conn->query($sql)){
// echo "New record is inserted sucessfully";
// }
// else{
// echo "Error: ". $sql ."
// ". $conn->error;
// }
// $conn->close();
// }
// }
// else{
// echo "Password should not be empty";
// die();
// }
// }
// else{
// echo "Username should not be empty";
// die();
// }
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="register.css">
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
	<title>Register</title>
	
</head>
<body>
	<form  method="POST">
    <div class="container">
      <h1>PCU-IRS</h1>
      <p style="text-align: center;" class="ppp">Please fill in this form to create an account.</p>
      <hr>
  

      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name" id="name" required>


      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" id="email" required>

      <label for="contact_num"><b>Contact Number</b></label>
      <input type="text" placeholder="Enter Contact Number" name="contact_no" id="contact_num" required>

      <label for="address"><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="address" id="address" required>
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" id="psw" required>
      
  
      <label for="psw_repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw_repeat" id="psw_repeat"   required>
     
      <hr>
      
  <center>
    <button type="button" class="backbtn" onclick="goBack()">Go Back</button>
      <button type="submit" name="submit" class="registerbtn">Register</button>
</center>
<script>
function goBack() {
  window.location.href = 'loginpage.php';
}
</script>

    </div>
  
  </form>


    
    
</body>
</html>
