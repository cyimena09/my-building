<div id="home" class="page">
    <div class="container-image">
        <img src="/images/building.jpg" alt="Building">
    </div>
    <div class="content-page">
        <!-- Title -->
        <div class="title">
            <h1><span class="color-turquoise">Votre</span><span>Building Manager</span></h1>
        </div>

        <!-- Login -->
        <div id="login">
            <?php include('../views/notification.php'); ?>

            <?php if (!isset($authenticatedUser) || !$authenticatedUser): ?>
                <h1 style="display: flex; flex-direction: column">
            <span class="color-turquoise"
                  style="font-size: 36px; font-weight: bold; margin-bottom: 10px">Bienvenue,</span>
                    <span>Veuillez vous authentifier</span>
                </h1>
                <form action="/auth/login" class="form-in-column" method="post">
                    <div class="group">
                        <label for="email"></label>
                        <input id="email" type="email" placeholder="Email" name="email">
                    </div>
                    <div class="group">
                        <label for="password"></label>
                        <input id="password" type="password" placeholder="Mot de passe" name="password">
                    </div>

                    <div class="container-button">
                        <button type="submit" style="margin-top: 0">Se connecter</button>
                    </div>
                </form>
                <p class="not-registered">
                    <a class="color-blue" href="/auth/registerView">Pas encore inscrit ? C'est par ici !</a>
                </p>

            <?php elseif ($authenticatedUser): ?>
                <h1 style="display: flex; flex-direction: column">
            <span class="color-turquoise"
                  style="font-size: 36px; font-weight: bold; margin-bottom: 10px">Bienvenue...</span>
                    <span>Vous êtes déjà connecté</span>
                </h1>
            <?php endif; ?>
        </div>
    </div>
</div>
