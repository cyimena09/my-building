<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>My Building</title>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://kit.fontawesome.com/acb4dd5af3.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
            integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
            crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
</head>
<body>

<header>
    <div class="content-page">
        <div class="logo">
            <a href="/home">My Building</a>
        </div>
        <nav>
            <ul>
                <li>Solutions</li>
                <li>A propos</li>
                <li>Prix</li>
                <li>Contact</li>
            </ul>
        </nav>
        <div class="actions">
            <ul>
                <?php if(isset($authenticatedUser) && $authenticatedUser): ?>
                    <li><a href="/auth/accountView">Votre Espaces</a></li>
                    <li><a href="/auth/logout">Se déconnecter</a></li>
                <?php else: ?>
                    <li><a href="/auth/loginView">Se connecter</a></li>
                    <li><a href="/auth/registerView">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
