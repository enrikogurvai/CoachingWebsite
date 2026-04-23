<?php
class Router {
    public function renderPage($page) {
        include "includes/header.php";
        $allowed_pages = ['home', 'coaching', 'tierlist', 'rezervacie'];
        
        if (in_array($page, $allowed_pages)) {
            $file = "pages/" . $page . ".php";
            if (file_exists($file)) {
                include $file;
            } else {
                include "pages/home.php";
            }
        } else {
            include "pages/home.php";
        }

        include "includes/footer.php";
    }
}
?>