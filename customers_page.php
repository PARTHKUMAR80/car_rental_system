<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['customer_name'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/index.css">

   <style>
      body {
         background-color: #283232;
      }
   </style>

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3 style="color: #ffffff;">hi, <span>user</span></h3>
      <h1 style="color: #ffffff;">welcome <span><?php echo $_SESSION['customer_name'] ?></span></h1>
      <p style="color: #ffffff;">this is an user page</p>
      <a style="background-color: crimson; border-radius: 10px;" href="logout.php" class="btn">logout</a>
      <a style="background-color: crimson; border-radius: 10px;" href="index.php" class="btn">Book Cars</a>
   </div>

</div>

</body>
</html>