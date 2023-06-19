<?php
include 'connection/conn.php';

session_start();
$userID = $_SESSION['userID'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];
$contact_no = $_SESSION['contact_no'];
$address = $_SESSION['address'];
$departmentID = $_SESSION['departmentID'];
$access = $_SESSION['access'];

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
$allday = isset($allday);

//Limiting the reservation 5:00PM-8:00AM will be disabled
$allowedStartTime = strtotime("17:00:00");
$allowedEndTime = strtotime("08:00:00");

if ($start_datetime > $end_datetime || ($start_datetime > $allowedStartTime && $end_datetime < $allowedEndTime)) {
    echo "<script>alert('The Reservation will begin at 8:00AM - 5:00PM.');</script>";
    echo "<script>window.location.href='index.php'</script>";
    $conn->close();
    exit;
}

// Check for reservation conflicts
$conflictQuery = "SELECT * FROM `schedule_list` WHERE
    (`start_datetime` BETWEEN '$start_datetime' AND '$end_datetime' OR
    `end_datetime` BETWEEN '$start_datetime' AND '$end_datetime' OR
    (`start_datetime` <= '$start_datetime' AND `end_datetime` >= '$end_datetime'))
    AND `id` <> '$id' AND `venue` = '$venue'";
$conflictResult = $conn->query($conflictQuery);

if ($conflictResult->num_rows > 0) {
    echo "<script>alert('The venue is reserved for that particular time. Please choose a different time.');</script>";
    echo "<script>window.location.href='index.php'</script>";
    $conn->close();
    exit;
}

if (empty($id)) {
    $sql = "INSERT INTO `schedule_list` (`name`, `userID`,`departmentID`, `email`, `contactnum`, `address`, `venue`, `nog`, `noa`, `start_datetime`,`end_datetime`,`schedStatus`) VALUES ('$name','$userID','$departmentID','$email', '$contactnum', '$address', '$venue', '$nog', '$noa', '$start_datetime','$end_datetime','Pending')";
} else {
    $sql = "UPDATE `schedule_list` set `name` = '{$name}', `email` = '{$email}', `contactnum` = '{$contactnum}', `address` = '{$address}', `venue` = '{$venue}', `nog` = '{$nog}', `noa` = '{$noa}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
}

$save = $conn->query($sql);

if ($save) {
    echo "<script> alert('Reservation Successfully.'); location.replace('./') </script>";
} else {
    echo "<pre>";
    echo "An Error occurred.<br>";
    echo "Error: " . $conn->error . "<br>";
    echo "SQL: " . $sql . "<br>";
    echo "</pre>";
}

$conn->close();
?>
