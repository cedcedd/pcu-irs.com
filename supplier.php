<?php

include 'connection/conn.php';

session_start();

if(!isset($_SESSION['userID'])){
  header('location:loginpage.php');
  exit();
}
//get the session variables
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];
$contact_no = $_SESSION['contact_no'];
$address = $_SESSION['address'];
$departmentID = $_SESSION['departmentID'];
$access = $_SESSION['access'];

if(isset($_POST['submit'])){
  //get for the variables
  $companyID = "company-". substr(uniqid(rand(), true), 0, 5);
  $company_name = $_POST['companyName'];
  $telephone_no = $_POST['telephone_no'];
  $cellphone_no = $_POST['cellphone_no'];
  $email = $_POST['email'];
  $contact_person = $_POST['contactPerson'];
  $company_add = $_POST['companyAddress'];
  $query = "INSERT INTO supplier (companyID,companyName,telephone_no,cellphone_no,email,contactPerson,companyAddress,status) 
            VALUES('$companyID','$company_name','$telephone_no','$cellphone_no','$email','$contact_person','$company_add', 'active')";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>window.alert('Supplier Added!')</script>";
    echo "<script>window.location.href='supplier.php'</script>";
  }else{
    echo "<script>window.alert('Error!')</script>";
    echo "<script>window.location.href='supplier.php'</script>";
  }
}

if(isset($_POST['editBtn'])){
  $companyID = $_POST['comp_id'];
  $company_name = $_POST['comp_name'];
  $telephone_no = $_POST['tel_num'];
  $cellphone_no = $_POST['cell_num'];
  $email = $_POST['email'];
  $contact_person = $_POST['con_person'];
  $company_add = $_POST['comp_add'];
  $query = "UPDATE supplier SET companyName = '$company_name',telephone_no = '$telephone_no',cellphone_no = '$cellphone_no',email = '$email',contactPerson = '$contact_person',companyAddress = '$company_add' WHERE companyID = '$companyID'";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>window.alert('Supplier Updated!')</script>";
    echo "<script>window.location.href='supplier.php'</script>";
  }else{
    echo "<script>window.alert('Supplier Failed!')</script>";
    echo "<script>window.location.href='supplier.php'</script>";
  }
}

