<?php 
session_start();

include ('../classes/logIn.php');

$login = new Login();

if(isset($_POST["submit"])){
    if(isset($_POST["username"], $_POST["password"] )){
        $username = ($_POST["username"]);
        $password = md5($_POST["password"]);

        $result = $login->login($username, $password);

        if($result == 1){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $login->idUser();
            header("Location: homepage.php");
        }
        else if ($result == 10){
            echo 
            "<script> alert('Wrong Password'); </script>";
        }
        else if ($result == 100){
            echo 
            "<script> alert('User Not Registered'); </script>";
        }
    }

}

	
?>

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

			<form method="post"> 
				<div class="mb-3">
					<input type="text" name="username" class="form-control" placeholder="Username">
				</div>

				<div class="mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>

				<div class="d-flex mb-2">
					<button type="button" class="btn btn-outline-dark w-50 me-2" onclick="back()">Back</button>
					<button type="submit" name="submit" class="btn btn-outline-dark w-50 me-2">Log In</button>
					
				</div>

				
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

	


</script>


