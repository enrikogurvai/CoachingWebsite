<?php
session_start();
require_once 'database/db.php';
require_once 'models/pouzivatel.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Pouzivatel($db);
$akcia = $_GET['akcia'] ?? '';

if ($akcia == 'registracia') {
    $auth->zaregistrovat($_POST['meno'], $_POST['email'], $_POST['heslo']);
    header("Location: index.php?page=login&status=registered");
} 

if ($akcia == 'login') {
    if ($auth->prihlasit($_POST['email'], $_POST['heslo'])) {
        header("Location: index.php?page=home");
    } else {
        echo "Nesprávne údaje.";
    }
}
?>