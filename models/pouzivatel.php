<?php
class Pouzivatel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function zaregistrovat($meno, $email, $heslo) {
    $query = "SELECT id FROM pouzivatelia WHERE email = ? LIMIT 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        return "email_exists";
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $heslo)) {
        return "weak_password";
    }

    $hashed_password = password_hash($heslo, PASSWORD_BCRYPT);
    $query_insert = "INSERT INTO pouzivatelia (meno, email, heslo, rola) VALUES (?, ?, ?, 'user')";
    $stmt_insert = $this->db->prepare($query_insert);
    
    if ($stmt_insert->execute([$meno, $email, $hashed_password])) {
        return true;
    }
    
    return "db_error";
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