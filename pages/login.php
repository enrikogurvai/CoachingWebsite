<link rel="stylesheet" href="assets/css/auth.css">

<section class="auth-section">
    <h1>Prihlásenie</h1>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
        <div class="alert alert-danger">
            Nesprávny e-mail alebo heslo. Skúste to znova.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'registered'): ?>
        <div class="alert alert-success">
            Registrácia úspešná! Teraz sa môžeš prihlásiť.
        </div>
    <?php endif; ?>

    <form action="spracovanie_auth.php?akcia=login" method="POST">
        <label>E-mail:</label>
        <input type="email" name="email" required>
        
        <label>Heslo:</label>
        <input type="password" name="heslo" required>
        
        <button type="submit">Vstúpiť</button>

        <div class="forgot-password-container">
            <a href="index.php?page=forgot_password" class="forgot-link">Zabudol si svoje heslo?</a>
        </div>
    </form>
</section>

<script src="assets/js/auth.js"></script>