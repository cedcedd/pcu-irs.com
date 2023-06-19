<?php

include 'connection/conn.php';
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


$sql = "SELECT * FROM users WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
  $orderID = "order-" . substr(uniqid(rand(), true), 0, 6);
  $company_ID = $_POST['company_ID'];
  $product_ID = $_POST['product_ID'];
  $expect_date = date('Y-m-d', strtotime($_POST['expect_date']));
  $qty = $_POST['qty'];
  $unitPrice = $_POST['un_price'];
  $query = "INSERT INTO purchaseOrder (orderID, companyID, userID ,productID, orderDate, expect_date, orderQuantity, orderUnitCost, orderStatus, status) 
            VALUES ('$orderID', '$company_ID', '$userID', '$product_ID', CURRENT_TIMESTAMP, '$expect_date', '$qty', '$unitPrice', 'Pending', 'active')";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Purchase Order Sent!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }else{
    echo "<script>window.alert('Purchase Order Failed!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }
}

if(isset($_POST['approveBtn'])){
  $id = $_POST['approve_id'];
  $product_id = $_POST['approve_prodid'];
  $query = "UPDATE purchaseOrder SET orderStatus = 'Arrived' WHERE orderID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    // Retrieve product and order information
    $product_query = "SELECT * FROM product WHERE productID = '$product_id'";
    $product_result = mysqli_query($conn, $product_query);
    $product_row = mysqli_fetch_assoc($product_result);

    $productQuantity = $product_row['productQuantity'];
    
    $order_query = "SELECT * FROM purchaseOrder WHERE orderID = '$id'";
    $order_result = mysqli_query($conn, $order_query);
    $order_row = mysqli_fetch_assoc($order_result);
    $orderQuantity = $order_row['orderQuantity'];
    
    // Calculate new quantity
    $count = $orderQuantity + $productQuantity;
   
    // Update product quantity
    $product_update_query = "UPDATE product SET productQuantity = '$count' WHERE productID = '$product_id'";
    $product_update_result = mysqli_query($conn, $product_update_query);

    echo "<script>window.alert('Purchase Order Arrived')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";

  } else {
    echo "<script>window.alert('Purchase Order Failed!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }
}


if(isset($_POST['declineBtn'])){
  $id = $_POST['decline_id'];
  $query = "UPDATE purchaseOrder SET orderStatus = 'Declined' WHERE orderID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Purchase Order Declined!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
}else{
    echo "<script>window.alert('Purchase Order Failed!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }
}

if(isset($_POST['editOrderBtn'])){
  $id = $_POST['editOrderID'];
  $company_ID = $_POST['editCompanyID'];
  $product_ID = $_POST['editProductID'];
  $expect_date = date('Y-m-d', strtotime($_POST['editExpectedDate']));
  $qty = $_POST['editQty'];
  $unitPrice = $_POST['editUn_Price'];
  $query = "UPDATE purchaseOrder SET companyID = '$company_ID', productID = '$product_ID', expect_date = '$expect_date', orderQuantity = '$qty', orderUnitCost = '$unitPrice' WHERE orderID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Purchase Order Updated!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }else{
    echo "<script>window.alert('Purchase Order Failed!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }
}

