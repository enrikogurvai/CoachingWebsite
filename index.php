<?php
session_start();
require_once 'database/db.php';
require_once 'route/router.php';

$page = $_GET['page'] ?? 'home';

$router = new Router();
$router->renderPage($page);
?>