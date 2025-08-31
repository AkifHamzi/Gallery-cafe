<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if ($rowCount > 0) {

      if ($row['user_type'] == 'admin') {

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      } elseif ($row['user_type'] == 'user') {

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      } elseif ($row['user_type'] == 'staff') {

         $_SESSION['staff_id'] = $row['id'];
         header('location:staff_dashboard.php');
      } else {
         $message[] = 'No user found!';
      }
   } else {
      $message[] = 'Incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

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


</head>

<body class="background">

   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '<div class="message"><span>' . $msg . '</span><i class="fas fa-times" onclick="this.parentElement.remove();"></i></div>';
      }
   }
   ?>

   <section class="form-container">

      <form action="" method="POST">
         <img src="images/logo_medium.png" alt="logo">
         <br>
         <h3>Login</h3>
         <input type="email" name="email" class="box" placeholder="enter your email..." required>
         <input type="password" name="pass" class="box" placeholder="enter your password..." required>
         <input type="submit" value="Login" class="btn" name="submit">
         <p>Don't have an account? <a href="register.php">register an account</a></p>
         <p><a href="home.php">Continue</a> without login</p>

      </form>

   </section>

</body>

</html>