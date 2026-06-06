<link rel="stylesheet" href="assets/css/auth.css">

<section class="auth-section">
    <h1>Registrácia nového GOATa</h1>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'email_exists'): ?>
        <div class="alert alert-danger">
            Tento e-mail je už zaregistrovaný. Chcete sa <a href="index.php?page=login" style="color: white; text-decoration: underline;">prihlásiť</a>?
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'weak_password'): ?>
        <div class="alert alert-danger">
            Heslo nespĺňa podmienky! Musí mať min. 8 znakov, 1 veľké písmeno a 1 číslo.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'db_error'): ?>
        <div class="alert alert-danger">
            Registrácia zlyhala. Skúste to neskôr.
        </div>
    <?php endif; ?>

    <form action="spracovanie_auth.php?akcia=registracia" method="POST">
        <label>Meno / Nickname:</label>
        <input type="text" name="meno" required>
        
        <label>E-mail:</label>
        <input type="email" name="email" required>
        
        <label>Heslo:</label>
        <input type="password" name="heslo" required>
        <small style="color: #888; text-align: left; margin-top: -5px; padding-left: 10px; font-size: 13px;">
            Min. 8 znakov, 1 veľké písmeno a 1 číslo.
        </small>
        
        <button type="submit">Vytvoriť účet</button>
    </form>
</section>

<script src="assets/js/auth.js"></script>