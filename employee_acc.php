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


if(isset($_POST['submit'])){
  //get the for users table
  $userID = "user-". substr(uniqid(rand(), true), 0, 7);
  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $contact_no = $_POST['contact_no'];
  $address = $_POST['address'];
  $departmentID = $_POST['department'];
  $access = $_POST['access'];
  $query = "INSERT INTO users (userID, email, password, name, contact_no, address, departmentID, access, userStatus) 
            VALUES ('$userID', '$email', '$password', '$name', '$contact_no', '$address', '$departmentID', '$access', 'active')";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script> window.alert('Account Created!'); </script>";
    echo "<script> window.location.href='employee_acc.php'; </script>";
  }else{
    echo "<script> window.alert('Error!'); </script>";
    echo "<script> window.location.href='employee_acc.php'; </script>";
  }
}

//Updated to edit the users account
if(isset($_POST['editUserBtn'])){
  $userID = $_POST['editUserId'];
  $name = $_POST['editName'];
  $email = $_POST['editEmail'];
  $departmentID = $_POST['department'];
  $access = $_POST['editAccess']; 
  $pass = $_POST['editPass'];
  $query = "UPDATE users SET name = '$name', email = '$email', departmentID = '$departmentID', access = '$access', password = '$pass' WHERE userID = '$userID'";

  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script> window.alert('Account Updated!'); </script>";
    echo "<script> window.location.href='employee_acc.php'; </script>";
  }else{
    echo "<script> window.alert('Error!'); </script>";
    echo "<script> window.location.href='employee_acc.php'; </script>";
  }
}

if(isset($_POST['deleteBtn'])){
  $id = $_POST['delete_id'];
  $query = "UPDATE users SET userStatus = 'inactive' WHERE userID = '$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    echo "<script> window.alert('Account Deleted!'); </script>";
    echo "<script> window.location.href='employee_acc.php'; </script>";
  }else{
    echo "<script> window.alert('Error!'); </script>";
    echo "<script> window.location.href='employee_acc.php'; </script>";
  }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Accounts</title>
<link rel="stylesheet" href="employee_acc.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div class="col-sm-8"><h2 style="color:#0a61aa;">User <b>Accounts</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for account..." style="padding-left: 25px;">
    </div>
    
      <button type="button"a href="#addnewModal" class="btn btn-info add-new" data-toggle="modal"><i class="fa fa-plus"></i> Add New</button>
    
    </div>
    </div>
    </div>
