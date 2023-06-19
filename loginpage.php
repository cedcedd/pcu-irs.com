<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="adminlogin.css">
  <link rel = "icon" type = "image/png" href = "https://pcu.edu.ph/wp-content/uploads/2022/12/cropped-PCU-logo-1-32x32.png">
	<title>PCU-IRS</title>

</head>

<style> 
   body {
  font-family: Arial, sans-serif;
  background-color: #f1f1f1;
  background-image: url(bg.png);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
}

.container {
  background: RGBA(10, 97, 170, 0.8);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 30%;
  padding: 20px;
  color: white;
}

input[type=email] {
  width: 100%;
  padding: 15px;
  margin: 10px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

.loginbtn {
  background-color: #8e8e8e;
  color: white;
  padding: 14px 10px;
  margin-right: 20px;
  border: none;
  cursor: pointer;
  width: 35%;
  opacity: 0.9;
  font-weight: bold;
}

.loginbtn:hover {
  opacity: 1;
}

.registerbtn {
  background-color: #8e8e8e;
  color: white;
  padding: 14px 10px;
  border: none;
  cursor: pointer;
  width: 35%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}

/* Media queries for responsive design */
@media screen and (max-width: 600px) {
  .loginbtn, .registerbtn {
    width: 100%;
    margin-bottom: 10px; /* Added margin to create space between buttons */
  }
  
  .loginbtn, .registerbtn a {
    display: block;
    text-align: center;
  }

  .loginbtn:hover, .registerbtn:hover {
  opacity: 1;
}

a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}
}

/* Default styles */
h1 {
            font-family: 'Old English Text MT', serif;
            text-align: center;
            font-size: 50px;
            font-weight: lighter;
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 600px) {
            h1 {
                font-size: 40px;
            }
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 360px) {
            h1 {
                font-size: 35px;
            }

            .ppp {
              font-size: 15px;
            }

            .container {
              width:65%;
              
            }

            .fpw {
              font-size: 15px;
            }
        }

</style>
<body>
	<form method="post" action="login.php">
    <div class="container">
      <h1>PCU-IRS</h1>
      <p style="text-align: center;" class="ppp">Please fill in this form to login your account.</p>
      <hr>
  

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="uname" id="uname" required>

    
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" id="password" required>
      
 
      <hr>
      <div style="text-align:center;">
  <div style="display:inline block;">
      <button type="submit" class="loginbtn">Login</button></a>
      <button type="button" class="registerbtn" ><a href="register.php">Register</a></button>
      <div style="text-align:center; margin-top:15px;">
      <a href="reset_pw.php" class="fpw">Forgot your password?</a>
</div>
      

    </div>
  
  </form>
 

    
    
</body>
</html>
