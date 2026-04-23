<link rel="stylesheet" href="assets/css/coaching.css">

<?php
$database = new Database();
$db = $database->getConnection();
$query = "SELECT * FROM treneri";
$stmt = $db->query($query);
$vsetci_treneri = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="coaching-section">
    <h1>Prezri si náš výber trenérov</h1>
    <div class="coaches-container">
        <?php foreach ($vsetci_treneri as $t): ?>
            <div class="coach-card <?= ($t['hra'] === 'TFT') ? 'coach-card-tft' : '' ?>">
                <img src="<?= htmlspecialchars($t['pozadie_img']) ?>" alt="background">
                <div class="coach-info">
                    <h2>[<?= $t['hra'] ?>] <?= htmlspecialchars($t['meno']) ?></h2>
                    <h3>Rank</h3>
                    <img src="<?= htmlspecialchars($t['rank_ikona']) ?>" alt="rank icon">
                    <p><?= htmlspecialchars($t['popis']) ?></p>
                    <p>Cena: <?= htmlspecialchars($t['cena_info']) ?></p>
                    <br>
                    <button class="book-btn" onclick="window.location.href='index.php?page=rezervacie&trener=<?= $t['slug'] ?>'">
                        Zajednať termín
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>