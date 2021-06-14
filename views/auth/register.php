<div id="register" class="page">
    <div class="content-page">

        <?php include('../views/notification.php'); // communication de notification ?>

        <h1>Nouveau compte</h1>
        <form id="form-create-user" class="form-in-column" action="/auth/register" method="post">
            <!--  ********************   TOP PART ********************  -->
            <!--      Radio button -->
            <div class="create-as group">
                <p>Créer un compte en tant que :</p>
                <div class="group-radio">
                    <input type="radio" id="tenant" name="role" value="TENANT">
                    <label for="tenant">Locataire</label>
                </div>
                <div class="group-radio">
                    <input type="radio" id="owner" name="role" value="OWNER">
                    <label for="owner">Propriétaire et non résidant</label>
                </div>
                <div class="group-radio">
                    <input type="radio" id="both" name="role" value="TENANT_OWNER">
                    <label for="both">Propriétaire et résident</label>
                </div>
            </div>

            <!--  ********************  MID RIGHT & LEFT PART ********************  -->
            <div class="parts">
                <!-- Left -->
                <div class="left">
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
                        <input id="email" type="text" placeholder="Email" name="email">
                    </div>

                    <div class="group">
                        <label for="password"></label>
                        <input id="password" type="password" placeholder="Mot de passe" name="password">
                    </div>

                    <!--      Radio button-->

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
                </div>

                <!--  Right  -->
                <div class="right">
                    <div class="group">
                        <label class="label" for="fkBuilding">Choisissez votre résidence</label>
                        <select name="fkBuilding" id="fkBuilding">
                            <?php foreach ($buildings as $building): ?>
                                <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="js-result" style="visibility: hidden">

                    </div>
                </div>
            </div>

            <p class="color-blue">Ajouter une personne résidant avec moi +</p>
            <div class="container-button">
                <button type="submit">Créer le compte</button>
            </div>
        </form>

    </div>
</div>

<script src="/js/register.js"></script>