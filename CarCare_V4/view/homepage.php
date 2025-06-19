<?php
session_start();

include("../classes/dbconn.php");
include("../classes/functions.php");

$connInstance = new Connection();
$conn = $connInstance->conn;

$user_data = check_login($conn);

$admin_status = $user_data['admin'];

if($admin_status == 1){
    header("Location: adminpage.php");
}else{
  
}


if (isset($_POST['submit'])) {
    $brand = $_POST['brand'];
    $year_model = $_POST['yearModel'];
    $plate_number = $_POST['plateNumber'];
    $mileage = $_POST['mileage'];
    $user_id = $user_data['id'];

    $stmt = $conn->prepare("INSERT INTO car_model (brand, year_model, plate_number, mileage, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $brand, $year_model, $plate_number, $mileage, $user_id);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Car Care</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <script src="../js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../css/transaction.css">
    <style>
      body {
        background-color: #d9d9d9;
      }
      .car-card {
        background: white;
        margin: 10px 0;
        padding: 15px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        gap: 15px; /* space between text and buttons */
      }
      .car-card span {
        flex-grow: 1;      /* allow span to take leftover space */
        flex-shrink: 1;    /* allow shrinking if needed */
        min-width: 0;      /* for proper flex shrinking */
        overflow-wrap: break-word; /* wrap long text */
      }
      .btn-group {
        display: flex;
        gap: 10px;         /* space between buttons */
        flex-shrink: 0;    /* prevent buttons from shrinking */
      }
      .btn-group button {
        white-space: nowrap; /* no wrapping inside buttons */
      }
      .add-btn {
        width: 100%;
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 8px;
        cursor: pointer;
      } 

    </style>
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: rgb(225, 227, 230);">

  <nav class="navbar navbar-light px-3" style="background-color: rgb(59, 59, 58);">
    <span class="navbar-brand mb-0 h1 text-light">HOME</span>
    <div class="dropdown">

      <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Profile
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><span class="dropdown-item-text"><?php echo $user_data['username']?></span></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="../classes/logout.php">Log out</a></li>
      </ul>
    </div>
  </nav>

  <main>
    <div class="container py-3">
      <div class="row">
        <div class="d-flex justify-content-between align-items-center mb-2" >
        <select id="sortSelect" class="form-select form-select-sm w-auto">
          <option value="default">Sort by</option>
          <option value="alphabetical">Alphabetical (A-Z)</option>
          <option value="type">By Car Type</option>
        </select>
        <button class="open-button" onclick="openForm()">Add Car</button>
        </div>

        <div class="form-popup" id="myForm">
            <form method="POST" class="form-container">
                <h3>Add Car</h3>
          
                <div class="">
                  
                  <label for=""><b>Brand</b></label>
                  <input type="text" class="form-control"name="brand" required>
                </div>

                <div>
                  <label for=""><b>Year/Model</b></label>
                  <input type="date" class="form-control" name="yearModel" required>
                </div>

                <div>
                  <label for=""><b>Plate number</b></label>
                  <input type="comment" class="form-control" name="plateNumber" required>
                </div>

                <div>
                  <label for=""><b>Mileage</b></label>
                  <input type="number" class="form-control" name="mileage" required>
                </div>


                <div class="form-input6">
                    <button type="submit" name="submit" class="btn">Add</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
                </div>
            </form>
        </div>


        <div class="col">
          <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Car Brand</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $stmt = $conn->prepare("SELECT * FROM car_model WHERE user_id = ?");
                      $stmt->bind_param("i", $user_data['id']);
                      $stmt->execute();
                      $result = $stmt->get_result();

                        while($row=mysqli_fetch_array($result)){
                    ?>
                        <tr>
                            <td><strong><?php echo $row['brand']?></strong></td>
                            <td>
                                <a class="btn btn-info" href="view.php?car_id=<?php echo $row['car_id']?>">View</a>
                                <a class="btn btn-danger" href="deletecar.php?car_id=<?php echo $row['car_id']?>" >Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                      $stmt->close();
                    ?>
                </tbody>
                
            </table>
        </div>
         
        </div>
      </div>
    </div>
  </main>

  <footer class="mt-auto" style="background-color: rgb(59, 59, 58);">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center px-3 py-2">
        <a href="#" class="text-light mb-1" style="font-size: 19px; text-decoration: none;">Terms and Conditions</a>
        <div>
          <a href="#" class="text-light me-5" style="font-size: 19px; text-decoration: none;">About Us</a>
          <a href="#" class="text-light" style="font-size: 19px; text-decoration: none;">Contact Us</a>
        </div>
      </div>
    </div>
  </footer>

  <script>

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
    document.getElementById("myForm").style.display = "none";
    }

    const sortSelect = document.getElementById('sortSelect');
    const container = document.getElementById('carListContainer');

    // Store original order of car cards on page load
    const originalOrder = Array.from(container.querySelectorAll('.car-card'));

    sortSelect.addEventListener('change', () => {
      const criteria = sortSelect.value;

      let cardsToSort;

      if (criteria === 'default') {
        // Restore original order
        cardsToSort = originalOrder;
      } else {
        // Sort current cards by criteria
        cardsToSort = Array.from(container.querySelectorAll('.car-card'));

        cardsToSort.sort((a, b) => {
          const textA = a.querySelector('span').textContent.trim();
          const textB = b.querySelector('span').textContent.trim();

          const brandA = textA.split(' ')[0];
          const brandB = textB.split(' ')[0];

          const typeA = textA.split(' ').slice(-1)[0];
          const typeB = textB.split(' ').slice(-1)[0];

          if (criteria === 'alphabetical') {
            return brandA.localeCompare(brandB);
          } else if (criteria === 'type') {
            return typeA.localeCompare(typeB);
          } else {
            return 0;
          }
        });
      }

      // Append cards in new order
      cardsToSort.forEach(card => container.appendChild(card));
    });
  </script>

</body>
</html>
