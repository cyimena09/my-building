<div>
    <h1>Information sur l'utilisateur</h1>
    <form action="" method="post">

        <!--        Personelles-->
        <h2>Personnelles</h2>

        <div class="group">
            <label for="firstName"></label>
            <input id="firstName" type="text" placeholder="Prénom" name="firstName" value="<?= $userInfo->firstName; ?>">
        </div>

        <div class="group">
            <label for="lastName"></label>
            <input id="lastName" type="text" placeholder="Nom" name="lastName" value="<?= $userInfo->lastName; ?>">
        </div>

        <div class="group">
            <label for="gender"></label>
            <input id="gender" type="text" placeholder="Genre" name="gender" value="<?= $userInfo->gender; ?>">
        </div>

        <div class="group">
            <label for="email"></label>
            <input id="email" type="text" placeholder="Email" name="email" value="<?= $userInfo->email; ?>">
        </div>

        <div class="group">
            <label for="phone"></label>
            <input id="phone" type="text" placeholder="Téléphone" name="firstName" value="<?= $userInfo->phone; ?>">
        </div>

        <div class="group">
            <label for="role"></label>
            <input id="role" type="text" placeholder="Rôle" name="role" value="<?= $userInfo->role; ?>">
        </div>

        <!--        Adresse-->
        <h2>Adresse</h2>

        <div class="group">
            <label for="street"></label>
            <input id="street" type="text" placeholder="Rue" name="street" value="<?= $userInfo->address->street; ?>">
        </div>
        <div class="group">
            <label for="houseNumber"></label>
            <input id="houseNumber" type="text" placeholder="Numéro" name="houseNumber" value="<?= $userInfo->address->houseNumber; ?>">
        </div>
        <div class="group">
            <label for="boxNumber"></label>
            <input id="boxNumber" type="text" placeholder="Boite" name="boxNumber" value="<?= $userInfo->address->boxNumber; ?>">
        </div>
        <div class="group">
            <label for="zip"></label>
            <input id="zip" type="text" placeholder="Code postal" name="zip" value="<?= $userInfo->address->zip; ?>">
        </div>
        <div class="group">
            <label for="city"></label>
            <input id="city" type="text" placeholder="Ville" name="city" value="<?= $userInfo->address->city; ?>">
        </div>
        <div class="group">
            <label for="country"></label>
            <input id="country" type="text" placeholder="Pays" name="country" value="<?= $userInfo->address->country; ?>">
        </div>
        <button>Mettre à jour</button>
    </form>
</div>