<?php

  @include 'connection.php';

  session_start();

  if(!isset($_SESSION['car_rental_agency_name'])){
    header('location:login.php');
  }

  $sql = " SELECT * FROM cars";
  $result = mysqli_query($con, $sql);

  if (isset($_POST['submit-vehicle-id-up'])){
    $sql = " SELECT * FROM cars ORDER BY id DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-id-down'])){
    $sql = " SELECT * FROM cars ORDER BY id ASC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-model-up'])){
    $sql = " SELECT * FROM cars ORDER BY vehicle_model DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-model-down'])){
    $sql = " SELECT * FROM cars ORDER BY vehicle_model ASC";
    $result = mysqli_query($con, $sql);
  }
  if (isset($_POST['submit-vehicle-number-up'])){
    $sql = " SELECT * FROM cars ORDER BY vehicle_number DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-number-down'])){
    $sql = " SELECT * FROM cars ORDER BY vehicle_number ASC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-seating-capacity-up'])){
    $sql = " SELECT * FROM cars ORDER BY seating_capacity DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-seating-capacity-down'])){
    $sql = " SELECT * FROM cars ORDER BY seating_capacity ASC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-rent-per-day-up'])){
    $sql = " SELECT * FROM cars ORDER BY rent_per_day DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-rent-per-day-down'])){
    $sql = " SELECT * FROM cars ORDER BY rent_per_day ASC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-booked-by-user-id-up'])){
    $sql = " SELECT * FROM cars ORDER BY booked_by_user_id DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-booked-by-user-id-down'])){
    $sql = " SELECT * FROM cars ORDER BY booked_by_user_id ASC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-booked-for-number-of-days-up'])){
    $sql = " SELECT * FROM cars ORDER BY booked_for_number_of_days DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-booked-for-number-of-days-down'])){
    $sql = " SELECT * FROM cars ORDER BY booked_for_number_of_days ASC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-booked-start-date-up'])){
    $sql = " SELECT * FROM cars ORDER BY booked_start_date DESC";
    $result = mysqli_query($con, $sql);
  }

  if (isset($_POST['submit-vehicle-booked-start-date-down'])){
    $sql = " SELECT * FROM cars ORDER BY booked_start_date ASC";
    $result = mysqli_query($con, $sql);
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
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          /* border: 1px solid #dddddd; */
          border: 2px solid grey;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        tr:nth-child(odd){
            background-color: #ffffff;
        }
        button.update{
            background-color: green !important;
            color: white;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
        }
        button.delete{
            background-color: crimson;
            color: white;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

    <h1 style="color:blue; font-size: 3rem; text-align:center;">Update Cars Page / <span style="font-size:2rem;">only non booked cars can be updated</span></h1>
    <div>
        <a style="text-decoration:none; font-size: 1.6rem;" href="car_rental_agency_page.php" class="btn">back...</a>
    </div>
    <a style="text-decoration:none; font-size: 1.6rem;" href="logout.php" class="btn">Logout</a>

    <table style="margin-top: 20px;">
      <tr>
        <th>
            <form style="display:grid; grid-template-columns: 1fr 1fr; margin-top: 10px; margin-bottom: 10px;" action="" method="post">
                <button type="submit" name="submit-vehicle-id-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-id-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            
        </th>
        <th>
            <form action="" method="post">
                <button type="submit" name="submit-vehicle-model-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-model-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            <form action="" method="post">
                <button type="submit" name="submit-vehicle-number-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-number-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            <form action="" method="post">
                <button type="submit" name="submit-vehicle-seating-capacity-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-seating-capacity-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            <form action="" method="post">
                <button type="submit" name="submit-vehicle-rent-per-day-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-rent-per-day-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            <form action="" method="post">
                <button type="submit" name="submit-vehicle-booked-by-user-id-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-booked-by-user-id-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            
        </th>
        <th>
            <form action="" method="post">
                <button type="submit" name="submit-vehicle-booked-for-number-of-days-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-booked-for-number-of-days-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            <form action="" method="post">
                <button type="submit" name="submit-vehicle-booked-start-date-up"><i class="fa fa-angle-double-up" style="font-size:24px"></i></button>
                <button type="submit" name="submit-vehicle-booked-start-date-down"><i class="fa fa-angle-double-down" style="font-size:24px"></i></button>
            </form>
        </th>
        <th>
            
        </th>
        <th>
            
        </th>
      </tr>
      <tr>
        <th>Vehicle ID</th>
        <th>Vehicle Image</th>
        <th>Vehicle Model</th>
        <th>Vehicle Number</th>
        <th>Seating Capacity</th>
        <th>Rent Per Day</th>
        <th>Booked By User ID</th>
        <th>Booked By User Name</th>
        <th>Booked for number of days</th>
        <th>Booked Start Date</th>
        <th>Udpate</th>
        <th>Delete</th>
        </tr>
      <?php
        while($rows=$result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $rows['id'];?></td>
            <td><img style="height: 100px; width: 100px;" src="./image/<?php echo $rows['car_image_filename'];?>" alt=""></td>
            <td><?php echo $rows['vehicle_model'];?></td>
            <td><?php echo $rows['vehicle_number'];?></td>
            <td><?php echo $rows['seating_capacity'];?></td>
            <td><?php echo $rows['rent_per_day'];?></td>
            <td><?php echo $rows['booked_by_user_id'];?></td>
            <td>
                <?php
                  $variable = $rows['booked_by_user_id'];
                  if ($variable == -1){
                    echo "None";
                  }
                  else {
                    $new_sql = "SELECT name FROM customers WHERE id='$variable'";
                  $new_result = mysqli_query($con, $new_sql);
                  $roww = mysqli_fetch_array($new_result);
                  $value = $roww[0];
                  echo $value;
                  }
                ?>
            </td>
            <td><?php echo $rows['booked_for_number_of_days'];?></td>
            <td><?php echo $rows['booked_start_date'];?></td>
            <td>
                <a href="update_single_car.php?car_id=<?php echo $rows['id'];?>"><button 
                  class="update"
                  <?php if ($rows['booked_by_user_id'] != -1){
                  ?>
                  style="opacity: 0.4; cursor: not-allowed;";
                  disabled="disabled"
                  <?php
                  }
                  ?>
                >
                  Update car
                </button></a>
            </td>
            <td>
                <a href="delete_item.php?car_id=<?php echo $rows['id'];?>">
                <button 
                  class="delete"
                  <?php if ($rows['booked_by_user_id'] != -1){
                  ?>
                  style="opacity: 0.4; cursor: not-allowed;"
                  disabled="disabled"
                  <?php
                  }
                  ?>
                >
                  Delete Car
                </button>
                </a>
            </td>
        </tr>
        <?php
        }
      ?>
    </table>
</body>
</html>