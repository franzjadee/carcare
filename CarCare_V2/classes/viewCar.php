<?php


require_once('dbconn.php');

class Car extends Connection{
    public function addCar($date, $task, $performedBy, $materials, $labor, $otherCost){
        $sql = mysqli_query($this-> conn, "INSERT INTO `viewcar`VALUES ('','$date','$task','$performedBy','$materials','$labor','$otherCost', '')");
        return $sql;
    }

}
