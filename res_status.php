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
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="res_status.css">
<link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
<title>Reservation Status</title>

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
<main class="main-content">
  
    <div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Venue Reservations <b>Status</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for reservation..." style="padding-left: 25px;">
    </div>
    
    </div>
    </div>
    </div>
<div class="table-responsive">
    <table class="table table-bordered" id="table1">

      <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Contact No.</th>
        <th>Address</th>
        <th>Venue</th>
        <th>Number of Guests</th>
        <th>Name of Activity</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Status</th>
        </tr>
      </thead>

      <tbody>
      <?php
      $sql = "SELECT * FROM schedule_list WHERE schedStatus = 'Pending' AND userID = '$userID' ORDER BY start_datetime DESC";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      if($count > 0 ){
        while($row = mysqli_fetch_array($result)){
  
          $schedule_list = $row['schedStatus'];
        if ($schedule_list == 'Pending') {
          $statusColor = '#FFC107';
        } elseif ($schedule_list == 'Approved') {
          $statusColor = '#27C46B';
        } elseif ($schedule_list == 'Declined') {
          $statusColor = '#E34724';
        } else {
          $statusColor = 'white'; // Default color for unknown statuses
        }
          echo "<tr>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td style='word-wrap: break-word;'>" .$row['email']. "</td>";
          echo "<td>" .$row['contactnum']. "</td>";
          echo "<td>" .$row['address']. "</td>";
          echo "<td>" .$row['venue']. "</td>";
          echo "<td>" .$row['nog']. "</td>";
          echo "<td>" .$row['noa']. "</td>";
          echo "<td style='word-wrap: break-word;'>" . date("Y-m-d h:i A", strtotime($row['start_datetime'])) . "</td>";
          echo "<td style='word-wrap: break-word;'>" . date("Y-m-d h:i A", strtotime($row['end_datetime'])) . "</td>"; 
          echo "<td style='color: $statusColor'>" . $schedule_list . "</td>";
        }
      }
      
      
      
      ?>

                
  </tbody>
</table>
    </div>
  </div>
</div>


<script type="text/javascript">

function myFunction() {
  var input1, input2, filter1, filter2, table1, table2, tr1, tr2, td1, td2, i, j, txtValue1, txtValue2;
  input1 = document.getElementById("searchpre");
  filter1 = input1.value.toUpperCase();
  table1 = document.getElementById("table1"); // replace "table1" with the ID of your first table
  tr1 = table1.getElementsByTagName("tr");
  for (i = 0; i < tr1.length; i++) {
    td1 = tr1[i].getElementsByTagName("td");
    for (j = 0; j < td1.length; j++) {
      txtValue1 = td1[j].textContent || td1[j].innerText;
      if (txtValue1.toUpperCase().indexOf(filter1) > -1) {
        tr1[i].style.display = "";
        break;
      } else {
        tr1[i].style.display = "none";
      }
    }
  }

  input2 = document.getElementById("searchpost");
  filter2 = input2.value.toUpperCase();
  table2 = document.getElementById("table2"); // replace "table2" with the ID of your second table
  tr2 = table2.getElementsByTagName("tr");
  for (i = 0; i < tr2.length; i++) {
    td2 = tr2[i].getElementsByTagName("td");
    for (j = 0; j < td2.length; j++) {
      txtValue2 = td2[j].textContent || td2[j].innerText;
      if (txtValue2.toUpperCase().indexOf(filter2) > -1) {
        tr2[i].style.display = "";
        break;
      } else {
        tr2[i].style.display = "none";
      }
    }
  }
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
