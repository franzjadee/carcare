<?php
class Car {
    public function addCar($car_id, $dateval, $task, $performedBy, $materials, $labor, $otherCost) {
        include_once('dbconn.php');
        $conn = (new Connection())->conn;
        $stmt = $conn->prepare(
            "INSERT INTO viewcar (car_id, dateval, task, performedBy, materials, labor, otherCost)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("isssiii", $car_id, $dateval, $task, $performedBy, $materials, $labor, $otherCost);
        return $stmt->execute();
    }
}
