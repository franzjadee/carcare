<?php
session_start();
include_once('../classes/dbconn.php');
include_once('../classes/functions.php');
$conn = (new Connection())->conn;
$user = check_login($conn);

if (isset($_POST['requestTask'])) {
    $stmt = $conn->prepare(
        "INSERT INTO viewcar (car_id, task, requested_by, status)
         VALUES (?, ?, ?, 'pending')"
    );
    $stmt->bind_param("iss", $_POST['car_id'], $_POST['task'], $_POST['requested_by']);
    echo $stmt->execute()
        ? "<script>alert('Requested');location.href='view.php?car_id={$_POST['car_id']}';</script>"
        : "<script>alert('Error');history.back();</script>";
}
