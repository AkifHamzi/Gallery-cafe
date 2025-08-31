<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="images/logo-big.png" />


    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/fontawesome.min.css" />

    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="dashboard">
        <h1 class="title">Admin Dashboard</h1>
    </section>

    <section class="dashboard">
        <h2 class="min-title">Product List</h2>
        <div class="box-container">

            <div class="box">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                $number_of_products = $select_products->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_products; ?></h3>
                <p class="card-text"><i class="fa fa-box"></i> Add New Product</p>
                <a href="admin_new_products.php" class="btn">Add a product</a>
            </div>

            <div class="box">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                $number_of_products = $select_products->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_products; ?></h3>
                <p class="card-text"><i class="fa fa-box"></i> Total Products</p>
                <a href="admin_products.php" class="btn">View all Products</a>
            </div>

        </div>
    </section>


    <section class="dashboard">
        <h2 class="min-title">Message and Reviews</h2>
        <div class="box-container">
            <div class="box">
                <?php
                $select_messages = $conn->prepare("SELECT * FROM `message`");
                $select_messages->execute();
                $number_of_messages = $select_messages->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_messages; ?></h3>
                <p class="card-text"><i class="fa fa-envelope"></i> Total Messages</p>
                <a href="admin_contacts.php" class="btn">View all Messages</a>
            </div>

            <div class="box">
                <?php
                $select_messages = $conn->prepare("SELECT * FROM `rating`");
                $select_messages->execute();
                $number_of_messages = $select_messages->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_messages; ?></h3>
                <p class="card-text "><i class="fa fa-star"></i> Total Reviews</p>
                <a href="admin_reviews.php" class="btn">View all Reviews</a>
            </div>

        </div>
    </section>

    <section class="dashboard">
        <h2 class="min-title">Users and Admins</h2>
        <div class="box-container">
            <div class="box">
                <?php
                $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
                $select_users->execute(['user']);
                $number_of_users = $select_users->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_users; ?></h3>
                <p class="card-text"><i class="fa fa-users"></i> Total Users</p>
                <a href="admin_users.php" class="btn">See Accounts</a>
            </div>

            <div class="box">
                <?php
                $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
                $select_admins->execute(['admin']);
                $number_of_admins = $select_admins->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_admins; ?></h3>
                <p class="card-text"><i class="fa fa-users"></i> Total Admins</p>
                <a href="admin_total_admins.php" class="btn">See Accounts</a>
            </div>

            <div class="box">
                <?php
                $select_accounts = $conn->prepare("SELECT * FROM `users`");
                $select_accounts->execute();
                $number_of_accounts = $select_accounts->rowCount();
                ?>
                <h3 class="card-title"><?= $number_of_accounts; ?></h3>
                <p class="card-text"><i class="fa fa-users"></i> Total Accounts</p>
                <a href="admin_total_accounts.php" class="btn">See Accounts</a>
            </div>
        </div>
    </section>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>