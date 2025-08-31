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
    <title>Staff Dashboard</title>

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

    <section class="dashboard">
        <h1 class="title">Staff Dashboard</h1>

        <h2 class="min-title">Reservations</h2>
        <div class="box-container">
            <div class="box">
                <?php

                $select_reservations = $conn->prepare("SELECT * FROM `reservations` WHERE reservation_status = 'pending'");
                $select_reservations->execute();
                $number_of_reservations = $select_reservations->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_reservations; ?></h3>
                <p class="card-text"><i class="fa fa-calendar"></i> Pending Reservations</p>
                <a href="staff_pending_reservations.php" class="btn">View Reservations</a>
            </div>

            <div class="box">
                <?php

                $select_reservations = $conn->prepare("SELECT * FROM `reservations` WHERE reservation_status = 'confirmed'");
                $select_reservations->execute();
                $number_of_reservations = $select_reservations->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_reservations; ?></h3>
                <p class="card-text"><i class="fa fa-calendar-check"></i> Confirmed Reservations</p>
                <a href="staff_confirmed_reservation.php " class="btn">View Reservations</a>
            </div>

            <div class="box">
                <?php

                $select_reservations = $conn->prepare("SELECT * FROM `reservations` WHERE reservation_status = 'cancelled'");
                $select_reservations->execute();
                $number_of_reservations = $select_reservations->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_reservations; ?></h3>
                <p class="card-text"><i class="fa fa-calendar-times"></i> Cancelled Reservations</p>
                <a href="staff_cancelled_reservations.php" class="btn">View Reservations</a>
            </div>
        </div>
    </section>

    <section class="dashboard">
        <h2 class="min-title">Pre-Orders</h2>
        <div class="box-container">
            <div class="box">
                <?php

                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE order_status = 'pending'");
                $select_orders->execute();
                $number_of_preorders = $select_orders->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_preorders; ?></h3>
                <p class="card-text"><i class="fa fa-shopping-cart"></i> Pending Pre-Orders</p>
                <a href="staff_pending_preorders.php" class="btn">View Pre-Orders</a>
            </div>

            <div class="box">
                <?php

                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE order_status = 'confirmed'");
                $select_orders->execute();
                $number_of_preorders = $select_orders->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_preorders; ?></h3>
                <p class="card-text"><i class="fa fa-shopping-cart"></i> Confirmed Pre-Orders</p>
                <a href="staff_confirmed_preorders.php" class="btn">View Pre-Orders</a>
            </div>

            <div class="box">
                <?php

                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE order_status = 'cancelled'");
                $select_orders->execute();
                $number_of_preorders = $select_orders->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_preorders; ?></h3>
                <p class="card-text"><i class="fa fa-shopping-cart"></i> Cancelled Pre-Orders</p>
                <a href="staff_cancelled_preorders.php" class="btn">View Pre-Orders</a>
            </div>
        </div>
    </section>

    <section class="dashboard">
        <h2 class="min-title">Promotions & Events</h2>
        <div class="box-container">

            <div class="box">
                <?php
                $select_events = $conn->prepare("SELECT * FROM `events`");
                $select_events->execute();
                $number_of_events = $select_events->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_events; ?></h3>
                <p class="card-text"><i class="fa fa-box"></i> Add Promotions & Events</p>
                <a href="staff_new_promo.php" class="btn">Add</a>
            </div>

            <div class="box">
                <?php
                $select_events = $conn->prepare("SELECT * FROM `events`");
                $select_events->execute();
                $number_of_events = $select_events->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_events; ?></h3>
                <p class="card-text"><i class="fa fa-box"></i> All Promotions & Events</p>
                <a href="staff_promo.php" class="btn">See Promotions & Events</a>
            </div>

        </div>
    </section>

    <section class="dashboard">
        <h2 class="min-title">Parking Reservations</h2>
        <div class="box-container">
            <div class="box">
                <?php
                // Count pending car reservations
                $select_car_reservations = $conn->prepare("SELECT * FROM `car_reservations` WHERE reservation_status = 'pending'");
                $select_car_reservations->execute();
                $number_of_car_reservations_pending = $select_car_reservations->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_car_reservations_pending; ?></h3>
                <p class="card-text"><i class="fa fa-car"></i> Pending Reservations</p>
                <a href="staff_pending_car_reservations.php" class="btn">View Reservations</a>
            </div>

            <div class="box">
                <?php

                $select_car_reservations = $conn->prepare("SELECT * FROM `car_reservations` WHERE reservation_status = 'confirmed'");
                $select_car_reservations->execute();
                $number_of_car_reservations_confirmed = $select_car_reservations->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_car_reservations_confirmed; ?></h3>
                <p class="card-text"><i class="fa fa-car"></i> Confirmed Reservations</p>
                <a href="staff_confirmed_car_reservations.php" class="btn">View Reservations</a>
            </div>

            <div class="box">
                <?php

                $select_car_reservations = $conn->prepare("SELECT * FROM `car_reservations` WHERE reservation_status = 'cancelled'");
                $select_car_reservations->execute();
                $number_of_car_reservations_cancelled = $select_car_reservations->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_car_reservations_cancelled; ?></h3>
                <p class="card-text"><i class="fa fa-car"></i> Cancelled Reservations</p>
                <a href="staff_cancelled_car_reservations.php" class="btn">View Reservations</a>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>