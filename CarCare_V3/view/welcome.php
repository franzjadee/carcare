
<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Care</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-image: url('../img/loginbg.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: 100% 100%;
		}
	</style>
</head>

<body class="d-flex flex-column min-vh-100 " style="background-color:rgb(225, 227, 230);">

  <div class="d-flex justify-content-center align-items-center flex-grow-1">
		<div class="border rounded-5 p-4" style="width: 300px; background-color:rgb(232, 234, 236);">
			<img src="../css/images/carcare_logo.png" alt="Car Care Logo" class="img-fluid mx-auto d-block mb-3" style="max-height: 400px;">
				
			<button type="button" class="btn btn-outline-dark w-100 mb-2" onclick="login()">Log In</button>
			<button type="button" class="btn btn-outline-dark w-100" onclick="signup()">Sign Up</button>
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

	function login(){
		window.location.href = "login.php";
	}
	function signup(){
		window.location.href = "signup.php";
	}

</script>
