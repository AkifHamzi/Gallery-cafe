<?php


$user_id = $_SESSION['user_id'] ?? null;


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

<header class="header">

   <div class="flex">

      <a href="home.php" class="logo">
         <img src="images/logo_small.png" alt="logo">
      </a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="menu.php">Menu</a>
         <a href="reservation.php">Reservation</a>
         <a href="about.php">About</a>
         <a href="contact.php">Contact</a>
         <a href="review.php">Reviews</a>

         <?php if (isset($user_id)) : ?>
            <a href="orders.php">Orders</a>
         <?php endif; ?>
      </nav>

      <div class="icons">
         <a href="search_page.php" class="fas fa-search"></a>
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         ?>
         <?php if (isset($user_id)) : ?>
            <a href="cart.php" class="fas fa-basket-shopping"><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
         <?php endif; ?>
      </div>

      <?php if (isset($user_id)) : ?>
         <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <p><?= $fetch_profile['name']; ?></p>
            <a href="user_profile_update.php" class="btn">update profile</a>
            <a href="orders.php" class="btn">Orders</a>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      <?php else : ?>
         <div class="profile">
            <div class="login-register">
               <a href="login.php" class="btn">Login</a>
               <a href="register.php" class="option-btn">Register</a>
            </div>
         </div>
      <?php endif; ?>

   </div>

</header>