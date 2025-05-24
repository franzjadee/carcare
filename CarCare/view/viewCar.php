<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Car Care Log</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <script src="../js/bootstrap.bundle.js"></script>
  <style>
    body {
      background-color: rgb(225, 227, 230);
    }
    .car-info {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 5px;
    }
    .car-details p {
      margin: 0;
      padding: 3px 0;
    }
    .logo-container {
      text-align: right;
    }
    .car-details-box {
      background-color: white;
      padding-right: 30px;
      border-radius: 10px;

    }
  </style>
</head>
<body>
    <nav class="navbar navbar-light px-3 mb-3" style="background-color: rgb(59, 59, 58);">
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

<div class="car-info">
  <div class="car-details-box p-4">
    <div class="row mb-1">
      <div class="col-3"><strong>Brand:</strong></div>
      <div class="col-9">Mazda</div>
    </div>
    <div class="row mb-1">
      <div class="col-3"><strong>Year/Model:</strong></div>
      <div class="col-9">2019 / Mazda 3</div>
    </div>
    <div class="row mb-1">
      <div class="col-3"><strong>License Plate:</strong></div>
      <div class="col-9">NOE 502</div>
    </div>
    <div class="row mb-1">
      <div class="col-3"><strong>Date:</strong></div>
      <div class="col-9">MM/DD/YYYY</div>
    </div>
    <div class="row">
      <div class="col-3"><strong>Interval:</strong></div>
      <div class="col-9">Every 12,000 Miles or Yearly</div>
    </div>

    <button type="button" class="btn btn-dark mt-3" onclick="returnBtn()">Return</button>
  </div>
  

    <div class="logo-container ms-4">
      <img src="../css/images/carcare_logo.png" alt="Car Care Logo" class="img-fluid" style="max-height: 300px;">
    </div>
  </div>

  <table class="table table-bordered text-center bg-white">
    <thead class="table-dark">
      <tr>
        <th>Date Performed</th>
        <th>Tasks</th>
        <th>Performed By</th>
        <th>Material</th>
        <th>Labor</th>
        <th>Cost Other</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>MM/DD/YYYY</td>
        <td>ENGINE SWAP</td>
        <td>JOHN DOE</td>
        <td>100.00</td>
        <td>100.00</td>
        <td>400.00</td>
        <td>600.00</td>
      </tr>
      <tr>
        <td>+</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>+</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>+</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>+</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr class="table-dark">
        <td colspan="3" class="text-end"><strong>Total</strong></td>
        <td><strong>100.00</strong></td>
        <td><strong>100.00</strong></td>
        <td><strong>400.00</strong></td>
        <td><strong>600.00</strong></td>
      </tr>
    </tbody>
  </table>

</body>
</html>
<script>
  function returnBtn(){
    window.location.href = "userpage.php";
  }
</script>
