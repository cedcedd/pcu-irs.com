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
?>


<!DOCTYPE html>
<html>
<head>
<title>Reserve Property</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="res_prop_cust.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">


</head>
<body>
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
   
<main class="main-content">

  <!-- Slideshow Header -->
  <div class="w3-animate-bottom">
  <h2 class="title" >Multi-purpose Hall</h2>
  <div class="slideshow-container " >
    <div class="mySlides1">
      <img src="1.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Entrance</p>
      </div>
    </div>
  
    <div class="mySlides1">
      <img src="2.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Entrance</p>
      </div>
    </div>
  
    <div class="mySlides1">
      <img src="3.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Main Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="4.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Main Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="5.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Main Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="6.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Main Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="7.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Main Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="8.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Main Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="9.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Stage Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="10.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Stage Hall</p>
      </div>
    </div>

    <div class="mySlides1">
      <img src="11.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Stage Hall</p>
      </div>
    </div>
    
  
    <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
    <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
    
  </div>


  <div class="w3-container">
    
    <div class="w3-row w3-large">
      
    </div>
    
    
    <h3 style="color:#0a61aa; font-size:30px;">Information:</h3>
<h2 class="rates">Venue Rates</h2>
<ul class="mph mph-360" >
  <li class="mphall">Whole Venue (70,000) - 8 hours including 1-hour ingress and 1-hour egress and use of tables and chairs.</li>
  <li class="mphall">Stage Side (25,000) - 8 hours including 1-hour ingress and 1-hour egress and use of tables and chairs.</li>
  <li class="mphall">Middle (20,000) - 8 hours including 1-hour ingress and 1-hour egress and use of tables and chairs.</li>
  <li class="mphall">Back Side (25,000) - 8 hours including 1-hour ingress and 1-hour egress and use of tables and chairs.</li>
  <li class="mphall">Reception Area (5,000)</li>
</ul>

<h2 class="ls">Lights & Sounds</h2>
<ul class="mph mph-360">
  <li class="mphall">Whole Venue (30,000)</li>
  <li class="mphall">Stage Side (10,000)</li>
  <li class="mphall">Middle (10,000)</li>
  <li class="mphall">Back Side (10,000)</li>
</ul>

<h2 class="ls">Terms of Payment</h2>
<ul class="mph mph-360">
  <li class="mphall">Downpayment - 30% Upon Booking.</li>
  <li class="mphall">Security Deposit - 30,000 to be paid 100% with the DP (refundable or deductible to the balance)</li>
  <li class="mphall">Full Payment - 70% 1 week before the event (regular days)</li>
</ul>


    
    <h3 style="color:#0a61aa; font-size:30px;"><strong>Notes:</strong></h3>
    <h2 class="ls">Equipments</h2>
<ul class="mph mph-360">
  <li class="mphall">Microphone(s)</li>
  <li class="mphall">Tables</li>
  <li class="mphall">Chairs</li>
  <li class="mphall">Projector</li>
  <li class="mphall">Podium</li>
</ul>
<p style="font-size:20px; text-align:justify;">- Inform the General Services Office of your equipment needs after making payment.</p>
    <p style="font-size:20px; text-align:justify;">- If the event exceeds the maximum number of the venue, there will be an additional charge of php 500 per person.</p><br>
    <div class="reservebtn-container">
    <a href="index.php" class="reservebtn">
  Reserve Now
</a>
  
  </div>
  </div>
  <br>
  <br>

  
  <h2 class="title" >Ground Floor Auditorium</h2>
  <div class="slideshow-containers" >
    <div class="mySlides2">
      <img src="12.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Auditorium</p>
      </div>
    </div>
  
    <div class="mySlides2">
      <img src="13.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Auditorium</p>
      </div>
    </div>
  
    <div class="mySlides2">
      <img src="14.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Auditorium</p>
      </div>
    </div>

    <div class="mySlides2">
      <img src="15.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Auditorium</p>
      </div>
    </div>

    <div class="mySlides2">
      <img src="16.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Auditorium</p>
      </div>
    </div>

    <div class="mySlides2">
      <img src="17.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Auditorium</p>
      </div>
    </div>
    
  
    <a class="prev" onclick="plusSlides(-1, 1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1, 1)">&#10095;</a>
    
  </div>


  <div class="w3-container">
    
    <div class="w3-row w3-large">
      
    </div>
    
    
    <h3 style="color:#0a61aa; font-size:30px;"><strong>Information:</strong></h3>
    <h2 style="color:black; font-size:25px; margin-left:85px;">Venue Rate</h2>
<ul class="mph mph-360">
  <li class="mphall">3,000 (per hour) - 8 hours including 1-hour ingress and 1-hour egress and use of tables and chairs.</li>
  
</ul>
    
    
    
    <h3 style="color:#0a61aa; font-size:30px;"><strong>Notes:</strong></h3>
    <p style="font-size:20px; text-align:justify;">- If the event exceeds the maximum number of the venue, there will be an additional charge of php 500 per person.</p><br>
    <div class="reservebtn-container">
    <a href="index.php" class="reservebtn">
  Reserve Now
