<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

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

      <h1 class="title">All Accounts</h1>

      <div class="box-container">

         <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
         ?>
            <div class="box" style="<?php if ($fetch_users['id'] == $admin_id) {
                                       echo '';
                                    }; ?>">
               <img src="uploaded_img/<?= $fetch_users['image']; ?>" alt="">
               <p> user id : <span><?= $fetch_users['id']; ?></span></p>
               <p> username : <span><?= $fetch_users['name']; ?></span></p>
               <p> email : <span><?= $fetch_users['email']; ?></span></p>
               <p> user type : <span style=" color:<?php if ($fetch_users['user_type'] == 'admin') {
                                                      echo 'orange';
                                                   }; ?>"><?= $fetch_users['user_type']; ?></span></p>

            </div>
         <?php
         }
         ?>
      </div>

   </section>













   <script src="js/script.js"></script>

</body>

</html>