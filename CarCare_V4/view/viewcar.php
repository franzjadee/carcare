<?php
session_start();

include ('../classes/viewCar.php');
include ('../classes/signup.php');
include_once ('../classes/dbconn.php');
include ('../classes/functions.php');

$connInstance = new Connection();
$conn = $connInstance->conn;

$user_data = check_login($conn);
$admin_status = $user_data['admin'];
$car = new Car();

if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
}

if (isset($_POST['editTask']) && $admin_status == 1 && isset($car_id)) {
    $task_id = $_POST['task_id'];
    $performedBy = $_POST['performedBy'];
    $materials = $_POST['materials'];
    $labor = $_POST['labor'];
    $otherCost = $_POST['otherCost'];

    $status = isset($_POST['markComplete']) ? 'Completed' : 'Approved';
    $dateval = ($status === 'Completed') ? date('Y-m-d') : NULL;

    if ($dateval) {
        $sql = "UPDATE viewcar SET performedBy = ?, materials = ?, labor = ?, otherCost = ?, status = ?, dateval = ? WHERE task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdddssi", $performedBy, $materials, $labor, $otherCost, $status, $dateval, $task_id);
    } else {
        $sql = "UPDATE viewcar SET performedBy = ?, materials = ?, labor = ?, otherCost = ?, status = ? WHERE task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdddsi", $performedBy, $materials, $labor, $otherCost, $status, $task_id);
    }

    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Task updated successfully');window.location.href='view.php?car_id=$car_id';</script>";
    exit();
}

if (isset($_POST['addtask']) && isset($car_id)) {
    $task = $_POST['task'];
    $sql = "INSERT INTO viewcar (car_id, task, status) VALUES (?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $car_id, $task);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Task added successfully');window.location.href='view.php?car_id=$car_id';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Maintenance</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <script src="../js/bootstrap.bundle.js"></script>
    <script>
        function openEditModal(task) {
            document.getElementById('edit_task_id').value = task.task_id;
            document.getElementById('edit_performedBy').value = task.performedBy;
            document.getElementById('edit_materials').value = task.materials;
            document.getElementById('edit_labor').value = task.labor;
            document.getElementById('edit_otherCost').value = task.otherCost;
            document.getElementById('markComplete').checked = task.status === 'Completed';
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>
    <style>
        body {
            background: linear-gradient(rgba(150, 150, 150, 0.8), rgba(150, 150, 150, 0.8)), url('../img/tablebg.jpg');
            background-size: cover;
            background-attachment: fixed;
        }

        .title {
            display: flex;
            justify-content: space-between;
        }

        .line {
            border: 1px solid black;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .card {
            background-color: transparent !important;
            border: none;
        }

        .card-body {
            background-color: transparent !important;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-light px-3" style="background-color: rgb(59, 59, 58);">
        <span class="navbar-brand h1 text-light">HOME</span>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Profile
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-item-text"><?= $user_data['username'] ?></span></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="../classes/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</header>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-7">
                <img src="../img/tablebg.jpg" class="img-thumbnail mt-2" width="200" height="100" alt="">
                <?php if ($admin_status == 1){?>  
                    <button class="btn btn-light btn-outline-dark mt-2" onclick="window.location.href='adminpage.php'">Return</button>
                <?php }else{
                    echo "<button class='btn btn-light btn-outline-dark mt-2' onclick=window.location.href='homepage.php'>Return</button>";
                }?>

                <div class="title fw mt-5 rounded p-2">
                    <?php
                    $sql = "SELECT * FROM car_model WHERE car_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $car_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<p>{$row['brand']}</p><p>{$row['year_model']}</p><p>{$row['plate_number']}</p><p>{$row['mileage']}</p>";
                    }
                    $stmt->close();
                    ?>
                </div>

                <div class="line my-2"></div>

                <div class="title p-2">
                    <p><b>Brand</b></p>
                    <p><b>Year/Model</b></p>
                    <p><b>Plate Number</b></p>
                    <p><b>Mileage</b></p>
                </div>
            </div>

            <div class="col-5">
                <img src="../css/images/carcare_logo.png" alt="Car Care Logo" class="mx-auto d-block" width="250" height="250">
            </div>
        </div>

        <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Date Performed</th>
                        <th>Tasks</th>
                        <th>Performed By</th>
                        <th>Material</th>
                        <th>Labor</th>
                        <th>Other</th>
                        <th>Total</th>
                        <th>Status</th>
                        <?php if ($admin_status == 1): ?><th>Action</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                $totalMaterials = $totalLabor = $totalOther = $grandTotal = 0;
                $sql = "SELECT * FROM viewcar WHERE car_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $car_id);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $rowTotal = $row['materials'] + $row['labor'] + $row['otherCost'];
                    $totalMaterials += $row['materials'];
                    $totalLabor += $row['labor'];
                    $totalOther += $row['otherCost'];
                    $grandTotal += $rowTotal;

                    echo "<tr>
                        <td>{$row['dateval']}</td>
                        <td>{$row['task']}</td>
                        <td>{$row['performedBy']}</td>
                        <td>{$row['materials']}</td>
                        <td>{$row['labor']}</td>
                        <td>{$row['otherCost']}</td>
                        <td>$rowTotal</td>
                        <td>{$row['status']}</td>";

                    if ($admin_status == 1) {
                        echo "<td>";
                        if ($row['status'] == 'Pending') {
                            echo "<a href='approve_task.php?task_id={$row['task_id']}' class='btn btn-success btn-sm'>Approve</a> ";
                            echo "<button class='btn btn-warning btn-sm' onclick='openEditModal(" . json_encode($row) . ")'>Edit</button>";
                        } elseif ($row['status'] == 'Approved') {
                            echo "<button class='btn btn-warning btn-sm' onclick='openEditModal(" . json_encode($row) . ")'>Edit</button> ";
                            echo "<a href='delete_task.php?deleteid={$row['task_id']}' class='btn btn-danger btn-sm'>Delete</a>";
                        } elseif ($row['status'] == 'Completed') {
                            echo "<span class='badge bg-primary'>Completed</span>";
                        }
                        echo "</td>";
                    }

                    echo "</tr>";
                }
                ?>
                </tbody>
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?= $totalMaterials ?></td>
                        <td><?= $totalLabor ?></td>
                        <td><?= $totalOther ?></td>
                        <td><?= $grandTotal ?></td>
                        <td colspan="<?= $admin_status ? 2 : 1 ?>"></td>
                    </tr>
                </tfoot>
            </table>
                <?php if (!$admin_status): ?>
                    <div class="text-end mt-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add Task</button>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</main>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="">
        <input type="hidden" name="editTask" value="1">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Maintenance Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="task_id" id="edit_task_id">
          <div class="mb-3">
            <label>Performed By</label>
            <input type="text" class="form-control" name="performedBy" id="edit_performedBy" required>
          </div>
          <div class="mb-3">
            <label>Materials</label>
            <input type="number" class="form-control" name="materials" id="edit_materials" required>
          </div>
          <div class="mb-3">
            <label>Labor</label>
            <input type="number" class="form-control" name="labor" id="edit_labor" required>
          </div>
          <div class="mb-3">
            <label>Other Cost</label>
            <input type="number" class="form-control" name="otherCost" id="edit_otherCost" required>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="markComplete" id="markComplete">
            <label class="form-check-label" for="markComplete">Mark as Completed</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="">
      <input type="hidden" name="addtask" value="1">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTaskModalLabel">Request Maintenance Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="task">Task</label>
            <input type="text" class="form-control" name="task" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Task</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>
