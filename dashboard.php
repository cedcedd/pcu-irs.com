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

if(isset($_POST['receivedBtn'])){
  $id = $_POST['received_id']; 
  $query = "UPDATE productRequest SET requestStatus = 'Received' WHERE requestID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Request received!')</script>";
    echo "<script>window.location.href='dashboard.php'</script>";
}else{
    echo "<script>window.alert('Failed to receive request!')</script>";
    echo "<script>window.location.href='dashboard.php'</script>";
}
}

?>

<!DOCTYPE html>
<html>
<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="dashboard.css">
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
	
  <title>Dashboard</title>

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

<div class="table-wrapper w3-animate-bottom">
  <div class="table-title">
  <div class="row">
  <div class="col-sm-8"><h2 style="color:#0a61aa;">Product <b>Requests</b></h2></div>
  <div class="col-sm-4">

  <div class="search-container">
   <i class="fa fa-search"></i>
   <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for request..." style="padding-left: 25px; margin-left: 5px;">
  </div>
    
</div>
</div>
</div>
<div class="table-responsive">
  <table class="table table-bordered" id="table1">

    <thead>
     <tr>
      <th>Department</th>
      <th>Employee's Name</th>
      <th>Product Category</th>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Date</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    <?php
  $sql = "SELECT * FROM productRequestViews WHERE departmentID = '$departmentID' ORDER BY requestDate DESC";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);
  if ($count > 0) {
    while ($row = mysqli_fetch_array($result)) {
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
      echo "<td>" . $row['departmentName'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['categoryName'] . "</td>";
      echo "<td>" . $row['productName'] . "</td>";
      echo "<td>" . $row['requestQuantity'] . "</td>";
      echo "<td>" . $row['requestDate'] . "</td>";
      echo "<td style='color: $statusColor'>" . $requestStatus . "</td>";
      echo "<form method='GET'>
        <td>
          <center>
          <a href='#receivedModal' data-id='".$row['requestID']."' data-toggle='modal' class='approve-btn'>Received</a>

          </center>
        </td>
      </form>";
      echo "</tr>";
    }
  }
?>

     
  </tbody>
  
  </table>
  </div> 

    </div>
    </div>
   <!-- Received Modal -->
<div class="modal fade" id="receivedModal" tabindex="-1" role="dialog" aria-labelledby="receivedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center;"><b>Are you sure you want to mark this request as received?</b></h5>
      </div>
      <div class="modal-footer">
        <form method="POST">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="receivedBtn" class="btn btn-success">Received</button>
          <input type="hidden" name="received_id" id="received_id">
        </form>
      </div>
    </div>
  </div>
</div>
  <div class="table-wrapper w3-animate-bottom">
  <div class="table-title">
  <div class="row">
  <div class="col-sm-8"><h2 class="venue" style="color:#0a61aa;">Property Reservations <b>Venue</b></h2></div>
  <div class="col-sm-4">

  <div class="search-containers">
    <i class="fa fa-search"></i>
    <input type="text" class="searchpost" id="searchpost" onkeyup="myFunction()" placeholder="Search for reservation..." style="padding-left: 25px; margin-left: 5px;">
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
    $sql = "SELECT * FROM schedule_list WHERE schedStatus = 'Pending' AND departmentID = '$departmentID' ORDER BY start_datetime DESC";
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

  <div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 class="venue" style="color:#0a61aa;">Property Reservations <b>Vehicle</b></h2></div>
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
        <th>Department</th>
        <th>Email</th>
        <th>Vehicle</th>
        <th>No. of Passengers</th>
        <th>Date of Request</th>
        <th>Pickup Date/Time</th>
        <th>Return Date/Time</th>
        <th>Activity</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $sql = "SELECT * FROM reservationVehicleViews WHERE departmentID = '$departmentID' ORDER BY resDate DESC";
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
          echo "<td>" . $row['departmentName'] . "</td>";
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

$('#receivedModal').on('show.bs.modal', function(e){
  var rowid = $(e.relatedTarget).data('id');
  $(e.currentTarget).find('input[name="received_id"]').val(rowid);
});

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
