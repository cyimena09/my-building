<div>
    <h1>Information sur votre compte</h1>

    <form action="" method="post">
        <div class="group">
            <label for="firstname"></label>
            <input id="firstname" type="text" placeholder="Prénom" name="firstname"
                   value="<?= $user->firstName ?>">
        </div>

        <div class="group">
            <label for="lastname"></label>
            <input id="lastname" type="text" placeholder="Nom" name="lastname"
                   value="<?= $user->lastName ?>">
        </div>

        <div class="group">
            <label for="email"></label>
            <input id="email" type="text" placeholder="Email" name="email" value="<?= $user->email ?>">
        </div>

        <div class="group">
            <label for="phone"></label>
            <input id="phone" type="text" placeholder="Numéro de téléphone" name="phone"
                   value="<?= $user->phone ?>">
        </div>

        <!--      Radio button-->
        <div class="group">
            <p>Genre</p>
            <div>
                <input type="radio" id="male" name="gender"
                       value="male" <?php if ($user->gender == 'M'): ?> checked <?php endif ?> >
                <label for="male">Homme</label>
            </div>
            <div>
                <input type="radio" id="female" name="gender"
                       value="female" <?php if ($user->gender == 'F'): ?> checked <?php endif ?> >
                <label for="female">Femme</label>
            </div>
            <div>
                <input type="radio" id="other" name="gender"
                       value="other" <?php if ($user->gender == 'O'): ?> checked <?php endif ?>>
                <label for="other">Autre</label>
            </div>
        </div>

        <button>Mettre à jour</button>
    </form>

</div>
