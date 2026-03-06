<?php
    // index.php
    // ---------------------------
    // Získame paramater 'page' z URL | Napr: index.php?page=coaching
    // Ak nie je nastavený page, použijeme 'home' ako defaultnú page.

    $page = $_GET['page'] ?? 'home';
    // Header načítanie na začiatok stránky.
    include "includes/header.php";

    // Podľa hodnoty $page sa rozhodne, ktorú stránku načítať.
    switch($page) {

        case 'coaching':
            include "pages/coaching.php";
            break;

        case 'contact':
            include "pages/contact.php";
            break;

        default:
            include "pages/home.php"; // ak page neexistuje, zobrazíme home
    }

    // Footer načítanie na konci stránky.
    include "includes/footer.php";
?>