<div class="table-responsive">
    <table class="table table-bordered">

    <thead>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Contact Number</th>
        <th>Address</th>
        <th>Email</th>
        <th>Department</th>
        <th>Access</th>
        <th>Actions</th>
      </tr>
      </thead>

    <tbody>
      <?php
        $query = "SELECT * FROM userviews WHERE userStatus = 'active'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count > 0 ){
          while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['userID'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['contact_no'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['departmentName'] . "</td>";
            echo "<td>" . $row['access'] . "</td>";
            //Updated data-user_id = value of UserID to get the value for the Jquery.
            echo "<td>
            <center> 
                      <a href='#editModal' data-userid='".$row['userID']."' data-id='".$row['departmentID']."' data-name='".$row['name']."' data-email='".$row['email']."' data-access='".$row['access']."' data-pass='".$row['password']."' class='edit-icon' data-toggle='modal'><i class='fa fa-edit' data-toggle='tooltip' title='Edit'></i></a>
                      <a href='#deleteModal' data-userid='".$row['userID']."' class='delete' data-toggle='modal'><i class='material-icons'>&#xE872;</i></a>
            </center></td>";
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
                <h6 style="text-align:center;"><b>Are you sure you want to delete this account?</b></h6>
            </div>

            <div class="modal-footer">
              <form method="POST">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  type="submit" name="deleteBtn" class="btn btn-danger">Delete</button>
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
        <h3 class="modal-title" id="editModalLabel" style="font-weight:bold;">Edit Account</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <!-- Edit Form -->
        <!-- Updated All the name of eact input to edit then put the input value to get the userID and run the PHP condition on top -->
        <form method="POST" id="editForm">
          <div class="form-group">
            <label for="name">User ID</label>
              <input type="text" name="editUserId" class="form-control" id="userId" readonly>
          </div>
          <div class="form-group">
              <label for="name">Name</label>
                <input type="text" name="editName" class="form-control" id="name" required >
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="editEmail" class="form-control" id="email" required>
          </div>
          <?php
              $sql = "SELECT departmentName, departmentID FROM department ORDER BY departmentName ASC";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);
              if ($resultCheck > 0) {
                  echo '<div class="from-group">
                          <label for="dept">Department</label>
                          <select name="department" class="form-control" id="dept">"';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="'.$row['departmentID'].'">'.$row['departmentName'].'</option>';
                }
                echo '</select>
                      </div>';
              } else {
                echo "0 results";
              }
            ?>
          <div class="form-group" style="margin-top:15px;">
            <label for="access">Access</label>
            <input type="text" name="editAccess" class="form-control" id="access" required>
          </div>
          <div class="form-group">
            <label for="psw">Reset Password</label>
            <input type="password" name="editPass" class="form-control" id="psw" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="editUserBtn" class="btn btn-primary">Save changes</button>
          </div>
          <!-- Add more form fields as needed -->
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
        <h3 class="modal-title" id="addnewModalLabel" style="font-weight:bold;">Add New Account</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <!-- Add New Form -->
        <form method="POST">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="contact_no">Contact Number</label>
            <input type="text" name="contact_no" class="form-control" id="contact_no" placeholder="Enter Contact Number">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
          </div>
                  <?php
                    $sql = "SELECT departmentName, departmentID FROM department ORDER BY departmentName ASC";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        echo '<div class="from-group">
                                <label for="dept">Department</label>
                                <select name="department" class="form-control" id="dept" required>"
                                <option value="" disabled selected>Select Department</option>';
                                
                      while ($row = mysqli_fetch_assoc($result)) {
                         
                         echo '<option value="'.$row['departmentID'].'">'.$row['departmentName'].'</option>';
                      }
                      echo '</select>
                            </div>';
                    } else {
                      echo "0 results";
                    }
                  ?>
          <div class="form-group" style="margin-top:15px;">
            <label for="access">Access</label>
              <input list="accessList" name="access" class="form-control" id="access" placeholder="Choose Access Type">
              <datalist id="accessList">
                <option value="administrator">
                <option value="user">
                <option value="department">
              </datalist>
          </div>
          <div class="form-group">
            <label for="psw">Password</label>
            <input type="password" name="password" class="form-control" id="psw" placeholder="Enter Password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add User</button>
          </div>
          <!-- Add more form fields as needed -->
        </form>
      </div>
    </div>
  </div>
</div>
                  
<!-- Updated function to save changes in the form -->
<!-- <script>
  $('#editModal').on('show.bs.modal', function (e) {
    var id = $(e.relatedTarget).data('user_id');
    $(e.currentTarget).find('input[name="id"]').val(id);
  });
</script> -->
<!-- END -->




<script type="text/javascript">

  // JavaScript function to save changes in the form
  function saveChanges() {

  // Retrieve form data
  var userid = document.getElementById("userid").value;
  var empid= document.getElementById("empid").value;
  var name= document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var dept = document.getElementById("dept").value;
  var access = document.getElementById("access").value;
  var psw = document.getElementById("psw").value;

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


  // $(document).ready(function(){
  //   $('[data-toggle="tooltip"]').tooltip();
  //   var actions = $("table td:last-child").html();
    
  // Delete row on delete button click
//   $(document).on("click", ".delete", function(){
//     $(this).parents("tr").remove();
//     $(".add-new").removeAttr("disabled");
//   });
// });

</script>

<script>
  
  $('#editModal').on('show.bs.modal', function(e){
    //get data-id attribute of clicked element
    var userid = $(e.relatedTarget).data('userid');
    var dept = $(e.relatedTarget).data('id');
    var name = $(e.relatedTarget).data('name');
    var email = $(e.relatedTarget).data('email');
    var access = $(e.relatedTarget).data('access');
    var pass = $(e.relatedTarget).data('pass');

    //populate the textbox
    $(e.currentTarget).find('input[name="editUserId"]').val(userid);
    $(e.currentTarget).find('select[name="department"]').val(dept);
    $(e.currentTarget).find('input[name="editName"]').val(name);
    $(e.currentTarget).find('input[name="editEmail"]').val(email);
    $(e.currentTarget).find('input[name="editAccess"]').val(access);
    $(e.currentTarget).find('input[name="editPass"]').val(pass);
  });

  $('#deleteModal').on('show.bs.modal', function(e){
    var userid = $(e.relatedTarget).data('userid');
    $(e.currentTarget).find('input[name="delete_id"]').val(userid);
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