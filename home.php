<?php
session_start();

if(!isset($_SESSION['userID'])){
  header('location:loginpage.php');
  exit();
}

include 'connection/conn.php';
$userID = $_SESSION['userID'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];
$contact_no = $_SESSION['contact_no'];
$address = $_SESSION['address'];
$departmentID = $_SESSION['departmentID'];
$access = $_SESSION['access'];
?>

<!DOCTYPE html>
<html>
<head>
<title>PCU-IRS</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
<link rel="stylesheet" href="home.css">

<div class="header">
    <div class="logo">
        <img src="pcu.png" alt="Logo">
        <p>PCU-IRS</p>
      </div>
      <div class="header-right">
      <?php 
      if (isset($_SESSION['email']) &&($_SESSION['password'])&&($_SESSION['access']=="department")) 
      {
      ?>
          <a href="home.php">Home</a>
          <a href="req_product.php">Request Product</a>
          <a href="res_prop.php">Reserve Property</a>
          <a href="dashboard.php" >Dashboard</a>
          <a href="settings.php">Settings</a>
          <a href="logout.php">Logout</a>
      <?php }elseif (isset($_SESSION['email']) &&($_SESSION['password'])&&($_SESSION['access']=="head")) {
      ?>
          <a href="home.php">Home</a>
          <a href="dashboard.php">Dashboard</a>
          <a href="req_product.php">Request Product</a>
          <a href="res_prop.php">Reserve Property</a>
          <a href="approvals.php">Approvals</a>
          <a href="logout.php">Logout</a>
    <?php
    }else{?>
          <a href="home.php">Home</a>
          <a href="res_prop_cust.php">Reserve Property</a>
          <a href="res_status.php" >Reservation Status</a>
          <a href="settings.php">Settings</a>
          <a href="logout.php">Logout</a>
    <?php
    }
    ?>

  </div>
    
  </div>  


</head>


<body>
  
<div class="bgimg w3-display-container w3-animate-top" id="home">
  
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white responsive-span" style="text-shadow:3px 3px #0a61aa;">General Services Office's<br>Inventory System<br> with Property Reservation</span>
  </div>
  
</div>

<div class="w3-large w3-animate-bottom">
  <h1 class="about"> ABOUT US </h1>
  <div class="w3-content">
    <p style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: black; font-size:23px;  text-align: center;">The General Services Office seeks to offer an automated system that accommodates product requests and property reservations for utilization by customers and the community of the Philippine Christian University.</p>
    <hr>
    <h1 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: #0a61aa; text-align:center;"> VISION </h1>
    <p style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: black; font-size:23px; text-align:center;">A distinctive Christian University integrating Faith, Character and Service, transforming global learners for enlightenment, leadership and human development in the 21st Century.</p>
    <h1 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: #0a61aa; text-align:center;"> MISSION </h1>
    <p style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: black; font-size:23px; text-align: center;">Philippine Christian University, an institution related to The United Methodist Church and United Church of Christ in the Philippines, commits itself to deliver high quality education imbued with the formation of Christian character, responsive to the needs of people, and making them responsible leaders and stewards, fostering inter-faith and international goodwill and understanding.</p>
    <hr>
    <h1 style="text-align:center; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: #0a61aa; ">Website Developers</h1>
  <ul>
    <li>
      <img src="les.jpg">
      <p>Adarlo, John Lester S.</p>
    </li>
    <li>
      <img src="bebe1.jpg">
      <p>Collado, Ronaldo A.</p>
    </li>
    <li>
      <img src="jbc.jpg">
      <p>Cueto, John Benedict S.</p>
    </li>
    <li>
      <img src="ced.jpg">
      <p>Nepomuceno, Cedrick F.</p>
    </li>
  </ul>
  </div>
</div>


<footer>
    <a href="https://www.facebook.com/PhilippineChristianUniversity/"><img src="fb.png" class="left"></a>
    <a href="https://pcu.edu.ph/contact-us/"><img src="number.png" class="leftleftleft"></a>
    <a href="https://www.youtube.com/@philippinechristianunivers3594"><img src="youtube.png" class="leftleft"></a>
    <div class="address">
    <p>1648 Taft Avenue corner Pedro Gil St., Malate, Manila<br>
        © All Rights Reserved 2023</p>
    </div>
  </footer>


</body>
</html>
