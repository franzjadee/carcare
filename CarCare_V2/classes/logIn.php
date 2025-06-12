<?php

require_once('dbconn.php');

class Login extends Connection{
    public function login($username, $password){
        $result = mysqli_query($this->conn, "SELECT * FROM `tb_user` WHERE username = '$username' OR email = '$username'");
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0){
            if($password == $row["password"]){
                $this->id = $row["id"];
                return 1;
            }
            else{
                return 10;
            }
        }
        else{
            return 100;
        }

    }

    public function idUser(){
        return $this->id;
    }
}