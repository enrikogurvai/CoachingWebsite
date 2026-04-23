<?php
class Pouzivatel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function zaregistrovat($meno, $email, $heslo) {
        $hash = password_hash($heslo, PASSWORD_DEFAULT);
        $sql = "INSERT INTO pouzivatelia (meno, email, heslo) VALUES (?, ?, ?)";
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$meno, $email, $hash]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function prihlasit($email, $heslo) {
        $sql = "SELECT * FROM pouzivatelia WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($u && password_verify($heslo, $u['heslo'])) {
            $_SESSION['pouzivatel_id'] = $u['id'];
            $_SESSION['meno'] = $u['meno'];
            $_SESSION['rola'] = $u['rola'];
            $_SESSION['body'] = $u['body'];
            return true;
        }
        return false;
    }
}
?>