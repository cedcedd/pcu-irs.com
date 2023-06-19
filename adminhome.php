<?php
include "connection/conn.php";
session_start();
if(!isset($_SESSION['userID'])){
    header('location:loginpage.php');
    exit();
}

//get the session variables
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
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminhome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">

	<title>PCU-IRS</title>

  <div class="header">
    <div class="logo">
      <img src="pcu.png" alt="Logo">
      <p>PCU-IRS</p>
</div>

    <div class="header-right">
          <a href="adminhome.php">Home</a>
          <a href="category.php">Category</a>
          <a href="product.php">Products</a>
          <a href="supplier.php">Suppliers</a>
          <a href="purch_order.php">Purchase Order</a>
          <a href="request.php">Product Requests</a>
          <a href="prod_received.php">Product Received</a>
          <a href="reservation.php">Reservations</a>
          <a href="employee_acc.php">User Accounts</a>
          <a href="logout.php">Logout</a>
    </div>
  </div>

</head>

<body>
	<main class="main-content">
    <br>
    <br>

    <div class="w3-row-padding w3-margin-bottom w3-animate-bottom">

      <div class="w3-quarter" style="margin-bottom: 30px;">
        <div class="w3-container w3-text-white w3-padding-16" style="background:#fd7f6f;">

          <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
           <div class="w3-right">
            <?php 
            $sql = "SELECT * FROM users WHERE access = 'customer'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<h3>$row</h3>";
            ?>
            </div>

           <div class="w3-clear"></div>
            <h4>Customers</h4>
          </div>
      </div>
    
    <div class="w3-quarter" style="margin-bottom: 30px;">
      <div class="w3-container w3-text-white w3-padding-16" style="background:#7eb0d5;">

        <div class="w3-left"><i class="fa fa-id-badge w3-xxxlarge"></i></div>
          <div class="w3-right">
            <?php 
            $sql = "SELECT * FROM users WHERE access = 'department'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<h3>$row</h3>";
            ?>
            <!-- <h3>99</h3> -->
          </div>

        <div class="w3-clear"></div>
            <h4>Employees</h4>
      </div>
    </div>

    <div class="w3-quarter" style="margin-bottom: 30px;">
      <div class="w3-container w3-text-white w3-padding-16" style="background:#b2e061;">

        <div class="w3-left"><i class="fa fa-building w3-xxxlarge"></i></div>
          <div class="w3-right">
            <?php
            $sql = "SELECT * FROM department";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<h3>$row</h3>";
            ?>
            <!-- <h3>23</h3> -->
          </div>

        <div class="w3-clear"></div>
            <h4>Departments</h4>
      </div>
    </div>

    <div class="w3-quarter" style="margin-bottom: 30px;">
      <div class="w3-container  w3-text-white w3-padding-16" style="background:#bd7ebe;">

        <div class="w3-left"><i class="fa fa-shopping-cart w3-xxxlarge"></i></div>
          <div class="w3-right">
            <?php
            $sql = "SELECT * FROM product";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<h3>$row</h3>";
            ?>
            <!-- <h3>50</h3> -->
          </div>

        <div class="w3-clear"></div>
            <h4>Products</h4>
      </div>
    </div>

    <div class="w3-quarter" style="margin-bottom: 30px;">
      <div class="w3-container  w3-text-white w3-padding-16" style="background:#beb9db;">

        <div class="w3-left"><i class="fa fa-truck w3-xxxlarge"></i></div>
          <div class="w3-right">
            <?php
            $sql = "SELECT * FROM supplier";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<h3>$row</h3>";
            
            ?>
            <!-- <h3>50</h3> -->
          </div>

        <div class="w3-clear"></div>
            <h4>Suppliers</h4>
      </div>
    </div>

    <div class="w3-quarter" style="margin-bottom: 30px;">
      <div class="w3-container w3-text-white w3-padding-16" style="background:#ffb55a;">

        <div class="w3-left"><i class="fa fa-clipboard w3-xxxlarge"></i></div>
         <div class="w3-right">
          <?php
          $sql = "SELECT * FROM productRequest WHERE requestStatus = 'Pending' OR requestStatus = 'Approved by the Head'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_num_rows($result);
          echo "<h3>$row</h3>";

          ?>
            <!-- <h3>50</h3> -->
         </div>

        <div class="w3-clear"></div>
            <h4>Product Requests</h4>
      </div>
    </div>

    <div class="w3-quarter" style="margin-bottom: 30px;">
      <div class="w3-container  w3-text-white w3-padding-16" style="background:#c381a3;">

        <div class="w3-left"><i class="fa fa-map-marker w3-xxxlarge"></i></div>
          <div class="w3-right">
            <?php
            $sql = "SELECT * FROM reservationVehicle WHERE reservationStatus = 'Pending'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<h3>$row</h3>";

            ?>
            <!-- <h3>50</h3> -->
          </div>

        <div class="w3-clear"></div>
            <h4>Vehicle Reservations</h4>
      </div>
    </div>

    <div class="w3-quarter" style="margin-bottom: 30px;">
      <div class="w3-container  w3-text-white w3-padding-16" style="background:#8bd3c7;">

        <div class="w3-left"><i class="fa fa-calendar w3-xxxlarge"></i></div>
          <div class="w3-right">
            <?php
            $sql = "SELECT * FROM schedule_list WHERE schedStatus = 'Pending'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<h3>$row</h3>";
            ?>
            <!-- <h3>50</h3> -->
          </div>

        <div class="w3-clear"></div>
            <h4>Venue Reservations</h4>
      </div>
    </div>
  </div>

  <div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Product <b>Requests</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for request..." style="padding-left: 25px; ">
    </div>
    
    </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered" id="table1">

    <thead>
      <tr>
        <th> Request ID </th>
        <th>Department</th>
        <th>Employee's Name</th>
        <th>Product Category</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $sql = "SELECT * FROM productRequestViews ORDER BY requestDate DESC";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      if($count > 0 ){
        while($row = mysqli_fetch_array($result)){
          $requestStatus = $row['requestStatus'];
      if ($requestStatus == 'Pending') {
        $statusColor = '#FFC107';
      } elseif ($requestStatus == 'Approved') {
        $statusColor = '#27C46B';
      } elseif ($requestStatus == 'Approved by the Head') {
        $statusColor = '#27C46B';
      } elseif ($requestStatus == 'Received') {
        $statusColor = '#27C46B';
      } elseif ($requestStatus == 'Declined') {
        $statusColor = '#E34724';
      } else {
        $statusColor = 'white'; // Default color for unknown statuses
      }
          echo "<tr>";
          echo "<td>" . $row['requestID'] . "</td>";
          echo "<td>" . $row['departmentName'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['categoryName'] . "</td>";
          echo "<td>" . $row['productName'] . "</td>";
          echo "<td>" . $row['requestQuantity'] . "</td>";
          echo "<td>" . $row['requestDate'] . "</td>";
          echo "<td style='color: $statusColor'>" . $requestStatus . "</td>";
          echo "</tr>";
        }
      }

    ?>


      <!-- <tr>
        <td>Purchasing Office</td>
        <td>Ronaldo Collado</td>
        <td>Hardware</td>
        <td>Hard Drive</td>
        <td>20 Units</td>
        <td>03/25/2023</td>
        <td>Pending</td>
      </tr>

      <tr>
        <td>Property Office</td>
        <td>Lester Adarlo</td>
        <td>Cabinet</td>
        <td>Filing Cabinet</td>
        <td>2 Units</td>
        <td>08/29/2023</td>
        <td>Pending</td>
      </tr>

      <tr>
        <td>Office of Student Affairs</td>
        <td>James Nepomuceno</td>
        <td>Papers</td>
        <td>Short Bond Paper</td>
        <td>100 Reams</td>
        <td>07/12/2023</td>
        <td>Pending</td>
      </tr>

      <tr>
        <td>General Services Office</td>
        <td>John Cueto</td>
        <td>Ink Printer</td>
        <td>Cyan</td>
        <td>10 Pieces</td>
        <td>09/07/2023</td>
        <td>Pending</td>
      </tr>
      
      <tr>
        <td>Internal Audit Office</td>
        <td>Kendrick Lamar</td>
        <td>Folders</td>
        <td>White Plain Short</td>
        <td>30 Reams</td>
        <td>08/20/2023</td>
        <td>Pending</td>
      </tr> -->
    
 </tbody>
</table>
    </div>
  </div>
</div>

    <div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Property Reservations <b>Venue</b></h2></div>
    <div class="col-sm-4">

    <div class="search-containers">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpost" id="searchpost" onkeyup="myFunction()" placeholder="Search for reservation..." style="padding-left: 25px; ">
    </div>
    
    </div>
    </div>
    </div>
<div class="table-responsive">
    <table class="table table-bordered" id="table2">

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
    $sql = "SELECT * FROM schedule_list ORDER BY start_datetime DESC";
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



      <!-- <tr>
        <td>1145</td>
        <td>Ronaldo Collado</td>
        <td>ronaldo
            @gmail.com</td>
        <td>09951564736</td>
        <td>Makati City</td>
        <td>Multi-purpose Hall</td>
        <td>200</td>
        <td>03/25/2023 - 3:00 PM</td>
        <td>03/25/2023 - 5:00 PM</td>
        <td>Business Fair</td>
        <td>Pending</td>
      </tr>

      <tr>
        <td>1246</td>
        <td>Lester Adarlo</td>
        <td>lester
            @gmail.com</td>
        <td>09174569876</td>
        <td>Pasay City</td>
        <td>Ground Floor Auditorium</td>
        <td>100</td>
        <td>05/20/2023 - 1:00 PM</td>
        <td>05/20/2023 - 3:00 PM</td>
        <td>Health Seminar</td>
        <td>Pending</td>
      </tr>
      
      <tr>
        <td>1458</td>
        <td>James Nepomuceno</td>
        <td>james
            @gmail.com</td>
        <td>09127554323</td>
        <td>San Andres</td>
        <td>University Gymnasium</td>
        <td>80</td>
        <td>02/02/2023 - 3:00 PM</td>
        <td>02/02/2023 - 7:00 PM</td>
        <td>Basketball Training</td>
        <td>Pending</td>
      </tr>
      
      <tr>
        <td>1579</td>
        <td>John Cueto</td>
        <td>john
            @gmail.com</td>
        <td>09084452333</td>
        <td>Vito Cruz</td>
        <td>Freedom Park</td>
        <td>120</td>
        <td>07/10/2023 - 12:00 PM</td>
        <td>07/10/2023 - 5:00 PM</td>
        <td>Got Talent</td>
        <td>Pending</td>
      </tr>
      
      <tr>
        <td>1923</td>
        <td>Mac Miller</td>
        <td>macmill
            @gmail.com</td>
        <td>09159674354</td>
        <td>Pedro Gil</td>
        <td>Freedom Park</td>
        <td>20</td>
        <td>04/29/2023 - 12:00 PM</td>
        <td>04/30/2023 - 12:00 PM</td>
        <td>Retreat</td>
        <td>Pending</td>
      </tr>
         -->
  </tbody>
</table>
  </div>
  </div>
</div>

<div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Property Reservations <b>Vehicle</b></h2></div>
    <div class="col-sm-4">

    <div class="search-containers3">
      <i class="fa fa-search"></i>
      <input type="text" class="searchposter" id="searchposter" onkeyup="myFunction()" placeholder="Search for reservation..." style="padding-left: 25px; ">
    </div>
    
    </div>
    </div>
    </div>
<div class="table-responsive">
    <table class="table table-bordered" id="table3">

    <thead>
      <tr>
        <th>ID No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Vehicle</th>
        <th>No. of Passengers</th>
        <th>Request Date</th>
        <th>Pickup Date/Time</th>
        <th>Return Date/Time</th>
        <th>Activity</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>

    <?php
      $sql = "SELECT * FROM reservationVehicleViews";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      if($count > 0){
        while($row = mysqli_fetch_array($result)){
          $reservationStatus = $row['reservationStatus'];
          if ($reservationStatus == 'Pending') {
            $statusColor = '#FFC107';
          } elseif ($reservationStatus == 'Approved') {
            $statusColor = '#27C46B';
          } elseif ($reservationStatus == 'Declined') {
            $statusColor = '#E34724';
          } else {
            $statusColor = 'white'; // Default color for unknown statuses
          }
          echo "<tr>";
          echo "<td>" . $row['reservationVehicleID'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td style='word-wrap: break-word;'>" . $row['email'] . "</td>";
          echo "<td>" . $row['vehicleName'] . "</td>";
          echo "<td>" . $row['numberOfPassenger'] . "</td>";
          echo "<td>" . $row['resDate'] . "</td>";
          echo "<td style='word-wrap: break-word;'>" . date("Y-m-d h:i A", strtotime($row['pickUp'])) . "</td>";
          echo "<td style='word-wrap: break-word;'>" . date("Y-m-d h:i A", strtotime($row['returnDate'])) . "</td>";
          echo "<td>" . $row['nameOfActivity'] . "</td>";
          echo "<td style='color: $statusColor'>" . $reservationStatus . "</td>";


        }
      }


      ?>
      <!-- <tr>
        <td>1145</td>
        <td>Ronaldo Collado</td>
        <td>ronaldo
            @gmail.com</td>
        <td>09951564736</td>
        <td>Makati City</td>
        <td>Isuzu</td>
        <td>10</td>
        <td>03/25/2023 - 3:00 PM</td>
        <td>03/25/2023 - 5:00 PM</td>
        <td>Business Fair</td>
        <td>Pending</td>
      </tr>

      <tr>
        <td>1246</td>
        <td>Lester Adarlo</td>
        <td>lester
            @gmail.com</td>
        <td>09174569876</td>
        <td>Pasay City</td>
        <td>Coaster</td>
        <td>18</td>
        <td>05/20/2023 - 1:00 PM</td>
        <td>05/20/2023 - 3:00 PM</td>
        <td>Health Seminar</td>
        <td>Pending</td>
      </tr>
      
      <tr>
        <td>1458</td>
        <td>James Nepomuceno</td>
        <td>james
            @gmail.com</td>
        <td>09127554323</td>
        <td>San Andres</td>
        <td>Van</td>
        <td>12</td>
        <td>02/02/2023 - 3:00 PM</td>
        <td>02/02/2023 - 7:00 PM</td>
        <td>Basketball Tune-up</td>
        <td>Pending</td>
      </tr>
      
      <tr>
        <td>1579</td>
        <td>John Cueto</td>
        <td>john
            @gmail.com</td>
        <td>09084452333</td>
        <td>Vito Cruz</td>
        <td>Hyundai</td>
        <td>12</td>
        <td>07/10/2023 - 12:00 PM</td>
        <td>07/10/2023 - 5:00 PM</td>
        <td>Event</td>
        <td>Pending</td>
      </tr>
      
      <tr>
        <td>1923</td>
        <td>Mac Miller</td>
        <td>macmill
            @gmail.com</td>
        <td>09159674354</td>
        <td>Pedro Gil</td>
        <td>Isuzu</td>
        <td>14</td>
        <td>04/29/2023 - 12:00 PM</td>
        <td>04/30/2023 - 12:00 PM</td>
        <td>Retreat</td>
        <td>Pending</td>
      </tr> -->
        
  </tbody>
</table>
    </div>
  </div>
</div>

<script type="text/javascript">

function myFunction() {
  var input1, input2, input3, filter1, filter2, filter3, table1, table2, table3, tr1, tr2, tr3, td1, td2, td3, i, j, txtValue1, txtValue2, txtValue3;
  input1 = document.getElementById("searchpre");
  filter1 = input1.value.toUpperCase();
  table1 = document.getElementById("table1");
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
  table2 = document.getElementById("table2");
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

  input3 = document.getElementById("searchposter");
  filter3 = input3.value.toUpperCase();
  table3 = document.getElementById("table3");
  tr3 = table3.getElementsByTagName("tr");
  for (i = 0; i < tr3.length; i++) {
    td3 = tr3[i].getElementsByTagName("td");
    for (j = 0; j < td3.length; j++) {
      txtValue3 = td3[j].textContent || td3[j].innerText;
      if (txtValue3.toUpperCase().indexOf(filter3) > -1) {
        tr3[i].style.display = "";
        break;
      } else {
        tr3[i].style.display = "none";
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


