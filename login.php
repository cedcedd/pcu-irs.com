<?php
session_start(); 
include('connection/conn.php');

$_SESSION['uname'] = $_POST['uname'];
$_SESSION['password'] = $_POST['password'];


if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: loginpage.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: loginpage.php?error=Password is required");
	    exit();
	}else{
	    
		$sql= "SELECT *
        FROM `users`
		WHERE email='$uname'AND password='$pass' AND userStatus='active'";
		

			
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $uname && $row['password'] === $pass) {
				$_SESSION['userID'] = $row['userID'];
            	$_SESSION['name'] = $row['name'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['contact_no'] = $row['contact_no'];
				$_SESSION['address'] = $row['address'];
                $_SESSION['departmentID'] = $row['departmentID'];
				$_SESSION['access'] = $row['access'];
				if($row['access']=="administrator"){
					header("Location: adminhome.php");
				}else {
					header("Location: home.php");
				}

		        exit();
            }else{
				header("Location: loginpage.php?error=Incorect User name or password");
		        exit();
			}
		
	    }else{
			header("Location: loginpage.php?error=Incorect User name orno password");
	        exit();
		}
	}
	
}else{
	header("Location: logout.php");
	exit();
}
?>
