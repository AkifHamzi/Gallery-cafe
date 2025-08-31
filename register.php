<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

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

   $message = [];

   if (isset($_POST['submit'])) {

      include 'config.php';

      // Sanitize input data
      $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $pass = md5($_POST['pass']);
      $cpass = md5($_POST['cpass']);
      $image = filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING);
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'uploaded_img/' . $image;


      $select = $conn->prepare("SELECT * FROM users WHERE email = ?");
      $select->execute([$email]);

      if ($select->rowCount() > 0) {
         $message[] = 'User email already exists!';
      } else {
         if ($pass != $cpass) {
            $message[] = 'Confirm password not matched!';
         } else {

            $insert = $conn->prepare("INSERT INTO users(name, email, password, image) VALUES(?,?,?,?)");
            $insert->execute([$name, $email, $pass, $image]);

            if ($insert) {
               if ($image_size > 2000000) {
                  $message[] = 'Image size is too large!';
               } else {
                  move_uploaded_file($image_tmp_name, $image_folder);
                  $message[] = 'Registered successfully!';
                  header('location:login.php');
                  exit;
               }
            } else {
               $message[] = 'Registration failed! Please try again.';
            }
         }
      }
   }

   ?>

   <section class="form-container">

      <form action="" enctype="multipart/form-data" method="POST">
         <img src="images/logo_medium.png" alt="logo">
         <br>
         <h3>Create an account</h3>
         <input type="text" name="name" class="box" placeholder="enter your name..." required>
         <input type="email" name="email" class="box" placeholder="enter your email..." required>
         <input type="password" name="pass" class="box" minlength="5" placeholder="enter your password..." required>
         <input type="password" name="cpass" class="box" minlength="5" placeholder="confirm your password..." required>
         <label for="image">Profile picture</label>
         <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
         <input type="submit" value="Register" class="btn" name="submit">
         <p class="account">Already have an account? <a href="login.php">Login</a></p>
         <p class="account"><a href="home.php">Continue</a> without register</p>
      </form>

      <?php

      if (isset($message)) {
         foreach ($message as $msg) {
            echo '
         <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
         }
      }
      ?>

   </section>

</body>

</html>