<?php

@include 'config.php';

session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user_id === null) {
        $message[] = 'Please log in to place a Review.';
    } else {
        // database connection
        include 'config.php';
        $name = filter_var($_POST['name'] ?? '', FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $message_content = filter_var($_POST['message'] ?? '', FILTER_SANITIZE_STRING);
        $rating = intval($_POST['rating'] ?? 0);
        $image = '';

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = $_FILES['image']['name'];
            $imageSize = $_FILES['image']['size'];
            $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageExtension, $allowedExtensions) && $imageSize <= 2097152) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
                    $message[] = "Failed to create upload directory.";
                } else {
                    $imagePath = $uploadDir . time() . '_' . $imageName;
                    if (move_uploaded_file($imageTmpPath, $imagePath)) {
                        $image = $imagePath;
                    } else {
                        $message[] = "Failed to move uploaded file.";
                    }
                }
            } else {
                $message[] = "Invalid file extension or file size too large.";
            }
        }

        if (empty($message)) {
            try {
                $insert_message = $conn->prepare("INSERT INTO `rating` (`name`, `email`, `message`, `rating`, `image`) VALUES (:name, :email, :message, :rating, :image)");
                $insert_message->bindParam(':name', $name);
                $insert_message->bindParam(':email', $email);
                $insert_message->bindParam(':message', $message_content);
                $insert_message->bindParam(':rating', $rating);
                $insert_message->bindParam(':image', $image);
                $insert_message->execute();

                $message[] = "Review submitted successfully!";
            } catch (PDOException $e) {
                $message[] = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Review</title>
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
    <?php include 'header.php'; ?>
    <section class="contact">
        <h2 class="title">We'd love to hear from you!</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="text" name="name" class="box" placeholder="Your Name" required>
            <input type="email" name="email" class="box" placeholder="Your Email" required>
            <textarea name="message" class="box" placeholder="Your Message" required></textarea>
            <input type="number" class="reviews" name="rating" min="1" max="5" placeholder="Rating (1-5)" required>
            <label for="image">Profile picture</label>
            <input type="file" name="image" class="box" accept="image/*">
            <input type="submit" value="Submit" class="btn" name="send">
        </form>

    </section>

    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>