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


if(isset($_POST['submit'])){

  $requestID = "req-" . substr(uniqid(rand(), true), 0 , 6);
  $categoryID = $_POST['category'];
  $productID = $_POST['product'];
  $quantity = $_POST['qty'];
  $query = "INSERT INTO productRequest (requestID, userID, departmentID, categoryID, productID, requestDate, requestQuantity, requestStatus) 
            VALUES ('$requestID', '$userID', '$departmentID', '$categoryID', '$productID', CURDATE(), '$quantity', 'Pending')";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Request Sent!')</script>";
    echo "<script>window.location.href='request.php'</script>";
  }else{
    echo "<script>window.alert('Request Failed!')</script>";
    echo "<script>window.location.href='request.php'</script>";
  }
}

if(isset($_POST['approveBtn'])){
  $id = $_POST['approve_id'];
  $product_ID = $_POST['approve_productid'];
  $query = "UPDATE productRequest SET requestStatus = 'Approved' WHERE requestID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    
      // Retrieve product and order information
      $product_query = "SELECT * FROM product WHERE productID = '$product_ID'";
      $product_result = mysqli_query($conn, $product_query);
      $product_row = mysqli_fetch_assoc($product_result);
  
      $productQuantity = $product_row['productQuantity'];
      
      $request_query = "SELECT * FROM productRequest WHERE requestID = '$id'";
      $request_result = mysqli_query($conn, $request_query);
      $request_row = mysqli_fetch_assoc($request_result);
      $requestQuantity = $request_row['requestQuantity'];
      
      // Calculate new quantity
      
      if($requestQuantity > $productQuantity){
        $query = "UPDATE productRequest SET requestStatus = 'Approved by the Head' WHERE requestID = '$id'";
        $result = mysqli_query($conn, $query);
        echo "<script>window.alert('Product is not enough')</script>";
        echo "<script>window.location.href='request.php'</script>";
      }else{
        $count =  $productQuantity - $requestQuantity;
        
        $product_update_query = "UPDATE product SET productQuantity = '$count' WHERE productID = '$product_ID'";
        $product_update_result = mysqli_query($conn, $product_update_query);

        echo "<script>window.alert('Request Approved!')</script>";
        echo "<script>window.location.href='request.php'</script>";

      }
     
     
}else{
    echo "<script>window.alert('Request Failed!')</script>";
    echo "<script>window.location.href='request.php'</script>";
}
}
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
<title>Departments Product Requests</title>
<link rel="stylesheet" href="request.css">
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
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Product <b>Requests</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for request..." style="padding-left: 25px;">
</div>
<a type="button"  href="#addnewModal" class="btn btn-info add-new" data-toggle="modal"><i class="fa fa-plus"></i>Add New</a>
    
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
        $sql = "SELECT * FROM productRequestViews WHERE requestStatus = 'Approved by the Head' ORDER BY requestDate DESC";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count > 0){
          while($row = mysqli_fetch_array($result)){

            $requestStatus = $row['requestStatus'];
            if ($requestStatus == 'Pending') {
              $statusColor = '#FFC107';
            } elseif ($requestStatus == 'Approved by the Head') {
              $statusColor = '#27C46B';
            } elseif ($requestStatus == 'Declined by the Head') {
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
                      <td> <a href='#approveModal' data-requestid='".$row['requestID']."' data-productid='".$row['productID']."' data-toggle='modal' class='approve-btn'>Approve</a>
                      <a href='#declineModal' data-requestid='".$row['requestID']."' data-productid='".$row['productID']."' data-toggle='modal' class='decline-btn'>Decline</a> 
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
          <input type="hidden" id="requestID" name="approve_id">
          <input type="hidden" id="productID" name="approve_productid">
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
          <input type="hidden" id="requestID" name="decline_id">
          <input type="hidden" id="productID" name="decline_productid">
        </form>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addnewModal" tabindex="-1" role="dialog" aria-labelledby="addnewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="addnewModalLabel" style="font-weight:bold;">Add New Order</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <!-- Add New Form -->
        <form method="POST">
          <div class="form-group">
            <label for="name">Employee Name</label>
            <input type="text" name="user_ID" class="form-control" id="prod_name" value=<?php echo $name ?> readonly >
          </div>
          <?php
          $sql = "SELECT * FROM category";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
                echo '<div class="form-group">
                <label for="category">Product Category</label>
                <select class="form-control" name="category" id="category">
                <option value="" disabled selected>-- Select Category --</option>';
                while($row = mysqli_fetch_assoc($result)){
                    echo "<option value=".$row['categoryID'].">".$row['categoryName']."</option>";
                }
                echo "</select></div>";
                $sql1 = "SELECT * FROM product";
                $result1 = mysqli_query($conn, $sql1);
                if(mysqli_num_rows($result) > 0){
                    echo '<div class="form-group">
                    <label for="product">Product Name</label>
                    <select class="form-control" name="product" id="product">
                    <option value="" disabled selected>-- Select Product --</option>';
                    while($row1 = mysqli_fetch_assoc($result1)){
                        echo "<option value=".$row1['productID'].">".$row1['productName']."</option>";
                    }
                    echo "</select></div>";
                }

          }else {
            echo "0 results";
          }

          ?>
          <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" name="qty" class="form-control" id="qty" placeholder="Enter Quantity">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add Request</button>
          </div>
          <!-- Add more form fields as needed -->
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

$('#approveModal').on('show.bs.modal', function(e){
  var requestID = $(e.relatedTarget).data('requestid');
  var productID = $(e.relatedTarget).data('productid');

  $(e.currentTarget).find('input[name="approve_id"]').val(requestID);
  $(e.currentTarget).find('input[name="approve_productid"]').val(productID)
})

$('#declineModal').on('show.bs.modal', function(e){
  var requestID = $(e.relatedTarget).data('requestid');
  var productID = $(e.relatedTarget).data('productid');
  $(e.currentTarget).find('input[name="decline_id"]').val(requestID);
  $(e.currentTarget).find('input[name="decline_productid"]').val(productID)
})


</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
 
  $('#category').change(function() {
    var categoryId = $(this).val();
    
    $.ajax({
      url: 'get_products.php', 
      method: 'POST',
      data: { categoryID: categoryId },
      success: function(response) {
        $('#product').html(response);
      }
    });
  });
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