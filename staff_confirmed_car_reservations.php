<?php

@include 'config.php';

session_start();

$staff_id = $_SESSION['staff_id'] ?? null;
$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($staff_id) && !isset($admin_id)) {
    header('location:login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Confirmed Car Reservations</title>

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

        <h1 class="title">Confirmed Car Reservations</h1>

        <div class="box-container">

            <?php
            $select_reservations = $conn->prepare("SELECT * FROM `car_reservations` WHERE reservation_status = 'confirmed'");
            $select_reservations->execute();
            if ($select_reservations->rowCount() > 0) {
                while ($fetch_reservations = $select_reservations->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <!-- car reservation details -->
                        <p> Customer Name: <span><?= ($fetch_reservations['name']); ?></span> </p>
                        <p> Contact Number: <span><?= ($fetch_reservations['phone']); ?></span> </p>
                        <p> Vehicle Number: <span><?= ($fetch_reservations['vehicle_no']); ?></span> </p>
                        <p> Vehicle Type: <span><?= ($fetch_reservations['vehicle_type']); ?></span> </p>
                        <p> Check-in Time: <span><?= ($fetch_reservations['check_in_time']); ?></span> </p>
                        <p> Check-out Time: <span><?= ($fetch_reservations['check_out_time']); ?></span> </p>
                        <p> Entry Date: <span><?= ($fetch_reservations['entry_date']); ?></span> </p>
                        <p> Exit Date: <span><?= ($fetch_reservations['exit_date']); ?></span> </p>
                        <p> Reservation Status: <span><?= ($fetch_reservations['reservation_status']); ?></span> </p>

                        <a href="staff_dashboard.php" class="btn btn-primary mt-3">Go Back</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No confirmed car reservations found!</p>';
            }
            ?>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>

</body>

</html>