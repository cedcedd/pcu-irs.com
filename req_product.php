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
    echo "<script>window.location.href='dashboard.php'</script>";
  }else{
    echo "<script>window.alert('Request Failed!')</script>";
    echo "<script>window.location.href='req_product.php'</script>";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="req_product.css">
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
	<title>Request Product</title>

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
<form method="POST">
  <div class="container w3-animate-top">
    <h1>Request Product</h1>
    <hr>
    <label for="name"><b>Name</b></label>
    <input type="text" id="name" value="<?php echo $name ?>" readonly>
    <?php
    $sql = "SELECT * FROM category WHERE status = 'active'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo '<label for="category"><b>Product Category</b></label>
            <select class="form-control" name="category" id="category">
            <option value="" disabled selected>-- Select Category --</option>';
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row['categoryID'].">".$row['categoryName']."</option>";
      }
      echo "</select>";
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
    <label for="qty"><b>Quantity</b></label>
    <input type="number" name="qty" class="form-control" id="qty" placeholder="Add Quantity">
    <hr>
    <button type="submit" name="submit" class="requestbtn"><b>Request</b></button>
  </div>
</form>

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


   <!-- <script>

let category = ["Furniture", "Hardware"];
let furniture = ["Filing Cabinet (4 Drawers)", "Sliding Door Cabinet"];
let hardware = ["Hard Drive: 256Gb M.2 2280 Solid State Drive", "Hard Drive: 1 TB 5400RPM 2.5"];


let slct1 = document.getElementById("slct1");
let slct2 = document.getElementById("slct2");

category.forEach(function addCategory(item) {
  let option = document.createElement("option");
  option.text = item;
  option.value = item;
  slct1.appendChild(option);
});

slct1.onchange = function () {
  slct2.innerHTML = "<option></option>";
  if (this.value == "Furniture") {
    addtoSlct2 (furniture);
  }
  if (this.value == "Hardware") {
    addtoSlct2 (hardware);
  }

}
function addtoSlct2(arr) {

  arr.forEach(function (item) {

    let option = document.createElement("option");
    option.text = item;
    option.value = item;
    slct2.appendChild(option);
  });
}


   </script> -->
    

   
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