if(isset($_POST['deleteBtn'])){
  $id = $_POST['delete_id'];
  $query = "UPDATE supplier SET status = 'inactive' WHERE companyID = '$id'";
  $result = mysqli_query($conn,$query);
  if($result){
    echo "<script>window.alert('Supplier Deleted!')</script>";
    echo "<script>window.location.href='supplier.php'</script>";
  }else{
    echo "<script>window.alert('Supplier Failed!')</script>";
    echo "<script>window.location.href='supplier.php'</script>";
  }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Suppliers</title>
<link rel="stylesheet" href="supplier.css">
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
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Suppliers <b>Details</b></h2></div>
    <div class="col-sm-4">
    <div class="search-container">
  <i class="fa fa-search"></i>
  <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for supplier..." style="padding-left: 25px;">
</div>
<a type="button"  href="#addnewModal" class="btn btn-info add-new" data-toggle="modal"><i class="fa fa-plus"></i>Add New</a>
    </div>
    </div>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered">
    <thead>
    <tr>
        <th>Company Name</th>
        <th>Telephone Number</th>
        <th>Cellphone Number</th>
        <th>Email Address</th>
        <th>Contact Person</th>
        <th>Company Address</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM supplier WHERE status = 'active'";
    $result = mysqli_query($conn,$query);
    $count = mysqli_num_rows($result);
    if($count > 0){
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$row['companyName']."</td>";
        echo "<td>".$row['telephone_no']."</td>";
        echo "<td>".$row['cellphone_no']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['contactPerson']."</td>";
        echo "<td>".$row['companyAddress']."</td>";
        echo "<td> 
        <center> <a href='#editModal' data-id='".$row['companyID']."' data-companyname='".$row['companyName']."' data-telephone='".$row['telephone_no']."' data-cellphone='".$row['cellphone_no']."'
                                      data-email='".$row['email']."' data-contactperson='".$row['contactPerson']."' data-companyadd='".$row['companyAddress']."' class='edit-icon' title='Edit' data-toggle='modal'><i class='fa fa-edit'></i></a>
                    <a href='#deleteModal' data-supplierid='".$row['companyID']."'  class='delete' data-toggle='modal'><i class='material-icons'>&#xE872;</i></a>
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
                <h6 style="text-align:center;"><b>Are you sure you want to delete this supplier?</b></h6>
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
        <h3 class="modal-title" id="editModalLabel" style="font-weight:bold;">Edit Supplier</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!-- Edit Form -->
        <form method="POST" id="editForm">
        <div class="form-group">
            <label for="comp_name">Company ID</label>
            <input type="text" class="form-control" id="comp_id" name="comp_id" readonly >
          </div>
          <div class="form-group">
            <label for="comp_name">Company Name</label>
            <input type="text" class="form-control" id="comp_name" name="comp_name" >
          </div>
          <div class="form-group">
            <label for="tel_num">Telephone Number</label>
            <input type="text" class="form-control" id="tel_num" name="tel_num" placeholder="Edit Telephone Number">
          </div>
          <div class="form-group">
            <label for="cell_num">Cellphone Number</label>
            <input type="text" class="form-control" id="cell_num" name="cell_num" placeholder="Edit Cellphone Number">
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Edit Email Address">
          </div>
          <div class="form-group">
            <label for="con_person">Contact Person</label>
            <input type="text" class="form-control" id="con_person" name="con_person" placeholder="Edit Contact Person">
          </div>
          <div class="form-group">
            <label for="comp_add">Company Address</label>
            <input type="text" class="form-control" id="comp_add" name="comp_add" placeholder="Edit Company Address">
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
        <h3 class="modal-title" id="addnewModalLabel" style="font-weight:bold;">Add New Supplier</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <!-- Add New Form -->
        <form method="POST">
        <div class="form-group">
            <label for="comp_name">Company Name</label>
            <input type="text" name="companyName" class="form-control" id="comp_name" placeholder="Enter Company Name">
          </div>
          <div class="form-group">
            <label for="tel_num">Telephone Number</label>
            <input type="text" name="telephone_no" class="form-control" id="tel_num" placeholder="Enter Telephone Number">
          </div>
          <div class="form-group">
            <label for="cell_num">Cellphone Number</label>
            <input type="text" name="cellphone_no" class="form-control" id="cell_num" placeholder="Enter Cellphone Number">
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address">
          </div>
          <div class="form-group">
            <label for="con_person">Contact Person</label>
            <input type="text" name="contactPerson" class="form-control" id="con_person" placeholder="Enter Contact Person">
          </div>
          <div class="form-group">
            <label for="comp_add">Company Address</label>
            <input type="text" name="companyAddress" class="form-control" id="comp_add" placeholder="Enter Company Address">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add Supplier</button>
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
var comp_name = document.getElementById("comp_name").value;
var prod_name= document.getElementById("prod_name").value;
var tel_num= document.getElementById("tel_num").value;
var cell_num = document.getElementById("cell_num").value;
var email = document.getElementById("email").value;
var con_person = document.getElementById("con_person").value;
var comp_add = document.getElementById("comp_add").value;


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
      $('#editModal').on('show.bs.modal', function (e){
        var id = $(e.relatedTarget).data('id');
        var companyName =  $(e.relatedTarget).data('companyname');
        var telephone_no = $(e.relatedTarget).data('telephone');
        var cellphone_no = $(e.relatedTarget).data('cellphone');
        var email = $(e.relatedTarget).data('email');
        var contact_person = $(e.relatedTarget).data('contactperson');
        var companyAdd = $(e.relatedTarget).data('companyadd');

        $(e.currentTarget).find('input[name="comp_id"]').val(id);
        $(e.currentTarget).find('input[name="comp_name"]').val(companyName);
        $(e.currentTarget).find('input[name="tel_num"]').val(telephone_no);
        $(e.currentTarget).find('input[name="cell_num"]').val(cellphone_no);
        $(e.currentTarget).find('input[name="email"]').val(email);
        $(e.currentTarget).find('input[name="con_person"]').val(contact_person);
        $(e.currentTarget).find('input[name="comp_add"]').val(companyAdd);

      })

      $('#deleteModal').on('show.bs.modal', function (e){
        var id = $(e.relatedTarget).data('supplierid');
        $(e.currentTarget).find('input[name="delete_id"]').val(id);
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