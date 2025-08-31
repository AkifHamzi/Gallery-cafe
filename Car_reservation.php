<?php

@include 'config.php';

session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}

if (isset($_POST['submit_reservation'])) {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $vehicle_no = filter_var($_POST['vehicle_no'], FILTER_SANITIZE_STRING);
    $vehicle_type = filter_var($_POST['vehicle_type'], FILTER_SANITIZE_STRING);
    $check_in_time = $_POST['check_in_time'];
    $check_out_time = $_POST['check_out_time'];
    $entry_date = $_POST['entry_date'];
    $exit_date = $_POST['exit_date'];

    $errors = [];
    if (empty($name) || empty($email) || empty($phone) || empty($vehicle_no) || empty($vehicle_type) || empty($check_in_time) || empty($check_out_time) || empty($entry_date) || empty($exit_date)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors)) {
        try {
            $sql_insert_reservation = "INSERT INTO car_reservations 
                                       (name, email, phone, vehicle_no, vehicle_type, check_in_time, check_out_time, entry_date, exit_date, reservation_status)
                                       VALUES (:name, :email, :phone, :vehicle_no, :vehicle_type, :check_in_time, :check_out_time, :entry_date, :exit_date, 'pending')";
            $stmt_insert_reservation = $conn->prepare($sql_insert_reservation);
            $stmt_insert_reservation->bindParam(':name', $name);
            $stmt_insert_reservation->bindParam(':email', $email);
            $stmt_insert_reservation->bindParam(':phone', $phone);
            $stmt_insert_reservation->bindParam(':vehicle_no', $vehicle_no);
            $stmt_insert_reservation->bindParam(':vehicle_type', $vehicle_type);
            $stmt_insert_reservation->bindParam(':check_in_time', $check_in_time);
            $stmt_insert_reservation->bindParam(':check_out_time', $check_out_time);
            $stmt_insert_reservation->bindParam(':entry_date', $entry_date);
            $stmt_insert_reservation->bindParam(':exit_date', $exit_date);

            if ($stmt_insert_reservation->execute()) {
                $message[] = 'Car reservation successfully submitted!';
            } else {
                $message[] = 'Error submitting car reservation: ' . implode(" ", $stmt_insert_reservation->errorInfo());
            }
        } catch (PDOException $e) {
            $message[] = 'Database error: ' . $e->getMessage();
        }
    } else {
        $message = array_merge($message, $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Reservation </title>

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
    <br><br>

    <h1 class="title">Reserve a parking spot</h1>

    <section class="reservation">
        <div class="row">

            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="name" class="box" placeholder="Your Name" required>
                <input type="email" name="email" class="box" placeholder="Your Email" required>
                <input type="tel" name="phone" class="box" placeholder="Your Phone Number" required>
                <input type="text" name="vehicle_no" class="box" placeholder="Vehicle Number" required>
                <label for="vehicle_type">
                    <h2>Vehicle Type</h2>
                </label>
                <select name="vehicle_type" class="box" required>
                    <option value="Car">Car</option>
                    <option value="Van">Van</option>
                    <option value="Jeep">Jeep</option>
                    <option value="Other">Other</option>
                </select>
                <label for="check_ib_time">
                    <h2>Check-in Time</h2>
                </label>
                <input type="time" name="check_in_time" class="box" placeholder="Check-in Time" required>
                <label for="check_out_time">
                    <h2>Check-out Time</h2>
                </label>
                <input type="time" name="check_out_time" class="box" placeholder="Check-out Time" required>
                <label for="entry_date">
                    <h2>Entry Date</h2>
                </label>
                <input type="date" name="entry_date" class="box" placeholder="Entry Date" required>
                <label for="exit_date">
                    <h2>Exit Date</h2>
                </label>
                <input type="date" name="exit_date" class="box" placeholder="Exit Date" required>
                <input type="submit" name="submit_reservation" value="Submit Reservation" class="btn">
            </form>
        </div>
    </section>

    <br><br><br>

    <?php include 'footer.php'; ?>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>