<?php 

include ('../classes/signup.php');


$register = new Register();

if(isset($_POST["submit"] )){
    if(isset($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"])){
        $firstname = ($_POST["firstname"]);
		$lastname = ($_POST["lastname"]);
        $username = ($_POST["username"]);
        $email = ($_POST["email"]);
        $password = md5 ($_POST["password"]);
        $confirmpassword = md5($_POST["confirmpassword"]);

        $result = $register->registration($firstname, $lastname, $username, $email, $password, $confirmpassword);

        if($result == 1){
            echo
            "<script>alert('Registration Succesfully');</script>";
            echo "<script>window.location = 'login.php'</script>";
            
        }
        else if($result == 10){
            echo
            "<script>alert('Username or Email Has Already Taken');</script>";
        }
        else if($result == 100){
            echo
            "<script>alert('Password Does Not Match');</script>";
        }

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
			<img src="../css/images/carcare_logo.png" alt="Car Care Logo" class="img-fluid mx-auto d-block mb-2" style="max-height: 300px;">
				
			<form method="post"> 

				<div class="mb-2">
					<input type="text" name="firstname" class="form-control" placeholder="First Name">
				</div>

				<div class="mb-2">
					<input type="text" name="lastname" class=" form-control" placeholder="Last Name">
				</div>

				<div class="mb-2">
					<input type="text" name="username" class="form-control" placeholder="Username">
				</div>

				<div class="mb-2">
					<input type="email" name="email" class="form-control" placeholder="Email">
				</div>

				<div class="mb-2">
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>
				
				<div class="mb-2">
					<input type="password" name="confirmpassword" class="form-control" placeholder="Repeat Password">
				</div>

				<div class="d-flex mb-2">
					<button type="button" class="btn btn-outline-dark w-50 me-2" onclick="back()">Back</button>
					<button type="submit" name="submit" value="Sign Up" class="btn btn-outline-dark w-50 me-2">Sign up</button>
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

    
