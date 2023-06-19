<?php
include 'connection/conn.php';
session_start();

if(!isset($_SESSION['userID'])){
  header('location:loginpage.php');
  exit();
} 

//get session variables
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];
$contact_no = $_SESSION['contact_no'];
$address = $_SESSION['address'];
$departmentID = $_SESSION['departmentID'];
$access = $_SESSION['access'];

if(isset($_POST['submit'])){
  $productID = "prod-" . substr(uniqid(rand(), true), 0, 6);
  $category_ID = $_POST['category'];
  $productName = $_POST['productName'];
  $prodQty = $_POST['prod_qty'];
  $unit = $_POST['unit'];
  $expirationDate = $_POST['expi_date'];
  $price = $_POST['price'];
  $quesry = "INSERT INTO product (productID, categoryID, productName, productQuantity, unit, expirationDate, price, status) 
             VALUES ('$productID', '$category_ID', '$productName', '$prodQty', '$unit', '$expirationDate', '$price', 'active')";
  $result = mysqli_query($conn, $quesry);
  if($result){
    echo "<script>window.alert('Product Added Successfully!')</script>";
    echo "<script>window.location.href='product.php'</script>";
  }else{
    echo "<script>window.alert('Failed to Add Product!')</script>";
    echo "<script>window.location.href='product.php'</script>";
  }
}

if(isset($_POST['editBtn'])){
  $productID = $_POST['prod_id'];
  $category_ID = $_POST['category'];
  $productName = $_POST['prod_name'];
  $prodQty = $_POST['prod_qty'];
  $unit = $_POST['prod_unit'];
  $expirationDate = $_POST['prod_expdate'];
  $price = $_POST['price'];
  $query = "UPDATE product SET categoryID='$category_ID', productName='$productName', productQuantity='$prodQty', unit='$unit', 
            expirationDate='$expirationDate', price='$price' WHERE productID='$productID'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Product Update Successfully!')</script>";
    echo "<script>window.location.href='product.php'</script>";
  }else{
    echo "<script>window.alert('Failed to Update Product!')</script>";
    echo "<script>window.location.href='product.php'</script>";
  }
}
if(isset($_POST['deleteBtn'])){
  $id = $_POST['delete_id'];
  $query = "UPDATE product SET status='inactive' WHERE productID='$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Product Deleted Successfully!')</script>";
    echo "<script>window.location.href='product.php'</script>";
  }else{
    echo "<script>window.alert('Failed to Delete Product!')</script>";
    echo "<script>window.location.href='product.php'</script>";
  }
}

?>

