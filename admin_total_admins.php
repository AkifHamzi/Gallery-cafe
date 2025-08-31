<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit; // Ensure script stops after redirection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>

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

   <section class="user-accounts">

      <h1 class="title">Admins and Staff List</h1>

      <div class="box-container">
         <!-- Admins -->
         <h2 class="subtitle">Admins Accounts</h2>
         <?php
         $select_admins = $conn->prepare("SELECT * FROM `users` WHERE `user_type` = 'admin'");
         $select_admins->execute();
         while ($fetch_admins = $select_admins->fetch(PDO::FETCH_ASSOC)) {
         ?>
            <div class="box">
               <img src="uploaded_img/<?= $fetch_admins['image']; ?>" alt="">
               <p>User ID: <span><?= $fetch_admins['id']; ?></span></p>
               <p>Username: <span><?= $fetch_admins['name']; ?></span></p>
               <p>Email: <span><?= $fetch_admins['email']; ?></span></p>
               <p>User Type: <span style="color: orange;">Admin</span></p>

            </div>
         <?php
         }
         ?>
         <br>
         <!-- Staff -->
         <h2 class="subtitle">Staff Accounts</h2>
         <?php
         $select_staff = $conn->prepare("SELECT * FROM `users` WHERE `user_type` = 'staff'");
         $select_staff->execute();
         while ($fetch_staff = $select_staff->fetch(PDO::FETCH_ASSOC)) {
         ?>
            <div class="box">
               <img src="uploaded_img/<?= $fetch_staff['image']; ?>" alt="">
               <p>User ID: <span><?= $fetch_staff['id']; ?></span></p>
               <p>Username: <span><?= $fetch_staff['name']; ?></span></p>
               <p>Email: <span><?= $fetch_staff['email']; ?></span></p>
               <p>User Type: <span>Staff</span></p>

            </div>
         <?php
         }
         ?>
      </div>

   </section>

   <script src="js/script.js"></script>

</body>

</html>