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
  $categoryID = "cat-" . substr(uniqid(rand(), true),0,6);
  $categoryName = $_POST['categoryName'];
  $query = "INSERT INTO category (categoryID, categoryName, status) VALUES ('$categoryID', '$categoryName', 'active')";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script> window.alert('Category Added Successfully!') </script>";
    header("Location: category.php");
  }
}

if(isset($_POST['editBtn'])){
  $id = $_POST['category_id'];
  $categoryName = $_POST['categoryName'];
  $query = "UPDATE category SET categoryName = '$categoryName' WHERE categoryID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Update Category Successfully!')</script>";
    echo "<script>window.location.href='category.php'</script>";
  }else{
    echo "<script>window.alert('Category Failed')</script>";
    echo "<script>window.location.href='category.php'</script>";
  }
}

if(isset($_POST['deleteBtn'])){
  $id = $_POST['delete_id'];
  $query = "UPDATE category SET status = 'inactive' WHERE categoryID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script>window.alert('Category Deleted Successfully!')</script>";
    echo "<script>window.location.href='category.php'</script>";
  }else{
    echo "<script>window.alert('Category Not Deleted')</script>";
    echo "<script>window.location.href='category.php'</script>";
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Category</title>
<link rel="stylesheet" href="category.css">
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
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Category <b>Details</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for category..." style="padding-left: 25px;">
    </div>
    
    <a type="button"  href="#addnewModal" class="btn btn-info add-new" data-toggle="modal"><i class="fa fa-plus"></i>Add New</a>
    
  </div>
  </div>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered">

      <thead>
        <tr>
          <th>Category ID</th>
          <th>Category Name</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $query = "SELECT * FROM category WHERE status = 'active'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count > 0){
          while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['categoryID'] . "</td>";
            echo "<td>" . $row['categoryName'] . "</td>";
            echo "<td>
                  <center> <a href='#editModal' data-id='".$row['categoryID']."' data-categoryname='".$row['categoryName']."' class='edit-icon' data-toggle='modal'><i class='fa fa-edit'></i></a>
                  <a href='#deleteModal' data-id='".$row['categoryID']."'  class='delete' data-toggle='modal'><i class='material-icons'>&#xE872;</i></a>
                </center>  </td>";
            echo"</tr>";
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
                <h6 style="text-align:center;"><b>Are you sure you want to delete this category?</b></h6>
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
        <h3 class="modal-title" id="editModalLabel" style="font-weight:bold;">Edit Record</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!-- Edit Form -->
        <form method="POST" id="editForm">
          <div class="form-group">
            <label for="prod_code">Category ID</label>
            <input type="text" class="form-control" id="category_id" name="category_id" placeholder="Edit Product Code" readonly>
          </div>
          <div class="form-group">
            <label for="prod_cat">Product Category</label>
            <input type="text" class="form-control" id="prod_cat" name="categoryName" placeholder="Edit Product Category">
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
        <h3 class="modal-title" id="addnewModalLabel" style="font-weight:bold;">Add Category</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <!-- Add New Form -->
        <form method="POST">
        <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" name="categoryName" class="form-control" id="prod_code" placeholder="Enter Category">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add Category</button>
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


//   $(document).ready(function(){
//     $('[data-toggle="tooltip"]').tooltip();
//     var actions = $("table td:last-child").html();


//   // Delete row on delete button click
//   $(document).on("click", ".delete", function(){
//     $(this).parents("tr").remove();
//     $(".add-new").removeAttr("disabled");
//   });
// });

</script>
<script>
$('#editModal').on('show.bs.modal', function(e){
  var id = $(e.relatedTarget).data('id');
  var categoryName = $(e.relatedTarget).data('categoryname');

  $(e.currentTarget).find('input[name="category_id"]').val(id);
   $(e.currentTarget).find('input[name="categoryName"]').val(categoryName);
});

$('#deleteModal').on('show.bs.modal', function(e){
  var id = $(e.relatedTarget).data('id');
  $(e.currentTarget).find('input[name="delete_id"]').val(id);
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