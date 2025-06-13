<?php
session_start();

include ('../classes/viewCar.php');
include ('../classes/signup.php');

$car = new Car();

if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];}

if(isset($_POST['addcar'])){
  $dateval = $_POST['date'];
  $task = $_POST['task'];
  $performedBy = $_POST['performed_by'];
  $materials = $_POST['materials'];
  $labor = $_POST['labor'];
  $otherCost = $_POST['other_cost'];

  $sql = $car->addCar($dateval, $task, $performedBy, $materials, $labor, $otherCost);

  if($sql){
    echo "<script>alert('Data inserted');</script>";
    }else
    {
    echo "<script>alert('Data not inserted');</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <script src="../js/bootstrap.bundle.js"></script>

    <style>
        body{
			background: linear-gradient(rgba(150, 150, 150, 0.8), rgba(150, 150, 150, 0.8)), url('../img/tablebg.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: 100% 100%;
		}

        .title{
            display: flex;
            justify-content: space-between;
        }

        .line{
            border: 1px solid black;
        }
        a{
            text-decoration: none;
            color: white;
        }
        
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-light px-3" style="background-color: rgb(59, 59, 58);">
        <span class="navbar-brand h1 text-light">HOME</span>
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="login.php">Logout</a></li>
          
          </ul>
        </div>
      </nav>
    </header>

    <main>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    
                    <div>
                        <img src="../img/tablebg.jpg" class="img-thumbnail mt-2" width="200" height="100" alt="">
                    </div>

                    <div>
                        <button class="btn btn-light btn-outline-dark mt-2" onclick="returnBtn()">Return</button>
                    </div>

                    <div class="title bg-white mt-5 rounded">
                        <?php
                                   
                        $host = 'localhost';
                        $user = 'root';
                        $pass = '';
                        $dbname = 'car_care';

                        $conn = new mysqli($host, $user, $pass, $dbname);

                        if($conn->connect_error){
                        die("Connection failed". $conn->connect_error);
                        }

                        $sql = "SELECT * FROM car_model WHERE car_id = '$car_id'";
                        $query = $conn->query($sql);
                        while($row = mysqli_fetch_array($query)){

                        ?>
                            
                            <p><?php echo $row['brand'];?></p>
                            <p><?php echo $row['year_model'];?></p>
                            <p><?php echo $row['plate_number'];?></p>
                            <p><?php echo $row['mileage'];?></p>
                            

                        <?php
                        }
                    ?>
                    </div>

                    
                    <div class="line" >
                        
                    </div>

                    <div class="title bg-white">
                        <p><b>Brand</b></p>
                        <p><b>Year/Model</b></p>
                        <p><b>Plate Number</b></p>
                        <p><b>Mileage</b></p>
                    </div>
                </div>

                <div class="col-5">
                    <img src="../css/images/carcare_logo.png" alt="Car Care Logo" class="mx-auto d-block" width="250" height="250" >
                </div>

            </div>

            <div class="row">
                <div class="col-7 mt-3">
                    <div>
                        <table class="table table-bordered ">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">Date Performed</th>
                                <th scope="col">Tasks</th>
                                <th scope="col">Performed By</th>
                                <th scope="col" colspan="4" style="text-align:center">Costing</th>
                                <th scope="col">Action</th>
                                
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Material</th>
                                    <th>Labor</th>
                                    <th>Other Cost</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php
                                   
                                    $host = 'localhost';
                                    $user = 'root';
                                    $pass = '';
                                    $dbname = 'car_care';

                                    $conn = new mysqli($host, $user, $pass, $dbname);


                                    if($conn->connect_error){
                                    die("Connection failed". $conn->connect_error);
                                    }

                                    $sql = "SELECT * FROM viewcar";
                                    $query = $conn->query($sql);
                                    while($row = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['dateval'];?></td>
                                        <td><?php echo $row['task'];?></td>
                                        <td><?php echo $row['performedBy'];?></td>
                                        <td><?php echo $row['materials'];?></td>
                                        <td><?php echo $row['labor'];?></td>
                                        <td><?php echo $row['otherCost'];?></td>
                                        <td><?= $row['materials'] + $row['labor'] + $row['otherCost'] ?></td>

                                        <td>
                                            <button class="btn btn-danger"><a href="delcar.php?deleteid=<?php echo $row['id']?>">Del</a></button>
                                            
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="col-5 mt-1">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="text-align: center">
                               <b>Car Maintenance Service</b>
                            </h4>
                            <div class="card-body">
                                <form action="" method="POST">

                                <div class="mb-3">
                                    <label for=""></label>
                                    <input type="date" class="form-control" name="date"required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Task</label>
                                    <input type="text" class="form-control" name="task" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Performed By</label>
                                    <input type="text" class="form-control" name="performed_by" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Material</label>
                                    <input type="number" class="form-control" name="materials" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Labor</label>
                                    <input type="number" class="form-control" name="labor" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Other Cost</label>
                                    <input type="number" class="form-control" name="other_cost" required>
                                </div>
                                <div class="mb-3 d-grid">
                                    <button type="submit" class=" btn btn-dark btn-block" name="addcar">submit</button>
                                </div>
                                

                                </form>
                            </div>
                        </div>
                       
                        
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer>

    </footer>
    <script>
        function returnBtn(){
            window.location.href = "homepage.php";
        }
    </script>

</body>
</html>