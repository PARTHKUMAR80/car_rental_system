<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['car_rental_agency_name'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/index.css">
   <style>
      body {
         background-color: #a8d3a8;
      }
   </style>

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>agency</span></h3>
      <h1>welcome <span><?php echo $_SESSION['car_rental_agency_name'] ?></span></h1>
      <p>this is a car rental agency page</p>
      <a href="add_new_cars.php" class="btn">Add New Cars</a>
      <a href="update_cars.php" class="btn">Update/View Booked Cars</a>
      <a href="logout.php" class="btn">Logout</a>
   </div>

</div>

</body>
</html>