<?php
    if (isset($_GET['trener'])) 
    {
        $kliknuty_trener = $_GET['trener'];
    } else 
    {
        $kliknuty_trener = '';
    }
?>

<link rel="stylesheet" href="assets/css/booking.css">

<section class="booking-section">
    <h1>Zajednať termín coachingu</h1>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div style="background: #01b7ab; color: black; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: bold;">
        Žiadosť bola úspešne odoslaná! Skontroluj si e-mail a trenér ťa čoskoro kontaktuje na Discorde.
    </div>
    <?php endif; ?>


    <form action="spracovanie_rezervacie.php" method="POST" class="booking-form">
        
        <label for="meno">Tvoje meno / Nickname:</label>
        <input type="text" id="meno" name="meno" required>

        <label for="email">Tvoj E-mail:</label>
        <input type="email" id="email" name="email" placeholder="napr. tvoj@email.com">

        <label for="discord">Discord tag:</label>
        <input type="text" id="discord" name="discord" required>

        <label for="trener">Vyber si trénera:</label>
        <select id="trener" name="trener" required>
            <option value="enrique" <?= $kliknuty_trener == 'enrique' ? 'selected' : '' ?>>[LoL] Enrique</option>
            <option value="matus" <?= $kliknuty_trener == 'matus' ? 'selected' : '' ?>>[TFT] Matúš</option>
        </select>

        <label for="sprava">Čo by si chcel trénovať? (Poznámka):</label>
        <textarea id="sprava" name="sprava" rows="5" placeholder="Napr. chcem sa zlepšiť v macro rozhodovaní..."></textarea>

        <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Odoslať žiadosť</button>
    </form>
</section>