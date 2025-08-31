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

<!-- HTML document starts here -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>about</title>

  <!-- FAVICON -->
  <link rel="icon" type="image/png" href="images/logo-big.png" />

  <!-- CSS files -->
  <link rel="stylesheet" href="css/about.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/fontawesome.min.css" />
  <link rel="stylesheet" href="css/style.css" />

</head>

<body>

  <!-- Include the header file -->
  <?php include 'header.php'; ?>

  <!-- Main content sections -->
  <section id="header">
    <div class="about-1">
      <h1>ABOUT US</h1>
      <h2>Welcome to THE GALLERY CAFE</h2>
      <p align="justify">
        <!-- About us paragraph -->
        At The Gallery Cafe, we believe that every meal should be a memorable experience. Our restaurant is located in the heart of Colombo,
        and our restaurant offers a warm and inviting atmosphere where friends and families can gather to
        enjoy delicious food and great company.
      </p>
      <br>
      <h2>Our Story</h2>
      <p>Founded in 1902, THE GALLERY CAFE was born out of a passion for culinary excellence and a desire to create a space where people can savor the simple joys of life. Our founders Mr. Bahubali and Mr. Katta Appa, have always believed that food is more than just sustenance—it's a way to bring people together and create lasting memories.</p>
      <br>
      <h2>Our commitment</h2>
      <p>At The Gallery Cafe, we are committed to sustainability and supporting local farmers and producers. We source our ingredients from nearby farms and markets, ensuring that every bite you take is not only delicious but also supports our community.</p>
    </div>

  </section>

  <div id="about-2">
    <div class="content-box-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="about-item text-center">
              <!-- Mission section -->
              <i class="fa fa-book"></i>
              <h3>MISSION</h3>
              <hr />
              <p>
                Our mission is to empower individuals and businesses by providing innovative, reliable, and user-friendly solutions that drive growth and efficiency. We are committed to excellence, integrity, and customer satisfaction, striving to deliver outstanding value and support in every interaction.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="about-item text-center">
              <!-- Vision section -->
              <i class="fa fa-eye"></i>
              <h3>VISION</h3>
              <hr />
              <p>

                Our vision is to be a global leader in our industry, recognized for our cutting-edge solutions, exceptional service, and positive impact on communities. We aim to inspire and innovate, setting new standards of excellence and fostering a culture of continuous improvement and sustainability.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="about-item text-center">
              <!-- Values section -->
              <i class="fa fa-heart"></i>
              <h3>VALUES</h3>
              <hr />
              <p>
                Our values are rooted in integrity, innovation, and excellence. We prioritize honesty and transparency in all our interactions, continually seek creative solutions to meet our clients' needs, and strive for the highest standards in quality and performance. We are dedicated to fostering a collaborative and inclusive environment where every team member can thrive and contribute to our shared success.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="about">
    <div class="row">
      <div class="box">
        <!-- Why choose us section -->
        <img src="images/about-1.png" alt="" />
        <h3>why choose us?</h3>
        <p>
          At THE GALLERY CAFE, we pride ourselves on delivering an exceptional dining experience that goes beyond just great food. Our commitment to using fresh, locally sourced ingredients ensures that every dish is bursting with flavor and quality. Our welcoming atmosphere and attentive service make you feel right at home, whether you're here for a casual meal or a special celebration. Join us at [Restaurant Name] and discover why our guests keep coming back for more!
        </p>
        <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
        <!-- What we provide section -->
        <img src="images/about-2.png" alt="" />
        <h3>what we provide?</h3>
        <p>
          At THE GALLERY CAFE, we offer a diverse menu filled with delicious, freshly prepared dishes that cater to all tastes. From hearty main courses to delectable desserts, our culinary creations are crafted with the finest ingredients. We also provide a cozy and inviting ambiance, perfect for any occasion. Whether you're dining in, taking out, or hosting a special event, we ensure a memorable experience with every visit.
        </p>
        <a href="menu.php" class="btn">Menu</a>
      </div>
    </div>
  </section>

  <!-- Include the footer file -->
  <?php include 'footer.php'; ?>

  <!-- JavaScript file -->
  <script src="js/script.js"></script>

</body>

</html>