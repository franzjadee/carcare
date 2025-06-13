<?php

function check_login($conn)
{

	if(isset($_SESSION['id']))
	{

		$id = $_SESSION['id'];
		$query = "select * from tb_user where id = '$id' limit 1";

		$result = mysqli_query($conn,$query);

		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}

	}

	header("Location: ../view/login.php");
	die;

}

function logout($conn){

    if(isset($_SESSION['id']))
    {
        unset($_SESSION['id']);
        $_SESSION["login"] = false;

    }

header("Location: ./login.php");
die;
}