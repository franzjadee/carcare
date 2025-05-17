<?php 
session_start();

	include("../js/connection.php");
	include("../js/functions.php");

	$check = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$rep_password = $_POST['rep_password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{ if ($password == $rep_password){
			$checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
			$checkResult = mysqli_query($con, $checkQuery);

			if($checkResult)
			{
				if($checkResult && mysqli_num_rows($checkResult) > 0)
				{
					$check = "Username / Email Already Taken!";
				}else
					{

					$uid = random_num(20);
					$query = "insert into users (uid,email,username,password) values ('$uid','$email','$username','$password')";

					mysqli_query($con, $query);

					header("Location: login.php");
					die;
					}
				
			}
		}else{
			$check = "Passwords don't Match!";
		}
			
			}else
		{
			$check = "Missing Information!";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 " style="background-color:white;">

  <div class="d-flex justify-content-center align-items-center flex-grow-1">
		<div class="border rounded-5 p-4" style="width: 300px; background-color: #f8f9fa;">
			<img src="../css/images/carcare_logo.png" alt="Car Care Logo" class="img-fluid mx-auto d-block mb-3" style="max-height: 400px;">
				
			<form method="post"> 
				<div class="mb-3">
					<input type="text" name="username" class="form-control" placeholder="Username">
				</div>

				<div class="mb-3">
					<input type="email" name="email" class="form-control" placeholder="Email">
				</div>

				<div class="mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>
				
				<div class="mb-3">
					<input type="password" name="rep_password" class="form-control" placeholder="Repeat Password">
				</div>

				<div class="d-flex mb-2">
					<button type="button" class="btn btn-outline-dark w-50 me-2" onclick="back()">Back</button>
					<input type="submit" value="Sign Up" class="btn btn-outline-dark w-50 me-2">
				</div>

				<p class="text-danger">
					<?php echo $check; ?>
				</p>
			</form>

		</div>
  </div>

</body>

	<footer class="mt-auto" style="background-color:rgb(59, 59, 58);">
		<div class="container-fluid">
			<div class="d-flex justify-content-between align-items-center px-3 py-2">
			
			<a href="#" class="text-light mb-1" style="font-size: 19px; text-decoration: none;">Terms and Conditions</a>

				<div>
					<a href="#" class="text-light me-5" style="font-size: 19px; text-decoration: none;">Contact</a>
					<a href="#" class="text-light" style="font-size: 19px; text-decoration: none;">About</a>
				</div>
			</div>
		</div>
	</footer>
</html>

<script>

	function back(){
		window.location.href = "welcome.php";
	}

</script>

    <!-- <div class="text-center py-5">  

	<form method="post">
	Firstname: <input type="text" name="firstname" class=" mb-3" placeholder="FirstName">
		<br>			
	Lastname: <input type="text" name="lastname" class=" mb-3" placeholder="LastName">
		<br>		
	Email: <input type="email" name="email" class=" mb-3" placeholder="Email">
		<br>	
	Username: <input type="text" name="username" class=" mb-3" placeholder="Username">
		<br>									
	Password: <input type="password" name="password" class=" mb-3" placeholder="Password">
		<br>
	Gender: <select type="radio" name="gender" class=" mb-3">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				<option value="Other">Other</option>
			</select>
		<br>
		<input type="submit" value="Sign Up" class="btn rounded-pill text-white" style="background-color: #2d421b;">

		<input type="button" value="Log In" class="btn rounded-pill text-white" style="background-color: #2d421b;" onclick="login()">
		<br>

		<br>
		<p class="text-danger"><?php

					echo $check;
				
				?></p> 
	</form>
		
	</div> -->
