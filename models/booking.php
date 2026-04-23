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
    $pouzivatel_id = $_SESSION['pouzivatel_id'] ?? null;
    
    $meno_hosta = !$pouzivatel_id ? htmlspecialchars(trim($data['meno'])) : null;
    
    $email = htmlspecialchars(trim($data['email']));
    $discord = htmlspecialchars(trim($data['discord']));
    $trener_id = intval($data['trener_id']); 
    $sprava = htmlspecialchars(trim($data['sprava']));

        try {
            $sql = "INSERT INTO rezervacie (pouzivatel_id, trener_id, meno_hosta, email, discord, sprava, status) 
                    VALUES (:p_id, :t_id, :m_host, :email, :discord, :sprava, 'nova')";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':p_id' => $pouzivatel_id,
                ':t_id' => $trener_id,
                ':m_host' => $meno_hosta,
                ':email' => $email,
                ':discord' => $discord,
                ':sprava' => $sprava
            ]);

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>