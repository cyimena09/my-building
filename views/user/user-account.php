<div>
    <p class="role">
            <span <?php if ($authenticatedUser->role == 'SYNDIC'): ?> class="bg-mauve"
            <?php else : ?> class="bg-orange"<?php endif ?>>
                <?= $authenticatedUser->role ?>
            </span>
    </p>

    <h1>Information sur votre compte</h1>
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
                <input id="email" type="text" name="email" value="<?= $authenticatedUser->email ?>">
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
</div>
<script src="/js/account.js"></script>
