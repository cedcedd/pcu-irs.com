<?php 
session_start();

include 'connection/conn.php';

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
  <link rel="stylesheet" href="index.css" >
    <title>Venue Reservation Form</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">

    <style>
        

        html,
        body {
            
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        .title{
            font-size: 30px;
        }

        .card-header {
            background:#0a61aa;
        }

        .btn.btn-primary, .btn.btn-success {
            background:#0a61aa;
            
        }

        .card-title {
            margin-top:10px;
        }
        
    .fc-toolbar-title {
    color:#0a61aa;
}


.container {
    background-color: #fff;
    margin: 50px auto 10px auto; /* Added a bottom margin of 70px */
    padding: 30px;
}

.modal-title {
    color:#0a61aa;
}

    </style>
    
</head>
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
<body class="bg-light">

<?php
        include 'connection/conn.php';

        $schedules = $conn->query("SELECT * FROM `schedule_list`");
        $sched_res = [];

        foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
            $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
            $sched_res[$row['id']] = $row;
        }
    ?>


    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header   text-light">
                        <h5 class="card-title" style="text-align:center;">Venue Reservation Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="name" id="name" value= "<?php echo $name ?>" readonly>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" class="form-control form-control-sm rounded-0" name="email" id="email" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="contactnum" class="control-label">Contact Number</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="contactnum" id="contactnum" maxlength="11" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="address" class="control-label">Address</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="address" id="address" required></textarea>
                                </div>
                                
                                
                                <?php
    $sql = "SELECT * FROM venue";
    $result = $conn->query($sql);
    $hasDefaultOption = true; // Flag variable

    if ($result->num_rows > 0) {
        echo '<div class="form-group mb-2">
                <label for="venue">Venue</label>
                <select class="form-control form-control-sm rounded-0" name="venue" id="venue">
                    <option value="" disabled selected>- SELECT VENUE -</option>';

        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['venueName'] . '">' . $row['venueName'] . '</option>';
        }

        echo '</select>
            </div>';
    }

    $conn->close();
?>



                                <div class="form-group mb-2">
                                    <label for="nog" class="control-label">Number of Guests</label>
                                    <input type="number" class="form-control form-control-sm rounded-0" name="nog" id="nog" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="noa" class="control-label">Name of Activity</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="noa" id="noa" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Check-in Date/Time</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">Check-out Date/Time</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-success btn-sm rounded-0" type="submit" form="schedule-form">Reserve</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h4 class="modal-title">Reservation Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Venue</dt>
                            <dd id="venue" class=""></dd>
                            <dt class="text-muted">Check-in Date/Time</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Check-out Date/Time</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="script.js"></script>
    <script>
        var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
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