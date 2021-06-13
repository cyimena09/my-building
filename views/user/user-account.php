<div>

    <p class="role">
            <span <?php if ($authenticatedUser->role == 'SYNDIC'): ?> class="bg-mauve"
            <?php else : ?> class="bg-orange"<?php endif ?>>
                <?= $authenticatedUser->role ?>
            </span>
    </p>

    <h1>Information sur votre compte</h1>

    <form action="" method="post">
        <div class="group">
            <label for="firstname"></label>
            <input id="firstname" type="text" placeholder="Prénom" name="firstname"
                   value="<?= $authenticatedUser->firstName ?>">
        </div>

        <div class="group">
            <label for="lastname"></label>
            <input id="lastname" type="text" placeholder="Nom" name="lastname"
                   value="<?= $authenticatedUser->lastName ?>">
        </div>

        <div class="group">
            <label for="email"></label>
            <input id="email" type="text" placeholder="Email" name="email" value="<?= $authenticatedUser->email ?>">
        </div>

        <div class="group">
            <label for="phone"></label>
            <input id="phone" type="text" placeholder="Numéro de téléphone" name="phone"
                   value="<?= $authenticatedUser->phone ?>">
        </div>

        <!--      Radio button-->
        <div class="group">
            <p>Genre</p>
            <div>
                <input type="radio" id="male" name="gender"
                       value="male" <?php if ($authenticatedUser->gender == 'M'): ?> checked <?php endif ?> >
                <label for="male">Homme</label>
            </div>
            <div>
                <input type="radio" id="female" name="gender"
                       value="female" <?php if ($authenticatedUser->gender == 'F'): ?> checked <?php endif ?> >
                <label for="female">Femme</label>
            </div>
            <div>
                <input type="radio" id="other" name="gender"
                       value="other" <?php if ($authenticatedUser->gender == 'O'): ?> checked <?php endif ?>>
                <label for="other">Autre</label>
            </div>
        </div>

        <button>Mettre à jour</button>
    </form>

</div>
