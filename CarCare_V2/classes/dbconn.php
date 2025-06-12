<?php


class Connection {
	public $host = 'localhost';
	public $user = 'root';
	public $pass = '';
	public $dbname = 'car_care';
	public $conn;


	public function __construct(){
		$this-> conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);

		if($this->conn->connect_error){
			die("Connection Failed: ". $this->conn->connect_error);
		}
	}
	
}

class Select extends Connection {
	public function selectUserById($id){
		$result = mysqli_query($this-> conn, "SELECT * FROM `tb_user` WHERE id = $id");
		return mysqli_fetch_assoc($result);
	}
}

?>