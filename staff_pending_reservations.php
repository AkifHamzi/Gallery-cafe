<?php

@include 'config.php';

session_start();

$staff_id = $_SESSION['staff_id'] ?? null;
$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($staff_id) && !isset($admin_id)) {
   header('location:login.php');
   exit;
}

$select_reservations = $conn->prepare("SELECT * FROM `reservations` WHERE reservation_status = 'pending'");
$select_reservations->execute();

// Handle form submission
if (isset($_POST['update_reservation'])) {
   $reservation_id = $_POST['reservation_id'];
   $update_status = $_POST['update_status'];

   // Update reservation in the database
   $update_reservation = $conn->prepare("UPDATE `reservations` SET reservation_status = :status WHERE reservation_id = :id");
   $update_reservation->bindParam(':status', $update_status);
   $update_reservation->bindParam(':id', $reservation_id, PDO::PARAM_INT);
   $update_reservation->execute();

   // Redirect to the same page
   header('Location: staff_pending_reservations.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Staff Pending Reservations</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- FAVICON -->
   <link rel="icon" type="image/png" href="images/logo-big.png" />

   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="css/all.min.css" />

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/admin_style.css">
   <!-- CSS -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />

</head>

<body>

   <?php include 'staff_header.php'; ?>

   <a href="staff_dashboard.php" class="option-btn">go back</a>

   <section class="placed-orders">

      <h1 class="title">Pending Reservations</h1>

      <div class="box-container">

         <?php
         // Display reservations
         if ($select_reservations->rowCount() > 0) {
            while ($fetch_reservations = $select_reservations->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <!-- Reservation details -->
                  <p> Name: <span><?= htmlspecialchars($fetch_reservations['name']); ?></span> </p>
                  <p> Phone No: <span><?= htmlspecialchars($fetch_reservations['phone']); ?></span> </p>
                  <p> Date: <span><?= htmlspecialchars($fetch_reservations['reservation_date']); ?></span> </p>
                  <p> Time: <span><?= htmlspecialchars($fetch_reservations['reservation_time']); ?></span> </p>
                  <p> Table Capacity: <span><?= htmlspecialchars($fetch_reservations['table_capacity']); ?></span> </p>
                  <p> Special Requests: <span><?= htmlspecialchars($fetch_reservations['special_requests']); ?></span> </p>

                  <!-- Form-reservation-->
                  <form action="" method="POST">
                     <input type="hidden" name="reservation_id" value="<?= $fetch_reservations['reservation_id']; ?>">
                     <select name="update_status" class="drop-down">
                        <option value="pending" <?= ($fetch_reservations['reservation_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="confirmed" <?= ($fetch_reservations['reservation_status'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                        <option value="cancelled" <?= ($fetch_reservations['reservation_status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                     </select>
                     <input type="submit" name="update_reservation" class="option-btn" value="Update">
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No pending reservations found!</p>';
         }
         ?>

      </div>

   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="js/script.js"></script>

</body>

</html>