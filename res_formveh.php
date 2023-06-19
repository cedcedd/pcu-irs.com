<?php 
session_start();

include 'connection/conn.php';



if(!isset($_SESSION['userID'])){
  header('location:loginpage.php');
  exit();
}

$userID = $_SESSION['userID'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];
$contact_no = $_SESSION['contact_no'];
$address = $_SESSION['address'];
$departmentID = $_SESSION['departmentID'];
$access = $_SESSION['access'];

 if(isset($_POST['submit'])){
   $vehicleID = "resVehicle-" . substr(uniqid(rand(),true), 0, 4);
   $email = $_POST['email'];
   $vehicle = $_POST['vehicle'];
   $nop = $_POST['nop'];
   $pdt = $_POST['pdt'];
   $rdt = $_POST['rdt'];
   $noa = $_POST['noa'];
   $query = "INSERT INTO reservationVehicle (reservationVehicleID, userID, departmentID, vehicleID, email, nameOfActivity, numberOfPassenger, resDate, pickUp, returnDate, reservationStatus) 
             VALUES ('$vehicleID', '$userID', '$departmentID', '$vehicle', '$email', '$noa', '$nop', CURDATE(), '$pdt', '$rdt', 'Pending')";
   $result = mysqli_query($conn, $query);
    if($result){
      echo "<script>window.alert('Reservation Successful')</script>";
      echo "<script>window.location.href='res_status.php'</script>";
    }else{
      echo "<script>window.alert('Reservation Failed')</script>";
      echo "<script>window.location.href='res_formveh.php'</script>";
    }
 }

?>



<!DOCTYPE html>
<html>
<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
  <link rel="stylesheet" href="res_formveh.css">
  
	<title>Vehicle Reservation Form</title>

</head>
<body>

  <div class="header">
    <div class="logo">
        <img src="pcu.png" alt="Logo">
        <p>PCU-IRS</p>
      </div>
    <div class="header-right">
    <a href="home.php">Home</a>
    <?php 
      if (isset($_SESSION['email']) &&($_SESSION['password'])&&($_SESSION['access']=="department")) 
      {
      ?>
     <a href="req_product.php">Request Product</a>
    <a href="res_prop.php">Reserve Property</a>
    <a href="dashboard.php" >Dashboard</a>
    <a href="settings.php">Settings</a>
    <a href="logout.php">Logout</a>
    <?php
    }else{?>
    
    <a href="res_prop.php">Reserve Property</a>
    <a href="res_status.php" >Reservation Status</a>
    <a href="settings.php">Settings</a>
    <a href="logout.php">Logout</a>
<?php
    }
    ?>
    </div>
  </div>  
  
<main class="main-content">
    <form method = "POST">
        <div class="container">
          <h1>Vehicle Reservation Form</h1>
          <p style="text-align: center; font-size: 15px;">Please fill in this form to make a reservation.</p>
          <hr>
      
    
          <label for="name"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="name" id="name" value=<?php echo $name ?>>
    
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" name="email" id="email" required>
    
          <label for="contactnum"><b>Contact Number</b></label>
          <input type="text" placeholder="Enter Contact Number" name="contactnum" value=<?php echo $contact_no ?>>
    
          <label for="address"><b>Address</b></label>
          <input type="text" placeholder="Enter Address" name="address" id="address"0 value=<?php echo $address ?>>
      
          <?php
$sql = "SELECT * FROM vehicle";
$result = mysqli_query($conn, $sql);
$hasDefaultOption = true; // Flag variable

echo "<div class='form-group'><label for='vehicle'><b>Vehicle</b></label>";
echo "<select name='vehicle' id='vehicle'>";

while ($row = mysqli_fetch_array($result)) {
  if ($hasDefaultOption) {
    echo "<option value='' disabled selected>-SELECT VEHICLE-</option>";
    $hasDefaultOption = false; // Update the flag variable
  }
  echo "<option value='" . $row['vehicleID'] . "'>" . $row['vehicleName'] . "</option>";
}

echo "</select></div>";
?>

          <label><b>Number of Seaters</b></label>
          <input type="text" placeholder="Enter Number of Seaters" name="nos" id="nos" readonly>
      
      

          <label for="nop"><b>Number of Passengers</b></label>
          <input type="number" placeholder="Enter Number of Passengers" name="nop" id="nop" required>

          <label for="pdt"><b>Pickup Date/Time</b></label>
          <input type="datetime-local" placeholder="Enter Check-in Date" name="pdt" id="pdt"   required>

          <label for="rdt"><b>Return Date/Time</b></label>
          <input type="datetime-local" placeholder="Enter Date" name="rdt" id="rdt"   required>

          <label for="noa"><b>Name of Activity</b></label>
          <input type="text" placeholder="Enter Name of Activity" name="noa" id="noa" required>
        
          <hr>
          
          <button type="submit" name="submit" class="reservebtn"><b>Reserve Now</b></button>
          
        </div>
      
      </form>
    
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

  $('#vehicle').change(function() {
    var vehicleId = $(this).val();
    
    $.ajax({
      url: 'get_products.php',
      type: 'POST',
      data: { vehicleID: vehicleId },
      success: function(response) {
        $('#nos').val(response);
      }
    });
  });
});
</script>

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
