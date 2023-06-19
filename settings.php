<?php 
session_start();

include 'connection/conn.php';

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

if(isset($_POST['updateBtn'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact_no = $_POST['contactnum'];
  $address = $_POST['address'];
  $old_pass = $_POST['old_pass'];
  $change_pass = $_POST['change_pass'];
  $psw_repeat = $_POST['psw-repeat'];
  $userID = $_SESSION['userID'];
  $sql = "SELECT password FROM users WHERE userID = '$userID'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $password = $row['password'];
  if($old_pass == $password){
    if($change_pass == $psw_repeat){
      $sql1 = "UPDATE users SET name = '$name', email = '$email', contact_no = '$contact_no', address = '$address', password = '$change_pass' WHERE userID = '$userID'";
      $result1 = mysqli_query($conn, $sql1);
      if($result1){
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['contact_no'] = $contact_no;
        $_SESSION['address'] = $address;
        $_SESSION['password'] = $change_pass;
        echo "<script>alert('Update Successful!')</script>";
        echo "<script>window.location.href='settings.php'</script>";
      }else{
        echo "<script>alert('Update Failed!')</script>";
        echo "<script>window.location.href='settings.php'</script>";
      }
    }else{
      echo "<script>alert('Password does not match!')</script>";
      echo "<script>window.location.href='settings.php'</script>";
    }
}
}



?>


<!DOCTYPE html>
<html>
<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="settings.css">
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
	<title>Settings</title>

</head>
<body>

  <div class="header">
    <div class="logo">
        <img src="pcu.png" alt="Logo">
        <p>PCU-IRS</p>
      </div>
    <div class="header-right">
      <a href="home.php">Home</a>
      <?php 
      if (isset($_SESSION['email']) &&($_SESSION['password'])&&($_SESSION['access']=="department")) 
      {
      ?>
    <a href="req_product.php">Request Product</a>
    <a href="res_prop.php">Reserve Property</a>
    <a href="dashboard.php" >Dashboard</a>
    <a href="settings.php">Settings</a>
    <a href="logout.php">Logout</a>
    <?php
    }else{?>
    
    <a href="res_prop_cust.php">Reserve Property</a>
    <a href="res_status.php" >Reservation Status</a>
    <a href="settings.php">Settings</a>
    <a href="logout.php">Logout</a>
<?php
    }
    ?>
    </div>
  </div>  
  
<main class="main-content">
  <form method = "POST">
  <div class="container w3-animate-top">
    <h1  style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-align: center; font-size: 30px;">Edit Information</h1>
    <hr>
    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" id="name" value="<?php echo $name?>">

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" id="email" value="<?php echo $email ?>">

    <label for="contactnum"><b>Contact Number</b></label>
    <input type="text" placeholder="Enter Contact Number" name="contactnum" id="contactnum" value="<?php echo $contact_no ?>">

    <label for="address"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="address" id="address" value="<?php echo $address ?>">

    <label for="old_psw"><b>Old Password</b></label>
    <input type="password" placeholder="Enter Old Password" name="old_pass" id="old_pass" required>

    <label for="change_pass"><b>New Password</b></label>
    <input type="password" placeholder="Enter Password" name="change_pass" id="change_pass" required>
    
    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat"   required>
    <hr>
    <button type="submit" name="updateBtn" class="updatebtn"><b>Update</b></button>
  </div>
  </form>
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
