<?php
require_once 'database/db.php';
require_once 'models/booking.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    
    $booking = new Booking($db);
    $result = $booking->create($_POST);

    if ($result === true) {
        header("Location: index.php?page=rezervacie&status=success");
    } else {
        echo("Nastala chyba: " . $result);
    }
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>