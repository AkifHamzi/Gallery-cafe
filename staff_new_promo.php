<?php

@include 'config.php';

session_start();

$staff_id = $_SESSION['staff_id'] ?? null;
$admin_id = $_SESSION['admin_id'] ?? null;

if (!isset($staff_id) && !isset($admin_id)) {
   header('location:login.php');
   exit;
}

if (isset($_POST['add_event'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select_events = $conn->prepare("SELECT * FROM `events` WHERE name = ?");
   $select_events->execute([$name]);

   if ($select_events->rowCount() > 0) {
      $message[] = 'event name already exist!';
   } else {

      $insert_events = $conn->prepare("INSERT INTO `events`(name, category, details, image) VALUES(?,?,?,?)");
      $insert_events->execute([$name, $category, $details, $image]);

      if ($insert_events) {
         if ($image_size > 2000000) {
            $message[] = 'image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new event added!';
         }
      }
   }
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `events` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   $delete_events = $conn->prepare("DELETE FROM `events` WHERE id = ?");
   $delete_events->execute([$delete_id]);
   header('location:staff_events.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>events</title>

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

   <?php include 'staff_header.php'; ?>


   <section class="add-products">

      <h1 class="title">add new promotions & Events</h1>

      <form action="" method="POST" enctype="multipart/form-data">
         <div class="flex">

            <div class="inputBox">
               <input type="text" name="name" class="box" required placeholder="enter promo / event name">
            </div>

            <div class="inputBox">
               <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
            </div>
            <select name="category" class="box" required>
               <option value="" selected disabled>select category</option>
               <option value="promotion">Promotion</option>
               <option value="event">Event</option>
            </select>
         </div>
         <textarea name="details" class="box" required placeholder="enter promotion / event details" cols="30" rows="10"></textarea>

         <input type="submit" class="btn" value="add event/Promotion" name="add_event">
         <a href="staff_dashboard.php" class="option-btn">go back</a>
      </form>

   </section>


   <script src="js/script.js"></script>

</body>

</html>