<?php
if ($authenticatedUser->role == 'PROPRIETAIRE_LOCATAIRE') {
    $authenticatedUser->role = 'PROPRIÉTAIRE ET LOCATAIRE';
}
?>
<div style="margin-top: 30px">
    <p class="role">
            <span <?php if ($authenticatedUser->role == 'SYNDIC'): ?> class="bg-mauve"
            <?php else : ?> class="bg-orange"<?php endif ?>>
                <?= $authenticatedUser->role ?>
            </span>
    </p>

    <h1>Informations personnelles</h1>
    <section>
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

    <?php if (isset($building) && isset($apartment)): ?>
        <section>
            <div class="head">
                <h2>Votre location</h2>
            </div>
            <div class="container" style="display: flex; align-items: center;">
                <div class="container-icon">
                    <i class="fas fa-building" style="font-size: 45px; margin-right: 20px"></i>
                </div>
                <div class="container-text">
                    <p style="display: flex; justify-content: space-between; align-items: center; width: 300px; margin-bottom: 10px">
                        <span>Immeuble</span><span>·</span>
                        <span><a style="font-size: 13px" class="a-btn a-btn-mauve"
                                 href="/buildings/show/<?= $building->id ?>"> <?= $building->name ?></a></span></p>

                    <p style="display: flex; justify-content: space-between; align-items: center; width: 300px;"><span>Appartement</span>
                        <span>·</span>
                        <span><a style="font-size: 13px" class="a-btn a-btn-orange"
                                 href="/apartments/show/<?= $apartment->id ?>"> <?= $apartment->name ?></a></span></p>
                </div>
            </div>
        </section>
    <?php endif ?>
</div>
<script src="/js/account.js"></script>