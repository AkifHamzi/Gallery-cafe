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
        $message[] = 'Please log in to place a Resevation.';
    } else {
        // database connection
        include 'config.php';

        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $date = $_POST['date'];
        $time = $_POST['time'];
        $special_requests = filter_var($_POST['special_requests'], FILTER_SANITIZE_STRING);
        $table_capacity = filter_var($_POST['table_capacity'], FILTER_VALIDATE_INT);

        $errors = [];
        if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($table_capacity)) {
            $errors[] = 'All fields are required!';
        }

        if (empty($errors)) {
            try {

                $sql_insert_reservation = "INSERT INTO reservations 
                                       (user_id, name, email, phone, reservation_date, reservation_time, special_requests, table_capacity, reservation_status)
                                       VALUES (:user_id, :name, :email, :phone, :date, :time, :special_requests, :table_capacity, 'pending')";
                $stmt_insert_reservation = $conn->prepare($sql_insert_reservation);
                $stmt_insert_reservation->bindParam(':user_id', $user_id);
                $stmt_insert_reservation->bindParam(':name', $name);
                $stmt_insert_reservation->bindParam(':email', $email);
                $stmt_insert_reservation->bindParam(':phone', $phone);
                $stmt_insert_reservation->bindParam(':date', $date);
                $stmt_insert_reservation->bindParam(':time', $time);
                $stmt_insert_reservation->bindParam(':special_requests', $special_requests);
                $stmt_insert_reservation->bindParam(':table_capacity', $table_capacity, PDO::PARAM_INT);

                if ($stmt_insert_reservation->execute()) {
                    $message[] = 'Reservation successfully submitted!';
                } else {
                    $message[] = 'Error submitting reservation: ' . implode(" ", $stmt_insert_reservation->errorInfo());
                }
            } catch (PDOException $e) {
                $message[] = 'Database error: ' . $e->getMessage();
            }
        } else {

            $message = array_merge($message, $errors);
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
    <title>Table Reservation</title>

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
    <link rel="stylesheet" href="css/res.css">

</head>

<body>

    <?php include 'header.php'; ?>


    <h1 class="title">Reserve a table</h1>

    <section class="reservation">
        <div class="row">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="name" class="box" placeholder="Your Name" required>
                <input type="email" name="email" class="box" placeholder="Your Email" required>
                <input type="tel" name="phone" class="box" placeholder="Your Phone Number" required>
                <label for="date">
                    <h2>Date</h2>
                </label>
                <input type="date" name="date" class="box" placeholder="Reservation Date" required>
                <label for="time">
                    <h2>Time</h2>
                </label>
                <input type="time" name="time" class="box" placeholder="Reservation Time" required>
                <label for="table_capacity">
                    <h2>Table Capacity</h2>
                </label>
                <select name="table_capacity" class="box" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>

                </select>
                <textarea name="special_requests" class="box" placeholder="Special Requests" rows="4"></textarea>

                <input type="submit" name="submit_reservation" value="Submit Reservation" class="btn">
                <label for=""></label>

                <label for="car_parking">
                    <h2>If you want to reserve a parking spot as well, go to </h2>
                </label>
                <a href="Car_reservation.php" class="secondary-btn">Parking Reservation</a>
            </form>
        </div>
    </section>

    <br><br><br>

    <?php include 'footer.php'; ?>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>