<!DOCTYPE html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="product.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
<title>Products</title>
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
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Products <b>Details</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for product..." style="padding-left: 25px;">
    </div>

   <a type="button"  href="#addnewModal" class="btn btn-info add-new" data-toggle="modal"><i class="fa fa-plus"></i>Add New</a>

    </div>
    </div>
    </div>
    
    <div class="table-responsive">
    <table class="table table-bordered">

      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Category</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Unit</th>
          <th>Expiration Date</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php
          $query = "SELECT * FROM productviews WHERE status= 'active' ORDER BY productQuantity ASC";
          $result = mysqli_query($conn, $query);
          $count = mysqli_num_rows($result);
          if($count > 0){
            while ($row = mysqli_fetch_array($result)){
              echo "<tr class='text-center'>";
              if($row['productQuantity'] < 20){
                echo "<td style='color: red;'>" . $row['productID'] . "</td>";
                echo "<td style='color: red;'>" . $row['categoryName'] . "</td>";
                echo "<td style='color: red;'>" . $row['productName'] . "</td>";
                echo "<td style='color: red;'>" . $row['productQuantity'] . "</td>";
                echo "<td style='color: red;'>" . $row['unit'] . "</td>";
                echo "<td style='color: red;'>" . $row['expirationDate'] . "</td>";
                echo "<td style='color: red;'>" . $row['price'] . "</td>";
              }else{
                echo "<td>" . $row['productID'] . "</td>";
                echo "<td>" . $row['categoryName'] . "</td>";
                echo "<td>" . $row['productName'] . "</td>";
                echo "<td>" . $row['productQuantity'] . "</td>";
                echo "<td>" . $row['unit'] . "</td>";
                echo "<td>" . $row['expirationDate'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
              }
              
              echo "<td>
              <center> <a href='#editModal' data-id='".$row['productID']."' data-categoryid='".$row['categoryID']."' data-productname='".$row['productName']."' data-productqty='".$row['productQuantity']."'
                                            data-unit='".$row['unit']."' data-expiration='".$row['expirationDate']."' data-price='".$row['price']."' class='edit-icon' data-toggle='modal'><i class='fa fa-edit' data-toggle='tooltip' title='Edit'></i></a>
                                            <a href='#deleteModal' data-productid='".$row['productID']."' class='delete' data-toggle='modal'><i class='material-icons'>&#xE872;</i></a>
              </center> </td>";
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
                <h6 style="text-align:center;"><b>Are you sure you want to delete this product?</b></h6>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="editModalLabel" style="font-weight:bold;">Edit Product</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!-- Edit Form -->
        <form method="POST" id="editForm">
        <div class="form-group">
            <label for="prod_id">Product ID</label>
            <input type="text" class="form-control" id="prod_id" name="prod_id" placeholder="Edit Product Name">
          </div>
        <?php
            $sql = "SELECT categoryName, categoryID FROM category ORDER BY categoryName ASC";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
              echo '<div class="form-group">
                    <label for="prod_category">Product Category</label>
                    <select class="form-control" name="category" id="prod_category">';
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].'</option>';
              }
              echo '</select>
                      </div>';
            }
            ?>
          <div class="form-group">
            <label for="prod_name">Product Name</label>
            <input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Edit Product Name">
          </div>
          <div class="form-group">
            <label for="prod_unit">Product Quantity</label>
            <input type="text" name="prod_qty" class="form-control" id="prod_qty" name="prod_qty" placeholder="Edit Product Quantity">
          </div>
          <div class="form-group">
            <label for="prod_unit">Unit</label>
            <input type="text" class="form-control" id="prod_unit" name="prod_unit" placeholder="Edit Unit">
          </div>
          <div class="form-group">
            <label for="prod_expdate">Expiration Date </label>
            <input type="date" class="form-control" id="prod_expdate" name="prod_expdate" placeholder="Edit Expiration Date">
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Edit Price">
          </div>
          
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
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
        <h3 class="modal-title" id="addnewModalLabel" style="font-weight:bold;">Add New Product</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <!-- Add New Form -->
        <form method="POST">
        
          <?php
            $sql = "SELECT categoryName, categoryID FROM category WHERE status= 'active' ORDER BY categoryName ASC";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
              echo '<div class="form-group">
                    <label for="prod_category">Product Category</label>
                    <select class="form-control" name="category" id="prod_category">
                    <option value="" disabled selected>Select Category</option>';
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].'</option>';
              }
              echo '</select>
                      </div>';
            }
            ?>
          <div class="form-group">
            <label for="prod_name">Product Name</label>
            <input type="text" name="productName" class="form-control" id="prod_name" placeholder="Enter Product Name" required>
          </div>
          <div class="form-group">
            <label for="prod_unit">Product Quantity</label>
            <input type="text" name="prod_qty" class="form-control" id="prod_unit" placeholder="Enter Product Quantity" required>
          </div>
          <div class="form-group">
            <label for="prod_unit">Unit</label>
            <input type="text" name="unit" class="form-control" id="prod_unit" placeholder="Enter Unit" required>
          </div>
          <div class="form-group">
            <label for="prod_expdate">Expiration Date</label>
            <input type="date" name="expi_date" class="form-control" id="prod_expdate" placeholder="Enter Expiration Date">
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" id="price" placeholder="Enter Price" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add Product</button>
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
var prod_code = document.getElementById("prod_code").value;
var prod_cat= document.getElementById("prod_cat").value;
var prod_name= document.getElementById("prod_name").value;
var prod_unit = document.getElementById("prod_unit").value;
var prod_expdate = document.getElementById("prod_expdate").value;
var price = document.getElementById("price").value;


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
    var productID =  $(e.relatedTarget).data('id');
    var productCategory =  $(e.relatedTarget).data('categoryid');
    var productName =  $(e.relatedTarget).data('productname');
    var productQty =  $(e.relatedTarget).data('productqty');
    var productUnit =  $(e.relatedTarget).data('unit');
    var productExpdate =  $(e.relatedTarget).data('expiration');
    var productPrice =  $(e.relatedTarget).data('price');

    $(e.currentTarget).find('input[name="prod_id"]').val(productID);
    $(e.currentTarget).find('select[name="category"]').val(productCategory);
    $(e.currentTarget).find('input[name="prod_name"]').val(productName);
    $(e.currentTarget).find('input[name="prod_qty"]').val(productQty);
    $(e.currentTarget).find('input[name="prod_unit"]').val(productUnit);
    $(e.currentTarget).find('input[name="prod_expdate"]').val(productExpdate);
    $(e.currentTarget).find('input[name="price"]').val(productPrice);
   
  })

  $('#deleteModal').on('show.bs.modal', function(e){
    var productID =  $(e.relatedTarget).data('productid');
    $(e.currentTarget).find('input[name="delete_id"]').val(productID);
  })
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