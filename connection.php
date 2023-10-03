<?php

// database connection
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "car_rental_system";

if (!$con = mysqli_connect($db_host,$db_user,$db_password,$db_name)){
    die("Failed to connect to the Database!");
}

?>