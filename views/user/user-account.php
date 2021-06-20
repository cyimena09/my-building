<div id="user-account" style="margin-top: 30px">
    <p class="role">
            <span <?php if ($authenticatedUser->role->name == RoleEnum::SYNDIC): ?> class="bg-mauve"
            <?php else : ?> class="bg-orange"<?php endif ?>>
                <?= $authenticatedUser->role->name ?>
            </span>
    </p>

    <h1>Votre espace</h1>

    <?php if (!empty($authenticatedUser->building->id)): ?>
        <div class="location">
            <p>Vous louez
                <a class="a-btn-orange"
                   href="/apartments/show/<?= $authenticatedUser->apartment->id; ?>"><?= $authenticatedUser->apartment->name; ?></a>
                du batiment
                <a class="a-btn-mauve"
                   href="/buildings/show/<?= $authenticatedUser->apartment->id; ?>"><?= $authenticatedUser->building->name; ?></a>
            </p>
        </div>
    <?php endif ?>

    <section>
        <h2>Informations personnelles</h2>
        <form id="form-update-account" action="" class="form-in-line" method="post">
            <input type="hidden" name="idUser" value="<?= $authenticatedUser->id; ?>">
            <div class="group group-hover">
                <label for="firstname">Prénom</label>
                <input id="firstname" type="text" name="firstname"
                       value="<?= $authenticatedUser->firstName ?>">
            </div>
            <div class="group group-hover">
                <label for="lastname">Nom</label>
                <input id="lastname" type="text" name="lastname"
                       value="<?= $authenticatedUser->lastName ?>">
            </div>
            <div class="group group-hover">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= $authenticatedUser->email ?>">
            </div>
            <div class="group group-hover">
                <label for="phone">Téléphone</label>
                <input id="phone" type="text" placeholder="Numéro de téléphone" name="phone"
                       value="<?= $authenticatedUser->phone ?>">
            </div>

            <!--      Radio button-->
            <div class="group" style="flex-direction: column; align-items: flex-start">
                <p style="margin-bottom: 5px">Genre</p>
                <div>
                    <input type="radio" id="male" name="gender"
                           value="M" <?php if ($authenticatedUser->gender == 'M'): ?> checked <?php endif ?> >
                    <label for="male">Homme</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender"
                           value="F" <?php if ($authenticatedUser->gender == 'F'): ?> checked <?php endif ?> >
                    <label for="female">Femme</label>
                </div>
                <div>
                    <input type="radio" id="other" name="gender"
                           value="O" <?php if ($authenticatedUser->gender == 'O'): ?> checked <?php endif ?>>
                    <label for="other">Autre</label>
                </div>
            </div>
            <div class="group">
                <button>Mettre à jour</button>
            </div>
        </form>
    </section>

    <section>
        <h2>Adresse de contact</h2>
        <form id="form-update-address" action="" class="form-in-line" method="post">
            <input type="hidden" name="idAddress" value="<?= $authenticatedUser->address->id; ?>">

            <div class="group group-hover">
                <label for="street">Rue</label>
                <input id="street" type="text" placeholder="Rue" name="street"
                       value="<?= $authenticatedUser->address->street ?>">
            </div>
            <div class="group group-hover">
                <label for="houseNumber">Numéro</label>
                <input id="houseNumber" type="text" placeholder="Numéro" name="houseNumber"
                       value="<?= $authenticatedUser->address->houseNumber ?>">
            </div>
            <div class="group group-hover">
                <label for="boxNumber">Boite</label>
                <input id="boxNumber" type="text" placeholder="Boite" name="boxNumber"
                       value="<?= $authenticatedUser->address->boxNumber ?>">
            </div>
            <div class="group group-hover">
                <label for="zip">Code postal</label>
                <input id="zip" type="text" placeholder="Code postal" name="zip"
                       value="<?= $authenticatedUser->address->zip ?>">
            </div>
            <div class="group group-hover">
                <label for="city">Ville</label>
                <input id="city" type="text" placeholder="Ville" name="city"
                       value="<?= $authenticatedUser->address->city ?>">
            </div>
            <div class="group group-hover">
                <label for="country">Pays</label>
                <input id="country" type="text" placeholder="Pays" name="country"
                       value="<?= $authenticatedUser->address->country ?>">
            </div>
            <div class="group">
                <button>Mettre à jour</button>
            </div>
        </form>
    </section>

    <?php if (isset($building) && isset($apartment)): ?>
        <section>
            <div class="head">
                <h2>Votre résidence</h2>
            </div>
            <div class="container" style="display: flex; align-items: center;">
                <div class="container-icon">
                    <i class="fas fa-building" style="font-size: 45px; margin-right: 20px"></i>
                </div>
                <div class="container-text">
                    <p style="display: flex; justify-content: space-between; align-items: center; width: 300px; margin-bottom: 10px">
                        <span>Immeuble</span>
                        <span>·</span>
                        <span class="a-btn a-btn-mauve"><?= $building->name ?></span>

                    </p>
                    <p style="display: flex; justify-content: space-between; align-items: center; width: 300px;">
                        <span>Appartement</span>
                        <span>·</span>
                        <span class="a-btn a-btn-orange"><?= $apartment->name ?></span>
                    </p>
                </div>
            </div>
        </section>
    <?php endif ?>

    <section>
        <div class="head">
            <h2>Vos propriétés</h2>
        </div>
        <?php if (isset($apartmentsOwned)) : ?>
            <?php foreach ($apartmentsOwned as $apart): ?>
                <div class="container" style="display: flex; align-items: center;">
                    <div class="container-icon">
                        <i class="fas fa-building" style="font-size: 45px; margin-right: 20px"></i>
                    </div>
                    <div class="container-text">

                        <p style="display: flex; justify-content: space-between; align-items: center; width: 300px;  margin-bottom: 10px">
                            <span>Appartement</span>
                            <span>·</span>
                            <span class="a-btn a-btn-orange"><?= $apart->name ?></span>
                        </p>

                        <p style="display: flex; justify-content: space-between; align-items: center; width: 300px;">
                            <span>de l'immeuble</span>
                            <span>·</span>
                            <span class="a-btn a-btn-mauve"><?= $apart->building->name ?></span>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
        <p style="color: grey">Vous n'avez pas de propriétés</p>
        <?php endif; ?>
    </section>

</div>
<script src="/js/account.js"></script>