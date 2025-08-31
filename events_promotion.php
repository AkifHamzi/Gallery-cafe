<?php

@include 'config.php';

session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Events & Promotions</title>

   <!-- FAVICON -->
   <link rel="icon" type="image/png" href="images/logo-big.png" />




   <!-- Font Awesome CSS -->
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

   <!-- Slideshow Container -->

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
            <img src="images/promotionlabourday.png" class="d-block w-100" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
               <h5>100th visit promotion</h5>
               <p>Some representative placeholder content for the first slide.</p>
            </div>
         </div>
         <div class="carousel-item">
            <img src="images/kidsDinner.png" class="d-block w-100" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
               <h5>Kids under 5 eat for 50% off</h5>
               <p>Some representative placeholder content for the second slide.</p>
            </div>
         </div>
         <div class="carousel-item">
            <img src="images/games.png" class="d-block w-100" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
               <h5>Fridays Game night</h5>
               <p>Some representative placeholder content for the third slide.</p>
            </div>
         </div>
         <div class="carousel-item">
            <img src="images/promotiondate.jpg" class="d-block w-100" alt="fourth slide">
            <div class="carousel-caption d-none d-md-block">
               <h5>Post and win free meal</h5>
               <p>Some representative placeholder content for the third slide.</p>
            </div>
         </div>
         <div class="carousel-item">
            <img src="images/other_foods.png" class="d-block w-100" alt="fifth slide">
            <div class="carousel-caption d-none d-md-block">
               <h5>Eat all you can hour</h5>
               <p>Some representative placeholder content for the third slide.</p>
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





   <!-- COVER -->
   <div class="home">
      <section class="events-promotions home-category">
         <h1 class="title">Events & Promotions</h1>

         <div class="swiper-container">
            <div class="swiper-wrapper">

               <!-- Events -->
               <div class="swiper-slide">
                  <div class="box-container">
                     <?php
                     try {
                        $select_events = $conn->prepare("SELECT * FROM `events` WHERE category = 'event'");
                        $select_events->execute();
                        if ($select_events->rowCount() > 0) {
                           while ($fetch_events = $select_events->fetch(PDO::FETCH_ASSOC)) {
                     ?>
                              <div class="box">
                                 <img src="uploaded_img/<?= ($fetch_events['image']); ?>" alt="">
                                 <h3><?= ($fetch_events['name']); ?></h3>
                                 <p><?= ($fetch_events['details']); ?></p>
                              </div>
                     <?php
                           }
                        } else {
                           echo '<p class="empty">No events added yet!</p>';
                        }
                     } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                     }
                     ?>
                  </div>
               </div>

               <!-- Promotions -->
               <div class="swiper-slide">
                  <div class="box-container">
                     <?php
                     try {
                        $select_promotions = $conn->prepare("SELECT * FROM `events` WHERE category = 'promotion'");
                        $select_promotions->execute();
                        if ($select_promotions->rowCount() > 0) {
                           while ($fetch_promotions = $select_promotions->fetch(PDO::FETCH_ASSOC)) {
                     ?>
                              <div class="box">
                                 <img src="uploaded_img/<?= ($fetch_promotions['image']); ?>" alt="">
                                 <h3><?= ($fetch_promotions['name']); ?></h3>
                                 <p><?= ($fetch_promotions['details']); ?></p>
                              </div>
                     <?php
                           }
                        } else {
                           echo '<p class="empty">No promotions added yet!</p>';
                        }
                     } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                     }
                     ?>
                  </div>
               </div>

            </div>
            <div class="swiper-pagination"></div>
         </div>
      </section>
   </div>
   <br><br>

   <?php include 'footer.php'; ?>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   <script src="js/script.js"></script>
   <script>
      $(document).ready(function() {
         $('#carouselExample').carousel({
            interval: 2500,
            wrap: true,
            keyboard: true
         });
      });
   </script>


</body>

</html>