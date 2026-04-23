<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'SMTP/PHPMailer/src/Exception.php';
require 'SMTP/PHPMailer/src/PHPMailer.php';
require 'SMTP/PHPMailer/src/SMTP.php';

class Booking {

    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function create($data) {
        $meno = htmlspecialchars(trim($data['meno']));
        $email = htmlspecialchars(trim($data['email']));
        $discord = htmlspecialchars(trim($data['discord']));
        $trener = htmlspecialchars(trim($data['trener']));
        $sprava = htmlspecialchars(trim($data['sprava']));

        try {
            $sql = "INSERT INTO rezervacie (meno, email, discord, trener, sprava) VALUES (:meno, :email, :discord, :trener, :sprava)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':meno' => $meno,
                ':email' => $email,
                ':discord' => $discord,
                ':trener' => $trener,
                ':sprava' => $sprava
            ]);

            //$this->sendEmails($meno, $email, $discord, $trener, $sprava);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>