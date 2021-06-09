<div id="login" class="page">
    <div class="content-page">

       <?php   include('../views/notification.php'); // message de notification ?>

        <h1 style="display: flex; flex-direction: column">
            <span class="color-turquoise"
                  style="font-size: 36px; font-weight: bold; margin-bottom: 10px">Bienvenue,</span>
            <span>Veuillez vous authentifier</span>
        </h1>

        <form action="/auth/login">
            <div class="group">
                <label for="email"></label>
                <input id="email" type="text" placeholder="Email" name="email">
            </div>
            <div class="group">
                <label for="password"></label>
                <input id="password" type="text" placeholder="Mot de passe" name="password">
            </div>
            <p class="forgot-password color-blue">Mot de passe oublié ?</p>
            <div class="container-button">
                <button type="submit">Se connecter</button>
            </div>
        </form>

    </div>
</div>
