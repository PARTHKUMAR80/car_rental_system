<?php

  @include 'connection.php';

  session_start();

  if(!isset($_SESSION['car_rental_agency_name'])){
    header('location:login.php');
  }

  $car_id = $_GET['car_id'];

  $sql = "DELETE FROM cars WHERE id = $car_id";
  $result = mysqli_query($con, $sql);

  header('location:update_cars.php');

?>