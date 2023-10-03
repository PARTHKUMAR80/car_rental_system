<?php

  @include 'connection.php';

  session_start();

    // if anyone tries to access this URL directly
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: update_cars.php');
        exit;
    }

  if(!isset($_SESSION['car_rental_agency_name'])){
    header('location:login.php');
  }

  $car_id = $_GET['car_id'];

  $sql = " SELECT * FROM cars WHERE id='$car_id'";
  $result = mysqli_query($con, $sql);
  $rows = mysqli_fetch_array($result);

  if (isset($_POST['submit'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    if (empty($filename)){
        $filename = $rows['car_image_filename'];
    }
    $folder = "./image/" . $filename;

    $vehicle_model = mysqli_real_escape_string($con, $_POST['vehicle_model']);
    $vehicle_number = mysqli_real_escape_string($con, $_POST['vehicle_number']);
    $seating_capacity = $_POST['seating_capacity'];
    $rent_per_day = $_POST['rent_per_day'];

    $date = date("Y-m-d");
    $time = date("h:i:sa");
 
    $sql = "UPDATE cars
    SET seating_capacity = $seating_capacity,
    vehicle_model = '$vehicle_model',
    vehicle_number = '$vehicle_number',
    rent_per_day = $rent_per_day,
    car_image_filename = '$filename'
    WHERE id = $car_id";

    mysqli_query($con, $sql);
    move_uploaded_file($tempname, $folder);

    header('location:update_cars.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #a8d3a8;
        }
        form {
            border: 2px solid black;
            background-color: #e9e3e3;
        }
        form .container{
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        form .container-img {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        form .container-img .single-div{
            border: 2px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        form .container-btn {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        form .container-btn button, form .container-btn a{
            text-decoration: none;
            border: none;
            font-size: 2rem;
            background-color: crimson;
            color: white;
            padding: 12px;
            cursor: pointer;
            border-radius: 6px;
            margin: 20px;
        }
        form .container .single-div{
            border: 2px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        form .container .single-div p{
            font-size: 2rem;
            margin-right: 20px;
        }
        form .container .single-div input{
            font-size: 1.5rem;
            padding: 4px;
        }
        form .container-img img{
            height: 200px;
            width: 200px;
        }
    </style>
</head>
<body>
    <h1 style="color:blue; font-size: 3rem; text-align:center;">Update the selected car...</h1>
    <a style="text-decoration:none; font-size: 1.6rem;" href="logout.php">Logout</a>

    <form method="post"  enctype="multipart/form-data">

        <div class="container-img">
            <div class="single-div">
                <img src="./image/<?php echo $rows['car_image_filename'];?>" alt="">
            </div>
            <div class="single-div">
                <input onchange="previewImage(event)" class="form-control" type="file" name="uploadfile" />
                <img src="./image/<?php echo $rows['car_image_filename'];?>"id="preview" alt="Preview Image">
            </div>
        </div>

        <div class="container">
            <div class="single-div">
                <div>
                    <p>Old Vehicle Model</p>
                </div>
                <div>
                    <input style="opacity: 0.7;" type="text" readonly value="<?php echo $rows['vehicle_model']; ?>">
                </div>
            </div>
            <div class="single-div">
                <div>
                    <p>New Vehicle Model</p>
                </div>
                <div>
                    <input value="<?php echo $rows['vehicle_model']; ?>" type="text" id="vehicle_model" name="vehicle_model">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="single-div">
                <div>
                    <p>Old Vehicle Number</p>
                </div>
                <div>
                    <input style="opacity: 0.7;" type="text" readonly value="<?php echo $rows['vehicle_number']; ?>">
                </div>
            </div>
            <div class="single-div">
                <div>
                    <p>New Vehicle Number</p>
                </div>
                <div>
                    <input type="text" name="vehicle_number" value="<?php echo $rows['vehicle_number']; ?>">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="single-div">
                <div>
                    <p>Old Seating Capacity</p>
                </div>
                <div>
                    <input style="opacity: 0.7;" type="number" readonly value="<?php echo $rows['seating_capacity']; ?>">
                </div>
            </div>
            <div class="single-div">
                <div>
                    <p>New Seating Capacity</p>
                </div>
                <div>
                    <input type="number" name="seating_capacity" value="<?php echo $rows['seating_capacity']; ?>">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="single-div">
                <div>
                    <p>Old Rent Per Day</p>
                </div>
                <div>
                    <input style="opacity: 0.7;" type="text" readonly value="<?php echo $rows['rent_per_day']; ?>">
                </div>
            </div>
            <div class="single-div">
                <div>
                    <p>New Rent Day</p>
                </div>
                <div>
                    <input type="number" name="rent_per_day" value="<?php echo $rows['rent_per_day']; ?>">
                </div>
            </div>
        </div>

        <div class="container-btn">
            <a href="update_cars.php">
                Back to previous page...
            </a>
            <button type="submit" name="submit">Submit</button>
        </div>

    </form>
</body>

<script>
    function previewImage(event) {
         var input = event.target;
         var image = document.getElementById('preview');
         if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               image.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
         }
      }
</script>

</html>