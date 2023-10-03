<?php

@include 'connection.php';

session_start();

if(!isset($_SESSION['car_rental_agency_name'])){
   header('location:login.php');
   die;
}
 
$msg = "";
 
// If upload button is clicked ...
if (isset($_POST['submit'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;

    $vehicle_model = mysqli_real_escape_string($con, $_POST['vehicle_model']);
    $vehicle_number = mysqli_real_escape_string($con, $_POST['vehicle_number']);
    $seating_capacity = $_POST['seating_capacity'];
    $rent_per_day = $_POST['rent_per_day'];

    $date = date("Y-m-d");
    $time = date("h:i:sa");
 
    $sql = "INSERT INTO cars(vehicle_model, vehicle_number, seating_capacity, rent_per_day, booked_by_user_id, booked_for_number_of_days, booked_start_date, car_image_filename) VALUES ('$vehicle_model', '$vehicle_number', '$seating_capacity', '$rent_per_day', -1, -1, '$date', '$filename')";

    mysqli_query($con, $sql);
    move_uploaded_file($tempname, $folder);

    header("location:car_rental_agency_page.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Cars</title>
    <link rel="stylesheet" href="css/add_new_cars.css"></link>
    <style>
      body{
        background-color: #a8d3a8;
      }
    </style>
</head>
<body>

<p><a style="font-size:1.5rem; color: crimson; text-decoration:none;" href="car_rental_agency_page.php">back to main page...</a> </p>

<div class="container">
  <form action="" method="post" enctype="multipart/form-data">

    <div class="row">
      <div class="col-25">
        <label for="vehicle_model">Vehicle Model</label>
      </div>
      <div class="col-75">
        <input type="text" id="vehicle_model" name="vehicle_model" placeholder="vehicle model..">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="vehicle_number">Vehicle Number</label>
      </div>
      <div class="col-75">
        <input type="text" id="vehicle_number" name="vehicle_number" placeholder="vehicle number..">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="seating_capacity">Seating Capacity</label>
      </div>
      <div class="col-75">
        <input style="padding: 11px 12px;font-size: 0.8rem;" type="number" id="seating_capacity" name="seating_capacity" placeholder="seating capacity..">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="rent_per_day">Rent_per_day</label>
      </div>
      <div class="col-75">
        <input style="padding: 11px 12px;font-size: 0.8rem;" type="number" id="rent_per_day" name="rent_per_day" placeholder="rent per day..">
      </div>
    </div>

    <div style="margin-top:20px" class="row">
        <div class="form-group">
            <input class="form-control" type="file" name="uploadfile" value="" />
        </div>
    </div>

    <div style="display:flex; justify-content:center; align-items:center;" class="row">
      <input style="padding:10px 45px; font-size: 2rem; background-color: crimson;" name="submit" type="submit" value="Submit">
    </div>
  </form>
</div>

</body>
</html>