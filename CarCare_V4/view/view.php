<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'car_care';

    $db = mysqli_connect($host, $user, $pass, $dbname);

    if(isset($_GET['car_id'])){
        $car_id = $_GET['car_id'];

        header("Location: viewcar.php?car_id=" . urlencode($car_id));
        exit(); 

        if($db){
        echo "<script>alert('Data Deleted');</script>";
        }else
        {
        echo "<script>alert('Try Again');</script>";
        }
    }

    
?>