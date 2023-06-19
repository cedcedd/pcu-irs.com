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


if(isset($_POST['approveBtn'])){
  $id = $_POST['approve_id'];
  $query = "UPDATE productRequest SET requestStatus = 'Approved by the Head' WHERE requestID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Request Approved!')</script>";
    echo "<script>window.location.href='approvals.php'</script>";
}else{
    echo "<script>window.alert('Request Failed!')</script>";
    echo "<script>window.location.href='approvals.php'</script>";
}
}


// if(isset($_GET['approve'])){
//   $id = $_GET['requestID'];
//   $query = "UPDATE productRequest SET requestStatus = 'Approved' WHERE requestID = '$id'";
//   $result = mysqli_query($conn, $query);
//   if($result){
//     echo "<script>window.alert('Request Approved!')</script>";
//     echo "<script>window.location.href='request.php'</script>";
// }else{
//     echo "<script>window.alert('Request Failed!')</script>";
//     echo "<script>window.location.href='request.php'</script>";
// }
// }

if(isset($_POST['declineBtn'])){
  $id = $_POST['decline_id'];
  $query = "UPDATE productRequest SET requestStatus = 'Declined' WHERE requestID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Request Declined!')</script>";
    echo "<script>window.location.href='request.php'</script>";
}else{
    echo "<script>window.alert('Request Failed!')</script>";
    echo "<script>window.location.href='request.php'</script>";
}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Head Approval</title>
<link rel="stylesheet" href="approvals.css">
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
      <?php 
        if (isset($_SESSION['email']) &&($_SESSION['password'])&&($_SESSION['access']=="head")) {
          ?>
          <a href="home.php">Home</a>
          <a href="dashboard.php">Dashboard</a>
          <a href="req_product.php">Request Product</a>
          <a href="res_prop.php">Reserve Property</a>
          <a href="approvals.php">Approvals</a>
          <a href="logout.php">Logout</a>
          <?php
        }else{ ?>
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
          <?php
        }?>
    </div>
  </div>

</head>

<body>
  <main class="main-content">
    
    <div class="table-wrapper w3-animate-bottom">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Head <b>Approvals</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for request..." style="padding-left: 25px;">
</div>

    
    </div>
    </div>
    </div>
<div class="table-responsive">
    <table class="table table-bordered">

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
        $sql = "SELECT * FROM productRequestViews WHERE requestStatus = 'Pending'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count > 0){
          while($row = mysqli_fetch_array($result)){

            $requestStatus = $row['requestStatus'];
            if ($requestStatus == 'Pending') {
              $statusColor = '#FFC107';
            } elseif ($requestStatus == 'Approved') {
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
            echo "<td> <a href='#approveModal' data-requestid='".$row['requestID']."' data-toggle='modal' class='approve-btn'>Approve</a>
                      <a href='#declineModal' data-requestid='".$row['requestID']."' data-toggle='modal' class='decline-btn'>Decline</a> 
                  </td> ";
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
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center;"><b>Are you sure you want to approve this request?</b></h5>
      </div>
      <div class="modal-footer">
        <form method="POST">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="approveBtn" class="btn btn-success">Approve</button>
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
        <h5 style="text-align:center;"><b>Are you sure you want to decline this request?</b></h5>
      </div>
      <div class="modal-footer">
        <form method="POST">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="declineBtn" class="btn btn-danger">Decline</button>
          <input type="hidden" name="decline_id" id="decline_id">
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  function myFunction() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("searchpre");
  filter = input.value.toUpperCase();
  table = document.querySelector("table.table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
}



</script>
<script>

$('#approveModal').on('show.bs.modal', function(e) {
  var approve_id = $(e.relatedTarget).data('requestid');
  $(e.currentTarget).find('input[name="approve_id"]').val(approve_id);
});
$('#declineModal').on('show.bs.modal', function(e) {
  var decline_id = $(e.relatedTarget).data('requestid');
  $(e.currentTarget).find('input[name="decline_id"]').val(decline_id);
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