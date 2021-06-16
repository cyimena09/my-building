<div id="register" class="page">
    <div class="content-page">

        <?php include('../views/notification.php'); // communication de notification ?>

        <h1>Nouveau compte</h1>
        <form id="form-create-user" class="form-in-column" action="/auth/register" method="post">

            <!--            Créer en tant que -->
            <section id="role" class="create-as">
                <p>Créer un compte en tant que :</p>
                <div class="group-radio">
                    <input type="radio" id="tenant-radio" name="role" value="LOCATAIRE">
                    <label for="tenant-radio">Locataire</label>
                </div>
                <div class="group-radio">
                    <input type="radio" id="owner-radio" name="role" value="PROPRIETAIRE">
                    <label for="owner-radio">Propriétaire et non résidant</label>
                </div>
                <div class="group-radio">
                    <input type="radio" id="both-radio" name="role" value="PROPRIETAIRE_LOCATAIRE">
                    <label for="both-radio">Propriétaire et résident</label>
                </div>

                <!--           Js result -->
                <div id="js-section-result" style="margin-top: 20px">

                </div>
            </section>


            <!--            Informations personnelles -->
            <section class="parts">

                <div class="head">
                    <h3>Informations personnelles</h3>
                </div>

                <div class="group">
                    <label for="firstName"></label>
                    <input id="firstName" type="text" placeholder="Prénom" name="firstName">
                </div>
                <div class="group">
                    <label for="lastName"></label>
                    <input id="lastName" type="text" placeholder="Nom" name="lastName">
                </div>

                <div class="group">
                    <label for="phone"></label>
                    <input id="phone" type="text" placeholder="Numéro de téléphone" name="phone">
                </div>

                <div class="group">
                    <label for="email"></label>
                    <input id="email" type="email" placeholder="Email" name="email">
                </div>

                <div class="group">
                    <label for="password"></label>
                    <input id="password" type="password" placeholder="Mot de passe" name="password">
                </div>

                <!-- Radio button-->
                <div class="group">
                    <p style="font-size: 18px; margin-bottom: 10px">Genre</p>
                    <div class="group-radio">
                        <input type="radio" id="male" name="gender" value="M">
                        <label for="male">Homme</label>
                    </div>
                    <div class="group-radio">
                        <input type="radio" id="female" name="gender" value="F">
                        <label for="female">Femme</label>
                    </div>
                    <div class="group-radio">
                        <input type="radio" id="other" name="gender" value="O">
                        <label for="other">Autre</label>
                    </div>
                </div>
            </section>

            <!-- Address -->
            <section>
                <div class="head">
                    <h3>Adresse de contact</h3>
                </div>
                <div class="group">
                    <label for="street"></label>
                    <input id="street" type="text" placeholder="Rue" name="street">
                </div>
                <div class="group">
                    <label for="houseNumber"></label>
                    <input id="houseNumber" type="text" placeholder="Numéro" name="houseNumber">
                </div>
                <div class="group">
                    <label for="boxNumber"></label>
                    <input id="boxNumber" type="text" placeholder="Boite" name="boxNumber">
                </div>
                <div class="group">
                    <label for="zip"></label>
                    <input id="zip" type="text" placeholder="Code postal" name="zip">
                </div>
                <div class="group">
                    <label for="city"></label>
                    <input id="city" type="text" placeholder="Ville" name="city">
                </div>
                <div class="group">
                    <label for="country"></label>
                    <input id="country" type="text" placeholder="Pays" name="country">
                </div>
            </section>

            <div class="container-button">
                <button type="submit">Créer le compte</button>
            </div>
        </form>

    </div>
</div>
<script src="/js/register.js"></script>