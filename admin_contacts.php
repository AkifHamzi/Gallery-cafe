<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

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

   <section class="messages">

      <h1 class="title">messages</h1>

      <div class="box-container">

         <?php
         $select_message = $conn->prepare("SELECT * FROM `message`");
         $select_message->execute();
         if ($select_message->rowCount() > 0) {
            while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> user id : <span><?= $fetch_message['user_id']; ?></span> </p>
                  <p> name : <span><?= $fetch_message['name']; ?></span> </p>
                  <p> number : <span><?= $fetch_message['number']; ?></span> </p>
                  <p> email : <span><?= $fetch_message['email']; ?></span> </p>
                  <p> message : <span><?= $fetch_message['message']; ?></span> </p>
                  <a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">you have no messages!</p>';
         }
         ?>

      </div>

   </section>













   <script src="js/script.js"></script>

</body>

</html>