<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>GOAT Coaching</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/auth.css"> 
</head>
<body>

<nav class="navbar">
    <div class="logo-container">
        <img src="assets/images/logo.png" class="logo-img">
        <div class="logo">Coaching</div>
    </div>
    
    <ul class="nav-links">
        <li><a href="index.php?page=home">Domov</a></li>
        <li><a href="index.php?page=coaching">Trenéri</a></li>
        <li><a href="index.php?page=rezervacie">Formulár</a></li>
        <!-- <li><a href="index.php?page=tierlist">Tierlist</a></li> --> 

        <?php if (isset($_SESSION['pouzivatel_id'])): ?>
            
            <?php if ($_SESSION['rola'] === 'admin'): ?>
                <li><a href="index.php?page=admin_treneri" class="nav-admin">Admin Panel</a></li>
            
            <?php elseif ($_SESSION['rola'] === 'trener'): ?>
                <li><a href="index.php?page=trener_dashboard" class="nav-trener">Moje Objednávky</a></li>
            <?php endif; ?>

            <?php if ($_SESSION['rola'] === 'user'): ?>
                <li><span class="user-points">Body: <?= $_SESSION['body'] ?? 0 ?></span></li>
            <?php endif; ?>

            <li><a href="logout.php" class="nav-logout">Odhlásiť (<?= htmlspecialchars($_SESSION['meno']) ?>)</a></li>
            
        <?php else: ?>
            <li><a href="index.php?page=login">Prihlásiť</a></li>
            <li><a href="index.php?page=registracia">Registrácia</a></li>
        <?php endif; ?>
    </ul>
</nav>