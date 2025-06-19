<?php
session_start();
include_once('../classes/dbconn.php');
include('../classes/functions.php');

$connInstance = new Connection();
$conn = $connInstance->conn;

$user_data = check_login($conn);

if (!isset($user_data['admin']) || $user_data['admin'] != 1) {
    echo "<script>alert('Access denied.'); window.location.href='homepage.php';</script>";
    exit();
}

if (isset($_GET['deleteid']) && isset($_GET['car_id'])) {
    $task_id = $_GET['deleteid'];
    $car_id = $_GET['car_id'];

    // Check task status first
    $check = $conn->prepare("SELECT status FROM viewcar WHERE task_id = ?");
    $check->bind_param("i", $task_id);
    $check->execute();
    $result = $check->get_result();
    $row = $result->fetch_assoc();
    $check->close();

    if ($row && $row['status'] !== 'Completed') {
        $stmt = $conn->prepare("DELETE FROM viewcar WHERE task_id = ?");
        $stmt->bind_param("i", $task_id);
        if ($stmt->execute()) {
            echo "<script>alert('Task deleted successfully.'); window.location.href='view.php?car_id=$car_id';</script>";
        } else {
            echo "<script>alert('Failed to delete task.'); window.location.href='view.php?car_id=$car_id';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Cannot delete a completed task.'); window.location.href='view.php?car_id=$car_id';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='homepage.php';</script>";
}
?>