</a>
    
  </div>
  </div>
  
  <br>
  <br>

       

  <h2 class="title" >University Gymnasium</h2>
  <div class="slideshow-containers1" >
    <div class="mySlides3">
      <img src="18.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Gymnasium</p>
      </div>
    </div>
  
    <div class="mySlides3">
      <img src="19.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Gymnasium</p>
      </div>
    </div>
  
    <div class="mySlides3">
      <img src="20.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Gymnasium</p>
      </div>
    </div>

    <div class="mySlides3">
      <img src="21.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Gymnasium</p>
      </div>
    </div>

    <div class="mySlides3">
      <img src="22.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Gymnasium</p>
      </div>
    </div>

    <div class="mySlides3">
      <img src="23.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Gymnasium</p>
      </div>
    </div>

    
  
    <a class="prev" onclick="plusSlides(-1, 2)">&#10094;</a>
    <a class="next" onclick="plusSlides(1, 2)">&#10095;</a>
    
  </div>


  <div class="w3-container">
    
    <div class="w3-row w3-large">
      
    </div>
    
    
    <h3 style="color:#0a61aa; font-size:30px;"><strong>Information:</strong></h3>
<ul class="mph mph-360">
  <li class="mphall">1,000 per hour is the rate of the University Gymnasium.</li>
  <li class="mphall">No REFUND of payment in cases of cancellation of reservation, they can only reschedule the event.</li>
  <li class="mphall">For Students Safety Measures, the ISPEAC Office requires the Faculty In-Charge to submit the list of participants and to monitor the activity.</li>
  <li class="mphall">User shall be liable for any breakage, destruction of fixtures, loss or any form of vandalism in this facility.</li>
</ul>
    
    
    
    <h3 style="color:#0a61aa; font-size:30px;"><strong>Notes:</strong></h3>
    <ul class="mph mph-360">
  <li class="mphall">The facility must be neat and clean after use. All props, backdrops and other waste materials must be removed.</li>
  <li class="mphall">Only shoes with rubber soles shall be allowed in the wooden floor of the Gymnasium.</li>
  <li class="mphall">Smoking inside the facility is strictly PROHIBITED.</li>
</ul>
<p style="font-size:20px;">WARNING: Non-observance of the above policies will deprive the group from the use of the facility.</p>
<br>
    <div class="reservebtn-container">
    <a href="index.php" class="reservebtn">
  Reserve Now
</a>
    
  </div>
  </div>
  <br>
  <br>

        

  <h2 class="title" >Freedom Park</h2>
  <div class="slideshow-containers2" >
    <div class="mySlides4">
      <img src="25.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Freedom Park</p>
      </div>
    </div>
  
    <div class="mySlides4">
      <img src="26.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Freedom Park</p>
      </div>
    </div>

    <div class="mySlides4">
      <img src="27.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Freedom Park</p>
      </div>
    </div>

    <div class="mySlides4">
      <img src="28.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Freedom Park</p>
      </div>
    </div>

    <div class="mySlides4">
      <img src="29.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Freedom Park</p>
      </div>
    </div>

    <div class="mySlides4">
      <img src="30.png" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Freedom Park</p>
      </div>
    </div>

    <div class="mySlides4">
      <img src="24.jpg" style="width:100%">
      <div class="w3-display-bottommiddle w3-container ">
        <p class="label">Stage</p>
      </div>
    </div>

    
  
    <a class="prev" onclick="plusSlides(-1, 3)">&#10094;</a>
    <a class="next" onclick="plusSlides(1, 3)">&#10095;</a>
    
  </div>
  </div>


  <div class="w3-container">
    
    <div class="w3-row w3-large">
      
    </div>
    
    
    <h3 style="color:#0a61aa; font-size:30px;"><strong>Information:</strong></h3>
    <ul class="mph mph-360">
  <li class="mphall">1,000 per hour is the rate of the Freedom Park.</li>
  <li class="mphall">No REFUND of payment in cases of cancellation of reservation, they can only reschedule the event.</li>
  <li class="mphall">For Students Safety Measures, the ISPEAC Office requires the Faculty In-Charge to submit the list of participants and to monitor the activity.</li>
</ul>
    
    
    
    <h3 style="color:#0a61aa; font-size:30px;"><strong>Notes:</strong></h3>
    <ul class="mph mph-360">
  <li class="mphall">The facility must be neat and clean after use. All props, backdrops and other waste materials must be removed.</li>
  <li class="mphall">User shall be liable for any breakage, destruction of fixtures, loss or any form of vandalism in this facility.</li>
  <li class="mphall">Smoking inside the facility is strictly PROHIBITED.</li>
</ul>
<p style="font-size:20px;">WARNING: Non-observance of the above policies will deprive the group from the use of the facility.</p><br>
    <div class="reservebtn-container">
    <a href="index.php" class="reservebtn">
  Reserve Now
</a>
    
  </div>
  </div>
  
  
  
<!-- End page content -->
</div>
        


<script>
let slideIndex = [1,1,1,1,1];
let slideId = ["mySlides1", "mySlides2", "mySlides3", "mySlides4", "mySlides5"];
let slideTimeout = [4000, 4000, 4000, 4000, 4000]; // set timeout for each slide (in milliseconds)

showSlides(1, 0);
showSlides(1, 1);
showSlides(1, 2);
showSlides(1, 3);
showSlides(1, 4);

// call the automatic slide switcher function
autoSwitchSlides();

// function to switch slides automatically
function autoSwitchSlides() {
  // get the current slide index for each slideshow
  for (let i = 0; i < slideIndex.length; i++) {
    // increment the slide index and call showSlides()
    slideIndex[i]++;
    showSlides(slideIndex[i], i);
  }
  // set a timeout to call this function again
  setTimeout(autoSwitchSlides, slideTimeout[0]);
}

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  let i;
  let x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}

</script>
</main>
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