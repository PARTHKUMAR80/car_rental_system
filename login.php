<?php

@include 'connection.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($con, $_POST['email']);
   $pass = md5($_POST['password']);
   $user_type = $_POST['user_type'];

   $select = "";

   if ($user_type == 'car_rental_agency'){
      $select = " SELECT * FROM car_rental_agency WHERE email = '$email' && password = '$pass' ";
   }
   else {
      $select = " SELECT * FROM customers WHERE email = '$email' && password = '$pass' ";
   }

   $result = mysqli_query($con, $select);

   if ($user_type == 'car_rental_agency' && mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);
  
        $_SESSION['car_rental_agency_name'] = $row['name'];
        $_SESSION['car_rental_agency_id'] = $row['id'];
        header('location:car_rental_agency_page.php');

   }
   else if ($user_type == 'customer' && mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        $today = date("d/m/Y");
      
        $_SESSION['customer_name'] = $row['name'];
        $_SESSION['customer_id'] = $row['id'];
        header('location:customers_page.php');
   }
   else {
        $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/index.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <select name="user_type">
         <option value="customer">customer</option>
         <option value="car_rental_agency">car_rental_agency</option>
      </select>
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account?</p>
      <p><a href="registration_customers.php">register as a user</a></p>
      <p><a href="registration_car_rental_agency.php">register as a car rental agency</a></p>
   </form>

</div>

</body>
</html>