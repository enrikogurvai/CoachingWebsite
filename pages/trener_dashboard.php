<?php
if (!isset($_SESSION['rola']) || $_SESSION['rola'] !== 'trener') {
    echo "<div class='alert alert-danger'>Prístup zamietnutý. Táto sekcia je vyhradená pre trénerov.</div>";
    return;
}

$database = new Database();
$db = $database->getConnection();

$pouzivatel_id = $_SESSION['pouzivatel_id'];
$stmt_trener = $db->prepare("SELECT id, meno FROM treneri WHERE pouzivatel_id = ?");
$stmt_trener->execute([$pouzivatel_id]);
$trener_data = $stmt_trener->fetch(PDO::FETCH_ASSOC);

if (!$trener_data) {
    echo "<div class='alert alert-danger'>K vášmu účtu nie je priradený žiadny profil trénera. Kontaktujte admina.</div>";
    return;
}

$trener_id = (int)$trener_data['id'];
$moje_meno = $trener_data['meno'];

if (isset($_GET['update_id']) && isset($_GET['current_status'])) {
    $res_id = (int)$_GET['update_id'];
    $current = $_GET['current_status'];
    $new_status = $current;

    if ($current === 'nova') {
        $new_status = 'potvrdena';
    } elseif ($current === 'potvrdena') {
        $new_status = 'ukoncena';
    }

    if ($new_status !== $current) {
        $stmt_update = $db->prepare("UPDATE rezervacie SET status = ? WHERE id = ? AND trener_id = ?");
        $success = $stmt_update->execute([$new_status, $res_id, $trener_id]);

        if ($success && $new_status === 'ukoncena') {
            $stmt_check = $db->prepare("SELECT pouzivatel_id FROM rezervacie WHERE id = ?");
            $stmt_check->execute([$res_id]);
            $res_data = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($res_data && $res_data['pouzivatel_id']) {
                $stmt_points = $db->prepare("UPDATE pouzivatelia SET body = body + 10 WHERE id = ?");
                $stmt_points->execute([$res_data['pouzivatel_id']]);
            }
        }
    }

    header("Location: index.php?page=trener_dashboard");
    exit();
}

$query = "SELECT r.*, p.meno AS meno_klienta 
          FROM rezervacie r 
          LEFT JOIN pouzivatelia p ON r.pouzivatel_id = p.id 
          WHERE r.trener_id = ? 
          ORDER BY r.odoslane DESC";

$stmt = $db->prepare($query);
$stmt->execute([$trener_id]);
$rezervacie = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="assets/css/admin_panel.css">

<section class="admin-section">
    <h1>Môj Coaching Dashboard</h1>
    <p class="dashboard-info">
        Vitaj späť, <strong><?= htmlspecialchars($moje_meno) ?></strong>. Spravuj svoje prichádzajúce objednávky.
    </p>

    <?php if (count($rezervacie) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Klient</th>
                    <th>Discord</th>
                    <th class="text-center">Stav</th>
                    <th class="text-center">Akcia</th>
                    <th>Správa</th>
                    <th class="text-center">Odoslané</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rezervacie as $r): ?>
                <tr>    
                    <td>
                        <?= $r['meno_klienta'] ? htmlspecialchars($r['meno_klienta']) : htmlspecialchars($r['meno_hosta']) ?>
                    </td>
                    <td class="discord-cell">
                        <?= htmlspecialchars($r['discord']) ?>
                    </td>
                    
                    <td class="text-center">
                        <span class="status-badge status-<?= $r['status'] ?>">
                            <?php 
                                if($r['status'] == 'nova') echo "Nová";
                                elseif($r['status'] == 'potvrdena') echo "Potvrdená";
                                elseif($r['status'] == 'ukoncena') echo "Vybavená";
                            ?>
                        </span>
                    </td>

                    <td class="text-center">
                        <?php if ($r['status'] === 'nova'): ?>
                            <a href="index.php?page=trener_dashboard&update_id=<?= $r['id'] ?>&current_status=nova" 
                               class="action-btn btn-confirm">Potvrdiť</a>
                        <?php elseif ($r['status'] === 'potvrdena'): ?>
                            <a href="index.php?page=trener_dashboard&update_id=<?= $r['id'] ?>&current_status=potvrdena" 
                               class="action-btn btn-done">Vybaviť</a>
                        <?php else: ?>
                            <span class="status-finished">✔ Hotovo</span>
                        <?php endif; ?>
                    </td>

                    <td class="message-cell">
                        <?= htmlspecialchars($r['sprava']) ?>
                    </td>

                    <td class="text-center" style="font-size: 12px; white-space: nowrap;">
                        <?= date('d.m.Y', strtotime($r['odoslane'])) ?><br>
                        <small style="color: #666;"><?= date('H:i', strtotime($r['odoslane'])) ?></small>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-dashboard">
            <h2>Zatiaľ nemáš žiadne objednávky.</h2>
        </div>
    <?php endif; ?>
</section>