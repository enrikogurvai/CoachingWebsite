<?php
session_start();
require_once 'database/db.php';
require_once 'models/pouzivatel.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Pouzivatel($db);
$akcia = $_GET['akcia'] ?? '';

if ($akcia == 'registracia') {
    $vysledok = $auth->zaregistrovat($_POST['meno'], $_POST['email'], $_POST['heslo']);
    
    if ($vysledok === true) {
        header("Location: index.php?page=login&status=registered");
        exit();
    } else if ($vysledok === "email_exists") {
        header("Location: index.php?page=registracia&error=email_exists");
        exit();
    } else if ($vysledok === "weak_password") {
        header("Location: index.php?page=registracia&error=weak_password");
        exit();
    } else {
        header("Location: index.php?page=registracia&error=db_error");
        exit();
    }
} 

if ($akcia == 'login') {
    if ($auth->prihlasit($_POST['email'], $_POST['heslo'])) {
        header("Location: index.php?page=home");
        exit();
    } else {
        header("Location: index.php?page=login&error=invalid_credentials");
        exit();
    }
}
?>