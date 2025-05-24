<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Campus Connect</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <script src="../js/bootstrap.bundle.js"></script>
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
        <li><span class="dropdown-item-text">John Doe</span></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="login.php">Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="container py-3">

    <div class="d-flex justify-content-between align-items-center mb-2" >
      <h5 class="mb-0">HOME</h5>
      <select id="sortSelect" class="form-select form-select-sm w-auto">
        <option value="default">Sort by</option>
        <option value="alphabetical">Alphabetical (A-Z)</option>
        <option value="type">By Car Type</option>
      </select>
    </div>

    <div id="carListContainer">

      <div class="car-card">
        <span>Mazda 3 Hatchback</span>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" onclick="viewCar()">View</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>

      <div class="car-card">
        <span>Mazda MX-6 Miata Coupe</span>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" onclick="viewCar()">View</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>

      <div class="car-card">
        <span>Mitsubishi Galant Sedan</span>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" onclick="viewCar()">View</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>

    </div>

    <div class="add-btn">
      <span style="font-size: 24px;">Add Car</span>
    </div>

  </div>

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
    function viewCar() {
      window.location.href = "viewCar.php";
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
