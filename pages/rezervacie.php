<link rel="stylesheet" href="assets/css/booking.css">

<?php
$database = new Database();
$db = $database->getConnection();

$stmt = $db->query("SELECT id, meno, hra FROM treneri");
$vsetci_treneri = $stmt->fetchAll(PDO::FETCH_ASSOC);

$kliknuty_id = $_GET['trener_id'] ?? ''; 
?>

<section class="booking-section">
    <h1>Zajednať termín coachingu</h1>
    
    <form action="spracovanie_rezervacie.php" method="POST" class="booking-form">
        
        <label for="meno">Tvoje meno / Nickname:</label>
        <input type="text" id="meno" name="meno" value="<?= $_SESSION['meno'] ?? '' ?>" required>

        <label for="email">Tvoj E-mail:</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['email'] ?? '' ?>" required>

        <label for="discord">Discord tag:</label>
        <input type="text" id="discord" name="discord" required>

        <label for="trener">Vyber si trénera:</label>
        <select id="trener" name="trener_id" required>
            <option value="">-- Vyber si trénera --</option>
            <?php foreach ($vsetci_treneri as $t): ?>
                <option value="<?= $t['id'] ?>" <?= $kliknuty_id == $t['id'] ? 'selected' : '' ?>>
                    [<?= $t['hra'] ?>] <?= htmlspecialchars($t['meno']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="sprava">Čo by si chcel trénovať?</label>
        <textarea id="sprava" name="sprava" rows="5"></textarea>

        <button type="submit" class="book-btn" style="width: 100%;">Odoslať žiadosť</button>
    </form>
</section>