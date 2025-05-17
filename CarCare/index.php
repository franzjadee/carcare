<?php 
session_start();

	include("./js/connection.php");
	include("./js/functions.php");

	$user_data = check_login($con);
	
?>

