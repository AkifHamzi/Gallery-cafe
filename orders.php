<?php

@include 'config.php';

session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- FAVICON -->
   <link rel="icon" type="image/png" href="images/logo-big.png" />

   <!-- CSS -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="css/all.min.css" />
   <link rel="stylesheet" href="css/fontawesome.min.css" />
   <link rel="stylesheet" href="css/style.css" />

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> Placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                  <p> Name : <span><?= $fetch_orders['name']; ?></span> </p>
                  <p> Number : <span><?= $fetch_orders['number']; ?></span> </p>
                  <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
                  <p> Order Date : <span><?= $fetch_orders['order_date']; ?></span> </p>
                  <p> Order Time : <span><?= $fetch_orders['order_time']; ?></span> </p>
                  <p> Your Orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
                  <p> Total Price : <span>Rs.<?= $fetch_orders['total_price']; ?>/-</span> </p>
                  <p> Order Status : <span><?= $fetch_orders['order_status']; ?></span> </p>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>

      </div>

   </section>

   <section class="placed-orders">

      <h1 class="title">placed Reservations</h1>

      <div class="box-container">

         <?php
         $select_reservations = $conn->prepare("SELECT * FROM `reservations` WHERE user_id = ?");
         $select_reservations->execute([$user_id]);
         if ($select_reservations->rowCount() > 0) {
            while ($fetch_reservations = $select_reservations->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> Reservation id : <span><?= $fetch_reservations['reservation_id']; ?></span> </p>
                  <p> name : <span><?= $fetch_reservations['name']; ?></span> </p>
                  <p> number : <span><?= $fetch_reservations['phone']; ?></span> </p>
                  <p> email : <span><?= $fetch_reservations['email']; ?></span> </p>
                  <p> Reservation Date : <span><?= $fetch_reservations['reservation_date']; ?></span> </p>
                  <p> Reservation Time : <span><?= $fetch_reservations['reservation_time']; ?></span> </p>
                  <p> Table Capacity : <span><?= $fetch_reservations['table_capacity']; ?></span> </p>
                  <p> Reservation Status : <span><?= $fetch_reservations['reservation_status']; ?></span> </p>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no reservations placed yet!</p>';
         }
         ?>

      </div>

   </section>









   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>