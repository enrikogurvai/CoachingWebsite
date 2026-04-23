<link rel="stylesheet" href="assets/css/auth.css">

<section class="auth-section">
    <h1>Registrácia nového GOATa</h1>
    <form action="spracovanie_auth.php?akcia=registracia" method="POST">
        <label>Meno / Nickname:</label>
        <input type="text" name="meno" required>
        <label>E-mail:</label>
        <input type="email" name="email" required>
        <label>Heslo:</label>
        <input type="password" name="heslo" required>
        <button type="submit">Vytvoriť účet</button>
    </form>
</section>