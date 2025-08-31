<?php

if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
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

   <header class="header staff">

      <div class="flex">

         <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

         <!-- <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_new_products.php">Add</a>
         <a href="admin_total_accounts.php">Accounts</a>
         <a href="admin_contacts.php">Messages</a>
         <a href="admin_reviews.php">Reviews</a>
      </nav> -->

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <a href="logout.php"><i class="fa fa-sign-out-alt"></i></a>
         </div>

         <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <p><?= $fetch_profile['name']; ?></p>
            <a href="admin_update_profile.php" class="btn">update profile</a>
            <a href="staff_dashboard.php" class="btn">Staff Dashboard</a>
            <a href="logout.php" class="delete-btn">logout</a>
            <a href="admin_register.php" class="option-btn">staff / admin register</a>
            <!-- <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="admin_register.php" class="option-btn">register</a>
         </div> -->
         </div>

      </div>

   </header>