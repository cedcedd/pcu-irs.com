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



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Products Received</title>
<link rel="stylesheet" href="prod_received.css">
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
    <div class="col-sm-8"><h2 style="color:#0a61aa;">Products <b>Received</b></h2></div>
    <div class="col-sm-4">

    <div class="search-container">
      <i class="fa fa-search"></i>
      <input type="text" class="searchpre" id="searchpre" onkeyup="myFunction()" placeholder="Search for request..." style="padding-left: 25px;">
    </div>
    
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
        </tr>
      </thead>

      <tbody>
      <?php
        $sql = "SELECT * FROM productRequestViews WHERE requestStatus = 'Received'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count > 0){
          while($row = mysqli_fetch_array($result)){

            $requestStatus = $row['requestStatus'];
            if ($requestStatus == 'Pending') {
              $statusColor = '#FFC107';
            } elseif ($requestStatus == 'Received') {
              $statusColor = '#27C46B';
            } elseif ($requestStatus == 'Declined') {
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
            echo "</tr>";   
            
          }

        }
        ?>


        <!-- <tr>
          <td>Purchasing Office</td>
          <td>Ronaldo Collado</td>
          <td>Hardware</td>
          <td>Hard Drive</td>
          <td>20 Units</td>
          <td>03/25/2023</td>
          <td>Pending</td>
        </tr>
    
        <tr>
          <td>Property Office</td>
          <td>Lester Adarlo</td>
          <td>Cabinet</td>
          <td>Filing Cabinet</td>
          <td>2 Units</td>
          <td>08/29/2023</td>
          <td>Pending</td>
        </tr>
        
        <tr>
          <td>Office of Student Affairs</td>
          <td>James Nepomuceno</td>
          <td>Papers</td>
          <td>Short Bond Paper</td>
          <td>100 Reams</td>
          <td>07/12/2023</td>
          <td>Pending</td>
        </tr>

        <tr>
          <td>General Services Office</td>
          <td>John Cueto</td>
          <td>Ink Printer</td>
          <td>Cyan</td>
          <td>10 Pieces</td>
          <td>09/07/2023</td>
          <td>Pending</td>
        </tr>
        
        <tr>
          <td>Internal Audit Office</td>
          <td>Kendrick Lamar</td>
          <td>Folders</td>
          <td>White Plain Short</td>
          <td>30 Reams</td>
          <td>08/20/2023</td>
          <td>Pending</td>
        </tr> -->
            
  </tbody>
</table>
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


  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var actions = $("table td:last-child").html();

  // Append table with add row form on add new button click
  $(".add-new").click(function(){
    $(this).attr("disabled", "disabled");
    var index = $("table tbody tr:last-child").index();
    var row = '<tr>' +
    '<td><input type="text" class="form-control" name="prod_name" id="prod_code"></td>' +
    '<td><input type="text" class="form-control" name="prod_cat" id="prod_cat"></td>' +
    '<td><input type="text" class="form-control" name="prod_code" id="prod_name"></td>' +
    '<td><input type="text" class="form-control" name="prod_code" id="unit"></td>' +
    '<td><input type="text" class="form-control" name="qty" id="qty"></td>' +
    '<td><input type="text" class="form-control" name="onhand" id="stock_dat"></td>' +
    '<td><input type="text" class="form-control" name="onhand" id="exp_dat"></td>' +
    '<td>' + actions + '</td>' +
    '</tr>';
    $("table").append(row);
    $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
    $('[data-toggle="tooltip"]').tooltip();
  });
    
  // Add row on add button click
  $(document).on("click", ".add", function(){
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
    input.each(function(){
      if(!$(this).val()){
      $(this).addClass("error");
      empty = true;
      } else{
      $(this).removeClass("error");
      }
  });

    $(this).parents("tr").find(".error").first().focus();
      if(!empty){
      input.each(function(){
    $(this).parent("td").html($(this).val());
  });
    $(this).parents("tr").find(".add, .edit").toggle();
    $(".add-new").removeAttr("disabled");
    }
  });

  // Edit row on edit button click
  $(document).on("click", ".edit", function(){
    $(this).parents("tr").find("td:not(:last-child)").each(function(){
    $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
  });
    $(this).parents("tr").find(".add, .edit").toggle();
    $(".add-new").attr("disabled", "disabled");
  });

  // Delete row on delete button click
  $(document).on("click", ".delete", function(){
    $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
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