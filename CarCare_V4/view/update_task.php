<?php
session_start();
include_once('../classes/dbconn.php');

$connInstance = new Connection();
$conn = $connInstance->conn;

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $performedBy = $_POST['performedBy'];
    $materials = $_POST['materials'];
    $labor = $_POST['labor'];
    $otherCost = $_POST['otherCost'];
    $status = isset($_POST['markComplete']) ? 'Completed' : 'Approved'; // Default to Approved unless checked

    $sql = "UPDATE viewcar 
            SET performedBy = ?, materials = ?, labor = ?, otherCost = ?, status = ?
            WHERE task_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdddsi", $performedBy, $materials, $labor, $otherCost, $status, $task_id);
    $stmt->execute();
    $stmt->close();

    // Get car_id to return to the same page
    $car_id_result = $conn->query("SELECT car_id FROM viewcar WHERE task_id = $task_id");
    $car_id_row = $car_id_result->fetch_assoc();
    $car_id = $car_id_row['car_id'];

    header("Location: view.php?car_id=$car_id");
    exit();
}
?>