if(isset($_POST['deleteBtn'])){
  $id = $_POST['delete_id'];
  $query = "UPDATE purchaseOrder SET status = 'inactive' WHERE orderID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Purchase Order Deleted!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }else{
    echo "<script>window.alert('Purchase Order Failed!')</script>";
    echo "<script>window.location.href='purch_order.php'</script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Purchase Order</title>
<link rel="stylesheet" href="purch_order.css">
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
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Purchase <b>Order</b></h2></div>
    <div class="col-sm-4">

  <div class="search-container">
    <i class="fa fa-search"></i>
    <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for order..." style="padding-left: 25px;">
  </div>

  <a type="button"  href="#addnewModal" class="btn btn-info add-new" data-toggle="modal"><i class="fa fa-plus"></i>Add New</a>

  </div>
  </div>
  </div>
<div class="table-responsive">
    <table class="table table-bordered">

      <thead>
        <tr>
          <th>Order ID</th>
          <th>Supplier Name</th>
          <th>Product Name</th>
          <th>Order Quantity</th>
          <th>Unit Cost</th>
          <th>Order Date</th>
          <th>Expected On</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>

    <tbody>
      <?php
      $query = "SELECT * FROM purchaseOrderViews WHERE orderStatus = 'Pending' AND status = 'active' ORDER BY orderID ASC";
      $result = mysqli_query($conn, $query);
      $count = mysqli_num_rows($result);
      if($count > 0){
        while ($row = mysqli_fetch_array($result)){

          $orderStatus = $row['orderStatus'];
          if ($orderStatus == 'Pending') {
            $statusColor = '#FFC107';
          } elseif ($orderStatus == 'Arrived') {
            $statusColor = '#27C46B';
          } elseif ($orderStatus == 'Declined') {
            $statusColor = '#E34724';
          } else {
            $statusColor = 'white'; // Default color for unknown statuses
          }
          
          echo "<tr>";
          echo "<td>" . $row['orderID'] . "</td>";
          echo "<td>" . $row['companyName'] . "</td>";
          echo "<td>" . $row['productName'] . "</td>";
          echo "<td>" . $row['orderQuantity'] . "</td>";
          echo "<td>" . $row['orderUnitCost'] . "</td>";
          echo "<td>" . $row['orderDate'] . "</td>";
          echo "<td>" . $row['expect_date'] . "</td>";
          echo "<td style='color: $statusColor'>" . $orderStatus . "</td>";
          echo "<form method='GET'>
                      <td><center> <a href='#arrivedModal' data-orderid='".$row['orderID']."' data-productid='".$row['productID']."' data-toggle='modal' class='approve-btn'>Arrived</a>
                      <a href='#declineModal' data-orderid='".$row['orderID']."' data-toggle='modal' class='decline-btn'>Declined</a>
                      <hr>
                      <a href='#editModal' data-id='".$row['orderID']."' data-companyid='".$row['companyID']."' data-productid='".$row['productID']."' data-orderqty='".$row['orderQuantity']."' data-ordercost='".$row['orderUnitCost']."'
                                            data-expectdate='".$row['expect_date']."' class='edit-icon' title='Edit' data-toggle='modal'><i class='fa fa-edit'></i></a>
                                            <a href='#deleteModal' data-orderid='".$row['orderID']."'  class='delete' data-toggle='modal'><i class='material-icons'>&#xE872;</i></a>
                      </center></td>
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
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                
                    <span aria-hidden="true"></span>
                
            </div>

            <div class="modal-body">
                <h6 style="text-align:center;"><b>Are you sure you want to delete this order?</b></h6>
            </div>

            <div class="modal-footer">
              <form method="POST">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="deleteBtn" class="btn btn-danger">Delete</button>
                <input type="hidden" id="delete_id" name="delete_id">
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="arrivedModal" tabindex="-1" role="dialog" aria-labelledby="arrivedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align:center;"><b>Are you sure you want to to mark this order as arrived?</b></h5>
      </div>
      <div class="modal-footer">
        <form method="POST">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="approveBtn" class="btn btn-success">Arrived</button>
          <input type="hidden" id="approve_id" name="approve_id">
          <input type="hidden" id="approve_prodid" name="approve_prodid">
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
        <h5 style="text-align:center;"><b>Are you sure you want to mark this order as declined?</b></h5>
      </div>
      <div class="modal-footer">
        <form method="POST">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="declineBtn" class="btn btn-danger">Declined</button>
          <input type="hidden" id="decline_id" name="decline_id">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="editModalLabel" style="font-weight:bold;">Edit Order</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!-- Edit Form -->
        <form method="POST" id="editForm">
        <div class="form-group">
            <label for="qty">Order ID</label>
            <input type="text" class="form-control" name="editOrderID" id="orderID"  readonly>
          </div>
        <?php
        $sql = "SELECT companyName , companyID FROM supplier WHERE status = 'active' ORDER BY companyName ASC";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          echo '<div class="form-group">
          <label for="sup_name">Supplier Name</label>
          <select class="form-control" id="sup_name" name="editCompanyID">
          <option value="" disabled selected>-- Select Supplier --</option>';
          while($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row['companyID'].'">'.$row['companyName'].'</option>';
          }
          echo '</select></div>';
          $sqli = "SELECT productName , productID FROM product WHERE status = 'active' ORDER BY productName ASC";
          $result1 = mysqli_query($conn, $sqli);
          if(mysqli_num_rows($result1) > 0){
            echo '<div class="form-group">
            <label for="prod_name">Product Name</label>
            <select class="form-control" id="prod_name" name="editProductID">
            <option value="" disabled selected>-- Select Product --</option>';
            while($row = mysqli_fetch_assoc($result1)){
              echo '<option value="'.$row['productID'].'">'.$row['productName'].'</option>';
            }
            echo '</select></div>';
          }
        }
        
        ?>
          <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" class="form-control" id="qty" name="editQty" placeholder="Edit Quantity">
          </div>
          <div class="form-group">
            <label for="un_price">Unit Price</label>
            <input type="text" class="form-control" id="un_price" name="editUn_Price" placeholder="Edit Unit Price">
          </div>
          <div class="form-group">
            <label for="expected_date">Expected Date</label>
            <input type="date" class="form-control" id="expected_date" name="editExpectedDate" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="editOrderBtn" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>

     
    </div>
  </div>
</div>

<!-- Add New Modal -->
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
        <?php
        $sql = "SELECT companyName , companyID FROM supplier WHERE status = 'active' ORDER BY companyName ASC";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          echo '<div class="form-group">
          <label for="sup_name">Supplier Name</label>
          <select class="form-control" id="sup_name" name="company_ID">
          <option value="" disabled selected>-- Select Supplier --</option>';
          while($row = mysqli_fetch_assoc($result)){
            echo '<option value="'.$row['companyID'].'">'.$row['companyName'].'</option>';
          }
          echo '</select></div>';
          $sqli = "SELECT productName , productID FROM product WHERE status = 'active' ORDER BY productName ASC";
          $result1 = mysqli_query($conn, $sqli);
          if(mysqli_num_rows($result1) > 0){
            echo '<div class="form-group">
            <label for="prod_name">Product Name</label>
            <select class="form-control" id="prod_name" name="product_ID">
            <option value="" disabled selected>-- Select Product --</option>';
            while($row = mysqli_fetch_assoc($result1)){
              echo '<option value="'.$row['productID'].'">'.$row['productName'].'</option>';
            }
            echo '</select></div>';
          }
        }
        
        ?>
          <div class="form-group">
              <label for="userID">User ID</label>
              <input type="text" name="user_ID" class="form-control" id="prod_name" value=<?php echo $userID ?> readonly>
            </div>
          <div class="form-group">
            <label for="name">Employee Name</label>
            <input type="text" name="user_ID" class="form-control" id="prod_name" value=<?php echo $name ?> readonly>
          </div>
          <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" name="qty" class="form-control" id="qty" placeholder="Enter Quantity">
          </div>
          <div class="form-group">
            <label for="un_price">Unit Price</label>
            <input type="text" name="un_price" class="form-control" id="un_price" placeholder="Enter Unit Price">
          </div>
          <div class="form-group">
            <label for="order_date">Expected Date</label>
            <input type="date" name="expect_date" class="form-control" id="order_date" placeholder="Enter Order Date">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add Order</button>
          </div>
          <!-- Add more form fields as needed -->
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

// JavaScript function to save changes in the form
function saveChanges() {

// Retrieve form data
var sup_name = document.getElementById("sup_name").value;
var prod_name= document.getElementById("prod_name").value;
var qty = document.getElementById("qty ").value;
var un_price = document.getElementById("un_price").value;
var order_id = document.getElementById("order_id").value;
var order_date = document.getElementById("order_date").value;
var expected_date = document.getElementById("expected_date").value;
var status = document.getElementById("status").value;


// Update table with edited data
// Replace the following lines with your actual logic to update the table
// For example:
// var row = document.getElementById(rowId);
// row.cells[0].innerHTML = itemName;
// row.cells[1].innerHTML = itemPrice;

// Close the modal
$('#editModal').modal('hide');
}

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
$('#editModal').on('show.bs.modal', function(e){
  var orderID = $(e.relatedTarget).data('id');
  var companyID = $(e.relatedTarget).data('companyid');
  var productID = $(e.relatedTarget).data('productid');
  var qty = $(e.relatedTarget).data('orderqty');
  var unitPrice = $(e.relatedTarget).data('ordercost');
  var expectedDate = $(e.relatedTarget).data('expectdate');

  $(e.currentTarget).find('input[name="editOrderID"]').val(orderID);
  $(e.currentTarget).find('select[name="editCompanyID"]').val(companyID);
  $(e.currentTarget).find('select[name="editProductID"]').val(productID);
  $(e.currentTarget).find('input[name="editQty"]').val(qty);
  $(e.currentTarget).find('input[name="editUn_Price"]').val(unitPrice);
  $(e.currentTarget).find('input[name="editExpectedDate"]').val(expectedDate);


});

$('#deleteModal').on('show.bs.modal', function(e){
  var orderID = $(e.relatedTarget).data('orderid');
  $(e.currentTarget).find('input[name="delete_id"]').val(orderID);
});

$('#arrivedModal').on('show.bs.modal', function(e){
  var orderID = $(e.relatedTarget).data('orderid');
  var productID = $(e.relatedTarget).data('productid');
  $(e.currentTarget).find('input[name="approve_id"]').val(orderID);
  $(e.currentTarget).find('input[name="approve_prodid"]').val(productID);
});

$('#declineModal').on('show.bs.modal', function(e){
  var orderID = $(e.relatedTarget).data('orderid');
  $(e.currentTarget).find('input[name="decline_id"]').val(orderID);
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