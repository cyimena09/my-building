<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>My Building</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="shortcut icon" type="image/png" href="images/favicon_mybuilding.png"/>
    <script src="https://kit.fontawesome.com/acb4dd5af3.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
            integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
            crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
    <script src="/js/functions.js"></script>
</head>
<body>

<header>
    <div class="content-page">
        <div class="logo">
            <a href="/">My Building</a>
        </div>
        <div class="actions">
            <ul>
                <?php if(isset($authenticatedUser) && $authenticatedUser): ?>
                    <li><a href="/auth/accountView">Votre Espaces</a></li>
                    <li><a class="a-btn a-btn-red" href="/auth/logout"><i class="fas fa-power-off"></i>Se déconnecter</a></li>
                <?php else: ?>
                    <li><a class="a-btn a-btn-grey" href="/">Se connecter</a></li>
                    <li><a class="a-btn a-btn-mauve" href="/auth/registerView">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
