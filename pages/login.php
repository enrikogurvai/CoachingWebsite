<link rel="stylesheet" href="assets/css/auth.css">

<section class="auth-section">
    <h1>Prihlásenie</h1>
    <form action="spracovanie_auth.php?akcia=login" method="POST">
        <label>E-mail:</label>
        <input type="email" name="email" required>
        <label>Heslo:</label>
        <input type="password" name="heslo" required>
        <button type="submit">Vstúpiť</button>
    </form>
</section>