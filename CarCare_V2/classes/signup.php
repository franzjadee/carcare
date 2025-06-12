<?php

require_once('dbconn.php');

class Register extends Connection{
    public function registration($firstname, $lastname, $username, $email, $password, $confirmPassword){
        $duplicate = mysqli_query($this->conn,"SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
        if(mysqli_num_rows($duplicate) > 0){
            return 10;
        }else{
            if($password == $confirmPassword){
                $query = "INSERT INTO `tb_user` VALUES ('','$firstname','$lastname','$username','$email','$password')";
                mysqli_query($this->conn, $query);
                return 1;
            }
            else{
                return 100;
            }
        }
    }


}