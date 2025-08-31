<?php

@include 'config.php';

session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = null;
}

if (isset($_POST['order'])) {

   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $order_date = $_POST['order_date'];
   $order_time = $_POST['order_time'];
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products = [];

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if ($cart_query->rowCount() > 0) {
      while ($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
         $cart_products[] = $cart_item['name'] . ' ( ' . $cart_item['quantity'] . ' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND order_date = ? AND order_time = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $order_date, $order_time, $total_products, $cart_total]);

   if ($cart_total == 0) {
      $message[] = 'Your cart is empty';
   } elseif ($order_query->rowCount() > 0) {
      $message[] = 'Order already placed!';
   } else {
      // Insert data into orders table
      $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, order_date, order_time, total_products, total_price, placed_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_order->execute([$user_id, $name, $number, $email, $order_date, $order_time, $total_products, $cart_total, $placed_on]);

      // Clear cart
      $clear_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $clear_cart->execute([$user_id]);

      $message[] = 'Order placed successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pre-Order Checkout</title>

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
   <link rel="stylesheet" href="css/res.css">

</head>>

<body>

   <?php include 'header.php'; ?>

   <section class="display-orders">
      <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if ($select_cart_items->rowCount() > 0) {
         while ($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)) {
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
      ?>
            <p> <?= htmlspecialchars($fetch_cart_items['name']); ?> <span>(<?= 'Rs.' . htmlspecialchars($fetch_cart_items['price']) . '/- x ' . htmlspecialchars($fetch_cart_items['quantity']); ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">Your cart is empty!</p>';
      }
      ?>
      <div class="grand-total">Grand total: <span>Rs.<?= $cart_grand_total; ?>/-</span></div>
   </section>

   <section class="checkout-orders">

      <form action="" method="POST">

         <h3>Place your Pre-Order</h3>

         <div class="flex">
            <div class="inputBox">
               <span>Your name :</span>
               <input type="text" name="name" placeholder="Enter your name" class="box" required>
            </div>
            <div class="inputBox">
               <span>Your number :</span>
               <input type="number" name="number" placeholder="Enter your number" class="box" required>
            </div>
            <div class="inputBox">
               <span>Your email :</span>
               <input type="email" name="email" placeholder="Enter your email" class="box" required>
            </div>
            <div class="inputBox">
               <span>Order Date :</span>
               <input type="date" name="order_date" class="box" placeholder="Order Date" required>
            </div>
            <div class="inputBox">
               <span>Order Time :</span>
               <input type="time" name="order_time" class="box" placeholder="Order Time" required>
            </div>



         </div>

         <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1) ? '' : 'disabled'; ?>" value="Place Pre-order">

      </form>

   </section>

   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>