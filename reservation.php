<?php

include 'connection/conn.php';
session_start();

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

if(isset($_POST['approveVenBtn'])){
  $id = $_POST['approve_id'];
  $query = "UPDATE schedule_list SET schedStatus = 'Approved' WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Reservation Approved')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }else{
    echo "<script>window.alert('Reservation Failed')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }
}

if(isset($_POST['declineVenBtn'])){
  $id = $_POST['decline_id'];
  $query = "UPDATE schedule_list SET schedStatus = 'Declined' WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Reservation Declined')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }else{
    echo "<script>window.alert('Reservation Failed')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }
}

if(isset($_POST['approveVehBtn'])){
  $id = $_POST['approveVeh_id'];
  $query = "UPDATE reservationVehicle SET reservationStatus = 'Approved' WHERE reservationVehicleID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Reservation Approved')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }else{
    echo "<script>window.alert('Reservation Failed')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }
}

if(isset($_POST['declineVehBtn'])){
  $id = $_POST['declineVeh_id'];
  $query = "UPDATE reservationVehicle SET reservationStatus = 'Approved' WHERE reservationVehicleID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Reservation Declined')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }else{
    echo "<script>window.alert('Reservation Failed')</script>";
    echo "<script>window.location.href='reservation.php'</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Property Reservations</title>
<link rel="stylesheet" href="reservation.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">

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
    
    <div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Property Reservations <b>Venue</b></h2></div>
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
        <th>Actions</th>
        </tr>
      </thead>

      <tbody>

      <?php
      $sql = "SELECT * FROM schedule_list WHERE schedStatus = 'Pending' ORDER BY start_datetime DESC";
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
          echo "<td><a href='#approveModal' data-id='".$row['id']."' data-toggle='modal' class='approve-btn'>Approve</a>
          <a href='#declineModal' data-toggle='modal' data-id='".$row['id']."' class='decline-btn'>Decline</a></td>";
          echo "</tr>";
  
        }
      }
      
      
      ?>

        
        </tr>
            
  </tbody>
</table>

    </div>
  </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center;"><b>Are you sure you want to approve this reservation?</b></h5>
      </div>
      
      <div class="modal-footer">
      <form method="POST">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="approveVenBtn" class="btn btn-success">Approve</button>
        <input type="hidden" name="approve_id" id="approve_id">
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Decline Modal -->
<div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center;"><b>Are you sure you want to decline this reservation?</b></h5>
      </div>
      <div class="modal-footer">
      <form method="POST">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="declineVenBtn" class="btn btn-danger">Decline</button>
        <input type="hidden" name="decline_id" id="decline_id">
      </form>
      </div>
    </div>
  </div>
</div>

<div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Property Reservations <b>Vehicle</b></h2></div>
    <div class="col-sm-4">

    <div class="search-containers">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpost" id="searchpost" onkeyup="myFunction()" placeholder="Search for reservation..." style="padding-left: 25px;">
    </div>
    
    </div>
    </div>
    </div>
<div class="table-responsive">
    <table class="table table-bordered" id="table2">

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
        <th>Actions</th>
        </tr>
      </thead>

      <tbody>
      <?php
        $sql = "SELECT * FROM reservationVehicleViews WHERE reservationStatus = 'Pending' ORDER BY resDate DESC";
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
            echo "<td><a href='#approveModal1' data-resvehicleid='".$row['reservationVehicleID']."' data-toggle='modal' class='approve-btn'>Approve</a>
            <a href='#declineModal1' data-toggle='modal' data-resvehicleid='".$row['reservationVehicleID']."' class='decline-btn'>Decline</a></td>";
            echo "</tr>";

        }
      }


      ?>
  </tbody>
</table>
    </div>

  </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal1" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center;"><b>Are you sure you want to approve this reservation?</b></h5>
      </div>
      <div class="modal-footer">
      <form method="POST">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="approveVehBtn" class="btn btn-success">Approve</button>
        <input type="hidden" name="approveVeh_id" id="approveVeh_id">
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Decline Modal -->
<div class="modal fade" id="declineModal1" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center;"><b>Are you sure you want to decline this reservation?</b></h5>
      </div>
      <div class="modal-footer">
      <form method="POST">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="declineVehBtn" class="btn btn-danger">Decline</button>
        <input type="hidden" name="declineVeh_id" id="declineVeh_id">
      </form>
      </div>
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

$('#approveModal').on('show.bs.modal', function(e){
  var reservationID = $(e.relatedTarget).data('id');
  $(e.currentTarget).find('input[name="approve_id"]').val(reservationID);
});

$('#declineModal').on('show.bs.modal', function(e){
  var reservationID = $(e.relatedTarget).data('id');
  $(e.currentTarget).find('input[name="decline_id"]').val(reservationID);
});

$('#approveModal1').on('show.bs.modal', function(e){
  var reservationVehicleID = $(e.relatedTarget).data('resvehicleid');
  $(e.currentTarget).find('input[name="approveVeh_id"]').val(reservationVehicleID);
});

$('#declineModal1').on('show.bs.modal', function(e){
  var reservationVehicleID = $(e.relatedTarget).data('resvehicleid');
  $(e.currentTarget).find('input[name="declineVeh_id"]').val(reservationVehicleID);
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