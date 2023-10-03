<?php

  @include 'connection.php';

  session_start();

  $_SESSION['no_of_days_of_car_rent'] = $_POST['number_of_days_to_rent_car'];
  $_SESSION['id_of_the_car'] = $_POST['id_of_car'];
  $_SESSION['start_date_of_car'] = $_POST['date_start'];

  $days_for_rent = $_SESSION['no_of_days_of_car_rent'];
  $id_car = $_SESSION['id_of_the_car'];
  $start_day_of_vehicle = $_SESSION['start_date_of_car'];

  $id_of_customer = $_SESSION['customer_id'];

  $todays_date = date("Y-m-d");

  $new_sql = "SELECT `booked_by_user_id` FROM cars WHERE id='$id_car'";
  $resultt = mysqli_query($con,$new_sql);
  $roww=mysqli_fetch_array($resultt);
  $value = $roww[0];

  if ($value == $id_of_customer){
    $sql = "UPDATE cars
    SET booked_by_user_id = -1,
    booked_for_number_of_days = -1,
    booked_start_date = $todays_date
    WHERE id = $id_car";

    $result = mysqli_query($con, $sql);

    header('location:index.php');

  }
  else {

    $sql = "UPDATE cars
    SET booked_by_user_id = '$id_of_customer',
    booked_for_number_of_days = $days_for_rent,
    booked_start_date = '$start_day_of_vehicle'
    WHERE id = $id_car";

    $result = mysqli_query($con, $sql);

    header('location:index.php');

  }

?>