<div id="user-space" class="page">
    <div class="content-page">
        <?php
        include('user-menu.php'); // menu à droite
        include('../views/notification.php'); // message de notification
        include($content); // contenu principal de la page
        ?>
    </div>
</div>