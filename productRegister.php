<?php
include('connection/conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];

    
    $sql="INSERT INTO `products`(`product_id`, `name`, `quantity`) 
    VALUES ('$product_id','$name','$quantity')";

    $conn->query($sql) or  $conn->error;
    mysqli_close($conn);
}
  ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="number" name="product_id" placeholder="Enter Product Id" required></br>
    <input type="text" name="name" placeholder="Enter Product Name" required></br>
    <input type="text" name="quantity" placeholder="Enter Quantity" required></br>
    
    <input type="submit" value="Login" onclick="displayInfo()">
</form>
<script>
		function displayInfo()
		{
			alert("A record has been added.");  // display string message
			window.location = "adminRegister.php";
		}
    </script>