<?php

@include 'config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit;
};

$user_id = $_SESSION['user_id']; 


if (isset($_POST['send'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if ($select_message->rowCount() > 0) {
      $message[] = 'already sent message!';
   } else {

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- FAVICON -->
   <link rel="icon" type="image/png" href="images/images/logo-big.png" />

   <!-- CSS -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="css/all.min.css" />
   <link rel="stylesheet" href="css/fontawesome.min.css" />
   <link rel="stylesheet" href="css/style.css" />
</head>

<body>

<?php include 'header.php'; ?>

   <section class="contact">

      <h1 class="title">get in touch</h1>

      <form action="" method="POST">
         <input type="text" name="name" class="box" required placeholder="enter your name">
         <input type="email" name="email" class="box" required placeholder="enter your email">
         <input type="number" name="number" min="0" class="box" required placeholder="enter your number">
         <textarea name="msg" class="box" required placeholder="enter your message" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" class="btn" name="send">
      </form>

   </section>



   <section class="location">
      <h1>Our location</h1>

      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15843.726643750857!2d79.8548722!3d6.898777!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259602cb3bc09%3A0x677419394138f674!2sThe%20Gallery%20Caf%C3%A9!5e0!3m2!1sen!2slk!4v1722142836369!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </section>


   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>