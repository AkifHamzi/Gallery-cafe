<?php

@include 'config.php';

session_start();

// user logged in?
if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = null;
}


if (isset($_POST['add_to_cart'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_cart_numbers->rowCount() > 0) {
      $message[] = 'already added to cart!';
   } else {

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if ($check_wishlist_numbers->rowCount() > 0) {
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

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

<body>

   <!-- COVER -->

   <?php include 'header.php'; ?>

   <div class="home-bg">


      <div id="carouselExample" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExample" data-slide-to="1"></li>
            <li data-target="#carouselExample" data-slide-to="2"></li>
            <li data-target="#carouselExample" data-slide-to="3"></li>
            <li data-target="#carouselExample" data-slide-to="4"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="images/spices.jpg" class="d-block w-100" alt="First slide">
               <div class="carousel-caption d-none d-md-block">
                  <h5> Welcome to <span>THE GALLERY CAFE </span></h5>
                  <p>We are delighted to have you here at The Gallery Cafe, where every meal is a masterpiece. Nestled in the heart of Colombo, our cafe offers a warm and inviting atmosphere for friends, families, and food enthusiasts alike. Whether you're here to enjoy our delicious cuisine, relax with a cup of coffee, or celebrate a special occasion, we strive to make every visit memorable. Welcome to a place where culinary artistry meets heartfelt hospitality</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/frying.jpg" class="d-block w-100" alt="Second slide">
               <div class="carousel-caption d-none d-md-block">
                  <h5>Masterful Cooking</h5>
                  <p>Watch our skilled chef in action, creating culinary masterpieces with passion and precision. This is where the magic happens, bringing you the finest in gourmet cuisine.</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/italian/pizza.jpg" class="d-block w-100" alt="Third slide">
               <div class="carousel-caption d-none d-md-block">
                  <h5>Perfect Pizza</h5>
                  <p>Indulge in our mouthwatering pizza, topped with the freshest ingredients and baked to golden perfection. A true feast for the senses that promises to satisfy your cravings.</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/srilankan/dolphin.jpeg" class="d-block w-100" alt="fourth slide">
               <div class="carousel-caption d-none d-md-block">
                  <h5>Dolphin Kotthu Extravaganza</h5>
                  <p>Dive into the unique taste of our Dolphin Kotthu, a flavorful fusion of fresh ingredients and spices, crafted to deliver a memorable dining experience.</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/srilankan/kotthu.jpg" class="d-block w-100" alt="fifth slide">
               <div class="carousel-caption d-none d-md-block">
                  <h5>Kotthu</h5>
                  <p>Witness the enchanting dance of spices in the air, capturing the essence of our kitchen's aromatic and flavorful creations. Each spice tells a story, adding depth to every dish.</p>
               </div>
            </div>
         </div>
         <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
   </div>

   <section class="home-category">

      <h1 class="title">Services we offer</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/reserve.png" alt="Reservation">

            <p>Secure your spot with ease. Choose your date and time, and we'll handle the rest. We can't wait to serve you!</p>
            <a href="Reservation.php" class="btn">Reservation</a>
         </div>

         <div class="box">
            <img src="images/preorder.png" alt="Pre Orders">

            <p>Choose your favorite dishes in advance and have them ready when you arrive. Enjoy a hassle free dining experience</p>
            <a href="menu.php" class="btn">Pre Orders</a>
         </div>

         <div class="box">
            <img  src="images/events.png" alt="Events">

            <p> Join the the weekly events held at THE GALLERY CAFE and win great offers and deals to celebrate your special day.</p>
            <a href="events_promotion.php" class="btn">Events</a>
         </div>

         <div class="box">
            <img src="images/promotions.png" alt=" PRomotions">

            <p>Keep your eyes peeled for exclusive promotions and discounts.</p>
            <a href="events_promotion.php" class="btn">Promotions</a>
         </div>

      </div>

   </section>

   <!-- CATEGORIES -->

   <section class="home-category">

      <h1 class="title">Cuisines</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/Srilankan/srilankan-cuisine.jpg" alt="Sri lankan cuisine">
            <h3>Sri Lankan</h3>
            <p>Savor the rich, bold flavors of Sri Lankan cuisine, featuring aromatic spices, coconut milk, and fresh ingredients in every dish.</p>
            <a href="category.php?category=SriLankan" class="btn">Sri Lankan</a>
         </div>

         <div class="box">
            <img src="images/indian/indian-cuisine.jpg" alt="Indian cuisine">
            <h3>Indian</h3>
            <p>Enjoy the vibrant and diverse tastes of India, from savory curries to delectable tandoori, each meal a feast for the senses.</p>
            <a href="category.php?category=Indian" class="btn">Indian</a>
         </div>

         <div class="box">
            <img src="images/Italian/italian_cuisine.jpg" alt="Italian cuisine">
            <h3>Italian</h3>
            <p>Indulge in the classic tastes of Italy with our authentic pasta, pizza, and more, crafted with the finest ingredients and traditional recipes.</p>
            <a href="category.php?category=Italian" class="btn">Italian</a>
         </div>

         <div class="box">
            <img src="images/arabic/arabic_cuisine.jpg" alt="Arabic cuisine">
            <h3>Arabic</h3>
            <p>Experience the rich culinary heritage of Arabic cuisine, with flavorful dishes that combine fragrant spices, tender meats, and fresh vegetables.</p>
            <a href="category.php?category=Arabic" class="btn">Arabic</a>
         </div>

      </div>

   </section>

   <!-- PRODUCTS -->

   <section class="products">

      <h1 class="title">latest products</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" class="box" method="POST">
                  <div class="price">Rs.<span><?= $fetch_products['price']; ?></span>/-</div>
                  <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">

               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

   </section>


   <!-- REVIEWS -->

   <section class="reviews">

      <h1 class="title">Testimonials</h1>
      <p class="sub-title">Dont just take our word for it.</p>
      <div class="box-container">
         <?php
         $select_message = $conn->prepare("SELECT * FROM `rating` ORDER BY id DESC LIMIT 4");
         $select_message->execute();
         if ($select_message->rowCount() > 0) {
            while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">



                  <?php if ($fetch_message['image']) : ?>


                     <p><img src="<?= htmlspecialchars($fetch_message['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Review Image" style="max-width: 100px; max-height: 100px;"><br><span><?= htmlspecialchars($fetch_message['name'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                     <p>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                           echo '<i class="' . ($i <= $fetch_message['rating'] ? 'fas' : 'far') . ' fa-star"></i>';
                        }
                        ?>
                     </p>
                     <p><span><?= htmlspecialchars($fetch_message['message'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                  <?php endif; ?>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No reviews yet!</p>';
         }
         ?>
      </div>

   </section>

   <?php include 'footer.php'; ?>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   <script src="js/script.js"></script>
   <script>
      $(document).ready(function() {
         $('#carouselExample').carousel({
            interval: 2700,
            wrap: true,
            keyboard: true
         });
      });
   </script>

</body>

</html>