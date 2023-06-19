<?php


include 'connection/conn.php';

if (isset($_POST['categoryID'])) {
  $categoryId = $_POST['categoryID'];


  $sql = "SELECT * FROM product WHERE categoryID = '$categoryId'";
  $result = mysqli_query($conn, $sql);

 
  $options = '';
  while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="'.$row['productID'].'">'.$row['productName'].'</option>';
  }

 
  echo $options;
}


if(isset($_POST['vehicleID'])){
  $id = $_POST['vehicleID'];

  $sql = "SELECT * FROM vehicle WHERE vehicleID = '$id' ";
  $result = mysqli_query($conn, $sql);

  $options = '';
  while ($row = mysqli_fetch_assoc($result)) {
      $options .= $row['numberOfSeaters'];
  }

  echo $options;
}
?>