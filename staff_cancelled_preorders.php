<?php

@include 'config.php';

session_start();

$staff_id = $_SESSION['staff_id'] ?? null;
$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($staff_id) && !isset($admin_id)) {
   header('location:login.php');
   exit;
}

if (isset($_POST['update_preorder'])) {
   $preorder_id = $_POST['preorder_id'];
   $update_status = $_POST['update_status'];
   $update_preorder = $conn->prepare("UPDATE `orders` SET order_status = ? WHERE id = ?");
   $update_preorder->execute([$update_status, $preorder_id]);
   header('Location: staff_cancelled_preorders.php');
   exit;
}

$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE order_status = 'cancelled'");
$select_orders->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Staff Cancelled Pre-Orders</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- FAVICON -->
   <link rel="icon" type="image/png" href="images/logo-big.png" />

   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="css/all.min.css" />

   <!-- CSS -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

   <?php include 'staff_header.php'; ?>

   <a href="staff_dashboard.php" class="option-btn">go back</a>

   <section class="placed-orders">

      <h1 class="title">Cancelled Pre-Orders</h1>

      <div class="box-container">

         <?php

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
                  <p> Order : <span><?= $fetch_orders['total_products']; ?></span> </p>



                  <form action="" method="POST">
                     <input type="hidden" name="preorder_id" value="<?= $fetch_orders['id']; ?>">
                     <select name="update_status" class="drop-down">
                        <option value="pending" <?= ($fetch_orders['order_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="confirmed" <?= ($fetch_orders['order_status'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                        <option value="cancelled" <?= ($fetch_orders['order_status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                     </select>
                     <input type="submit" name="update_preorder" class="option-btn" value="Update">
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No cancelled pre-orders found!</p>';
         }
         ?>

      </div>

   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="js/script.js"></script>

</body>

</html>