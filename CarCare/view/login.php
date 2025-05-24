<?php 

// session_start();

// 	include("../js/connection.php");
// 	include("../js/functions.php");

// 	$check = "";

// 	if($_SERVER['REQUEST_METHOD'] == "POST")
// 	{
// 		//something was posted
// 		$username = $_POST['username'];
// 		$password = $_POST['password'];

// 		if(!empty($username) && !empty($password) && !is_numeric($username))
// 		{

// 			//read from database
// 			$query = "select * from users where username = '$username' limit 1";
// 			$result = mysqli_query($con, $query);

// 			if($result)
// 			{
// 				if($result && mysqli_num_rows($result) > 0)
// 				{

// 					$user_data = mysqli_fetch_assoc($result);
					
// 					if($user_data['password'] === $password)
// 					{

// 						$_SESSION['uid'] = $user_data['uid'];
// 						header("Location: ../index.php");
// 						die;
// 					}
// 				}
// 			}
			
// 			$check = "Incorrect Username or Password";
// 		}else
// 		{
// 			$check = "Incorrect Username or Password";
// 		}
// 	}


	
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 " style="background-color:rgb(225, 227, 230);">

  <div class="d-flex justify-content-center align-items-center flex-grow-1">
		<div class="border rounded-5 p-4" style="width: 300px; background-color:rgb(232, 234, 236);">
			<img src="../css/images/carcare_logo.png" alt="Car Care Logo" class="img-fluid mx-auto d-block mb-3" style="max-height: 400px;">

			<form method="post"> 
				<div class="mb-3">
					<input type="text" name="username" class="form-control" placeholder="Username">
				</div>

				<div class="mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>

				<div class="d-flex mb-2">
					<button type="button" class="btn btn-outline-dark w-50 me-2" onclick="back()">Back</button>
					<button type="button" class="btn btn-outline-dark w-50 me-2" onclick="test()">Log In</button>
					<!-- <input type="submit" value="Log In"class="btn btn-outline-dark w-50 me-2"> -->
				</div>

				<p class="text-danger">
					<?php
					//  echo $check; 
					 ?>
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
					<a href="#" class="text-light me-5" style="font-size: 19px; text-decoration: none;">About Us</a>
					<a href="#" class="text-light" style="font-size: 19px; text-decoration: none;">Contact Us</a>
				</div>
			</div>
		</div>
	</footer>
</html>

<script>

	function back(){
		window.location.href = "welcome.php";
	}

	function test(){
		window.location.href = "userpage.php";
	}


</script>


