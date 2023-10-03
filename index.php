<?php

  @include 'connection.php';

  session_start();

  $sql = " SELECT * FROM cars ";
  $result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">

    <style>
    body {
        background-color: #283232;
    }
    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }
    .card-container .card {
        border: 2px solid black;
        border-radius: 6px;
        background-color: #ece8e8;
        margin: 20px;
        box-shadow: 14px 14px;
    }
    .card-container .card img {
        max-height: 200px;
        max-width: 400px;
    }
    .card-container .card div {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    .card-container .card p{
        font-size: 1.4rem;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 20px;
        margin-right: 20px;
    }
    .card-container .card p:nth-child(10) {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }
    .card-container .card p span {
        float: right;
        padding-left: 50px;
        color: crimson;
        font-weight: bold;
    }
    .card-container .card p button {
        background-color: crimson;
        font-size: 1.6rem;
        padding: 10px 28px;
        margin: auto;
        border-radius: 10px;
        transition: background-color 0.4s;
    }
    .card-container .card p button:hover {
        cursor: pointer;
        background-color: rgb(232, 116, 140);;
    }
    input,
    select{
       width: 100%;
       padding:10px 15px;
       font-size: 17px;
       margin:8px 0;
       background: #eee;
       border-radius: 5px;
    }
    </style>

</head>
<body>

    <h2 style="text-align:center; margin-top:20px; font-size: 3rem; color:white;">Available Cars to rent</h2>
    <h2>

    <?php if (!isset($_SESSION['customer_name']) && !isset($_SESSION['car_rental_agency_name'])){;?>
        <a style="color: white;" href="login.php">Login...</a>
    <?php
    }
    ?>

        <?php if (isset($_SESSION['customer_name'])){;?>
            <button onclick=(hide()) style="text-align:center; margin-left: 10px; margin-top:20px; font-size: 1rem; color:#ffffff; cursor:pointer; padding: 9px 16px; border-radius: 16px; background-color: crimson; font-weight: 300;">Show all cars / Show only rented cars</button>
        <?php
        }
        ?>
    </h2>

    <?php 
        if (isset($_SESSION['customer_name'])){
    ?>
        <h1 style="margin-left:10px; color: #ffffff; margin-top: 10px;">Hello <?php echo $_SESSION['customer_name'];?></h1>
        <p style="margin-left:10px;"><a style="color: white;" href="logout.php">Logout...</a></p>
    <?php
        }
    ?>

    <div class="card-container">

    <?php 
        if (isset($_SESSION['customer_name'])){
    ?>

        <?php
            while($rows=$result->fetch_assoc()){
        ?>

            <div

              <?php if ($rows['booked_by_user_id'] != $_SESSION['customer_id']){
              ?>
              class="card hidden"
              <?php
              } 
              else {
              ?>
              class="card"
              <?php
              }
              ?>
            >

              <form action="rent_the_car.php" method="POST">

                  <div>
                    <img src="./image/<?php echo $rows['car_image_filename'];?>" alt="">
                  </div>
                  <p>Vehicle Model <span><?php echo $rows['vehicle_model'];?></span> </p>
                  <p>Vehicle Number <span><?php echo $rows['vehicle_number'];?></span> </p>
                  <p>Seating Capacity <span><?php echo $rows['seating_capacity'];?></span> </p>
                  <p>Rent Per Day <span>Rs <?php echo $rows['rent_per_day'];?></span> </p>

                  <p>No. of days you want to rent the car</p>
                  <select 
                    onChange="myFunction(this.options[this.selectedIndex].value)" name="number_of_days_to_rent_car"

                    <?php 
                    if ($rows['booked_by_user_id'] == $_SESSION['customer_id'] || ($rows['booked_by_user_id'] != $_SESSION['customer_id'] && $rows['booked_by_user_id'] != -1)){
                        ?>
                        disabled
                    <?php
                    }
                    ?>
                  >
                  <?php if ($rows['booked_by_user_id'] == $_SESSION['customer_id']){
                    echo "<option value=".$rows['booked_for_number_of_days']."> ".$rows['booked_for_number_of_days']." </option>";
                  }
                  else {
                    for($i=1; $i<=30; $i++)
                    {
                        echo "<option value=".$i.">".$i."</option>";
                    }
                  }
                  ?>
                  </select>

                  <p>
                    Start Date 
                    <span>
                        <?php 
                            if ($rows['booked_by_user_id'] == $_SESSION['customer_id'] || ($rows['booked_by_user_id'] != $_SESSION['customer_id'] && $rows['booked_by_user_id'] != -1)){
                                echo $rows['booked_start_date'];
                            }else {;?>
                                <div>
                                    <input type="date" id="start" name="date_start" value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>" max="2023-12-31" />
                                </div>
                            <?php
                            }
                        ?>
                    </span>
                  </p>

                  <input style="display:none;" type="number" value="<?php echo $rows["id"]; ?>" name="id_of_car" />

                  <?php
                    if ($rows['booked_by_user_id'] == $_SESSION['customer_id']){
                    ?>
                      <div style="margin: 0px 20px;">
                        <input style="background-color:green; color:white; cursor:pointer;" type="submit" value="Remove from rent..."/>
                      </div>
                    <?php
                    }
                    else if ($rows['booked_by_user_id'] == -1){
                    ?>
                      <div style="margin: 0px 20px;">
                        <input style="background-color:yellow; color:white; cursor:pointer;" type="submit" value="Rent">
                      </div>
                    <?php
                    }
                    else {
                        ?>
                        <div style="margin: 0px 20px;">
                          <input disabled="disabled" style="background-color:red; color:white; cursor:not-allowed;" type="submit" value="Someone else rented...">
                        </div>
                    <?php
                    }
                ?>
    
              </form>
            </div>
        
        <?php
            }
        ?>
        <?php
        } else {
        ?>

        <?php
            while($rows=$result->fetch_assoc()){
        ?>

            <div class="card">
              <div>
                <img src="./image/<?php echo $rows['car_image_filename'];?>" alt="">
              </div>
              <p>Vehicle Model <span><?php echo $rows['vehicle_model'];?></span> </p>
              <p>Vehicle Number <span><?php echo $rows['vehicle_number'];?></span> </p>
              <p>Seating Capacity <span><?php echo $rows['seating_capacity'];?></span> </p>
              <p>Rent Per Day <span><?php echo $rows['rent_per_day'];?></span> </p>
              <p>
                <button style="color:white; width:100%;" onClick="document.location.href='login.php'">Rent Car</button>
              </p>
            </div>
        <?php
        }
        ?>

        <?php
        }
        ?>

    </div>
</body>

<script>

    function myFunction(chosen){
        document.getElementById('no_of_days_selected_by_customer').value = chosen;
    }
    function hide(){
        var elements = document.querySelectorAll('.hidden');
        console.log(elements);
        elements.forEach(ele => {
            if (ele.style.display == "none"){
                ele.style.display = "block";
            }
            else {
                ele.style.display = "none";
            }
        })
        console.log("a");
    }
</script>

</html>