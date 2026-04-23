<link rel="stylesheet" href="assets/css/admin_panel.css">

<?php
if (!isset($_SESSION['rola']) || $_SESSION['rola'] !== 'admin') {
    echo "<div class='alert alert-danger'>Prístup zamietnutý. Iba pre administrátorov.</div>";
    return;
}

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['delete_id'])) {
    $id_na_zmazanie = $_GET['delete_id'];
    $sql_delete = "DELETE FROM treneri WHERE id = ?";
    $stmt_delete = $db->prepare($sql_delete);
    $stmt_delete->execute([$id_na_zmazanie]);
    
    header("Location: index.php?page=admin_treneri&status=deleted");
    exit();
}

$edit_trener = null;

if (isset($_GET['edit_id'])) {
    $stmt = $db->prepare("SELECT * FROM treneri WHERE id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $edit_trener = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pouzivatel_id = !empty($_POST['pouzivatel_id']) ? $_POST['pouzivatel_id'] : null;
    $meno = $_POST['meno'];
    $hra = $_POST['hra'];
    $rank_nazov = $_POST['rank_nazov'];
    $rank_ikona = $_POST['rank_ikona'];
    $popis = $_POST['popis'];
    $cena = $_POST['cena_info'];
    $pozadie = $_POST['pozadie_img'];
    $slug = strtolower(str_replace(' ', '-', $meno));

    if (isset($_POST['upravit_trenera'])) {
        $id = $_POST['trener_id'];
        $sql = "UPDATE treneri SET pouzivatel_id=?, meno=?, hra=?, rank_nazov=?, rank_ikona=?, popis=?, cena_info=?, pozadie_img=?, slug=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pouzivatel_id, $meno, $hra, $rank_nazov, $rank_ikona, $popis, $cena, $pozadie, $slug, $id]);
        echo "<div class='alert alert-success'>Karta trénera bola úspešne upravená!</div>";
        $edit_trener = null; 
    } elseif (isset($_POST['pridat_trenera'])) {
        $sql = "INSERT INTO treneri (pouzivatel_id, meno, hra, rank_nazov, rank_ikona, popis, cena_info, pozadie_img, slug) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pouzivatel_id, $meno, $hra, $rank_nazov, $rank_ikona, $popis, $cena, $pozadie, $slug]);
        echo "<div class='alert alert-success'>Nový tréner bol pridaný!</div>";
    }
}

if (isset($_GET['status']) && $_GET['status'] === 'deleted') {
    echo "<div class='alert alert-danger'>Karta trénera bola odstránená!</div>";
}

$treneri = $db->query("SELECT * FROM treneri")->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="admin-section">
    <h1>Administrácia trénerov</h1>
    
    <div class="admin-form-container">
        <h2><?= $edit_trener ? "Upraviť kartu: " . htmlspecialchars($edit_trener['meno']) : "Pridať nového trénera" ?></h2>
        
        <form method="POST">
            <?php if ($edit_trener): ?>
                <input type="hidden" name="trener_id" value="<?= $edit_trener['id'] ?>">
            <?php endif; ?>

            <label for="pouzivatel_id">Priradiť k účtu (Rola: Trener)</label>
            <select name="pouzivatel_id" id="pouzivatel_id">
                <option value="">-- Vyberte používateľa --</option>
                <?php
                $u_stmt = $db->query("SELECT id, meno FROM pouzivatelia WHERE rola = 'trener'");
                while ($u = $u_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($edit_trener && $edit_trener['pouzivatel_id'] == $u['id']) ? 'selected' : '';
                    echo "<option value='{$u['id']}' $selected>{$u['meno']}</option>";
                }
                ?>
            </select>

            <label for="meno">Verejné meno na karte</label>
            <input type="text" id="meno" name="meno" value="<?= $edit_trener['meno'] ?? '' ?>" required>
            
            <label for="hra">Hra</label>
            <select id="hra" name="hra">
                <option value="LoL" <?= (isset($edit_trener['hra']) && $edit_trener['hra'] == 'LoL') ? 'selected' : '' ?>>League of Legends</option>
                <option value="TFT" <?= (isset($edit_trener['hra']) && $edit_trener['hra'] == 'TFT') ? 'selected' : '' ?>>TFT</option>
            </select>

            <label for="rank_nazov">Rank (Názov)</label>
            <input type="text" id="rank_nazov" name="rank_nazov" value="<?= $edit_trener['rank_nazov'] ?? '' ?>">
            
            <label for="rank_ikona">Cesta k ikone</label>
            <input type="text" id="rank_ikona" name="rank_ikona" value="<?= $edit_trener['rank_ikona'] ?? 'assets/images/challenger_icon.png' ?>">
            
            <label for="pozadie_img">Cesta k pozadiu karty</label>
            <input type="text" id="pozadie_img" name="pozadie_img" value="<?= $edit_trener['pozadie_img'] ?? 'assets/images/background.jpg' ?>">
            
            <label for="cena_info">Cena (Info text)</label>
            <input type="text" id="cena_info" name="cena_info" value="<?= $edit_trener['cena_info'] ?? '' ?>">
            
            <label for="popis">Popis</label>
            <textarea id="popis" name="popis"><?= $edit_trener['popis'] ?? '' ?></textarea>

            <?php if ($edit_trener): ?>
                <button type="submit" name="upravit_trenera" class="book-btn">Uložiť zmeny</button>
                <div class="admin-form-footer">
                    <a href="index.php?page=admin_treneri" class="cancel-link">Zrušiť úpravu</a>
                </div>
            <?php else: ?>
                <button type="submit" name="pridat_trenera" class="book-btn">Vytvoriť kartu</button>
            <?php endif; ?>
        </form>
    </div>

    <h2>Existujúci tréneri</h2>
    <table>
        <thead>
            <tr>
                <th>Meno</th>
                <th>Hra</th>
                <th>Akcia</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($treneri as $t): ?>
            <tr>    
                <td><?= htmlspecialchars($t['meno']) ?></td>
                <td><?= $t['hra'] ?></td>
                <td>
                    <a href="index.php?page=admin_treneri&edit_id=<?= $t['id'] ?>" class="edit-link">Upraviť</a>
                    <a href="index.php?page=admin_treneri&delete_id=<?= $t['id'] ?>" class="delete-link" onclick="return confirm('Naozaj zmazať?')">Odstrániť</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>