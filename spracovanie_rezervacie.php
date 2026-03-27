<?php
require_once 'database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $meno = htmlspecialchars(trim($_POST['meno']));
    $email = htmlspecialchars(trim($_POST['email']));
    $discord = htmlspecialchars(trim($_POST['discord']));
    $trener = htmlspecialchars(trim($_POST['trener']));
    $sprava = htmlspecialchars(trim($_POST['sprava']));

    try {
        $sql = "INSERT INTO rezervacie (meno,email, discord, trener, sprava) VALUES (:meno,:email, :discord, :trener, :sprava)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':meno' => $meno,
            ':email' => $email,
            ':discord' => $discord,
            ':trener' => $trener,
            ':sprava' => $sprava
        ]);

        $admin_email = "enriko.gurvai@gmail.com";
        $subject = "Nová žiadosť o trenering od: $meno";
        $email_body = "Dostal si novú žiadosť o trenering!\n\n"
                    . "Meno: $meno\n"
                    . "Discord: $discord \n"
                    . "Tréner: . $trener . \n"
                    . "Správa: \n$sprava\n";
        
        $headers = "From: noreply@goatcoaching.sk";

        mail($admin_email, $subject, $email_body, $headers);

        if ($email) {
            $subject_user = "Tvoja žiadosť o GOAT Coaching bola prijatá!";
            $body_user = "Ahoj $meno, tvoja žiadosť pre coacha " . ucfirst($coach) . " bola úspešne odoslaná. Coach ťa bude čoskoro kontaktovať na Discorde ($discord).";
            mail($user_email, $subject_user, $body_user, $headers);
        }

        header("Location: index.php?page=booking&status=success");
        exit();

    } catch (PDOException $e) {
        die("Nastala chyba pri ukladaní rezervácie: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>