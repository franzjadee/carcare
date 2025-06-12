<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'car_care';

    $db = mysqli_connect($host, $user, $pass, $dbname);

    if(isset($_GET['car_id'])){
        $car_id = $_GET['car_id'];

        $db->query("DELETE FROM `car_model`WHERE car_id = '$car_id'");
        header('location: homepage.php');

        if($db){
        echo "<script>alert('Data Deleted');</script>";
        }else
        {
        echo "<script>alert('Try Again');</script>";
        }
    }

    
?>