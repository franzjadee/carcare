<?php
session_start();
include('../classes/dbconn.php');

$connInstance = new Connection();
$conn = $connInstance->conn;

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $stmt = $conn->prepare("UPDATE viewcar SET status = 'approved' WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        echo "<script>alert('Task approved successfully'); window.history.back();</script>";
    } else {
        echo "<script>alert('Failed to approve task'); window.history.back();</script>";
    }

    $stmt->close();
}
?>
