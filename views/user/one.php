<h1>Information sur l'utilisateur</h1>
<section>
    <div class="head">
        <h2>Personnelles</h2>
    </div>
    <form class="form-in-column">
        <div class="group">
            <label for="firstName"></label>
            <input id="firstName" type="text" placeholder="Prénom" name="firstName"
                   value="<?= $user->firstName; ?>" disabled>
        </div>
        <div class="group">
            <label for="lastName"></label>
            <input id="lastName" type="text" placeholder="Nom" name="lastName" value="<?= $user->lastName; ?>" disabled>
        </div>
        <div class="group">
            <label for="gender"></label>
            <input id="gender" type="text" placeholder="Genre" name="gender" value="<?= $user->gender; ?>" disabled>
        </div>
        <div class="group">
            <label for="email"></label>
            <input id="email" type="text" placeholder="Email" name="email" value="<?= $user->email; ?>" disabled>
        </div>
        <div class="group">
            <label for="phone"></label>
            <input id="phone" type="text" placeholder="Téléphone" name="firstName" value="<?= $user->phone; ?>" disabled>
        </div>
        <div class="group">
            <label for="role"></label>
            <input id="role" type="text" placeholder="Rôle" name="role" value="<?= $user->role->name; ?>" disabled>
        </div>
    </form>
</section>

<!--        Locations-->
<section>
    <div class="head">
        <h2>Résidence ou Location</h2>
    </div>
    <?php if (isset($rentedApartment)): ?>
            <p>Apartement : <?= $rentedApartment->name; ?> ( immeuble : <?= $rentedApartment->building->name; ?> )</p>
            <a href="/apartments/show/<?= $rentedApartment->id; ?>">Voir</a>
    <?php else : ?>
        <p style="color: #9d9b9b"><?= $user->firstName; ?> <?= $user->lastName; ?> ne loue aucun appartement</p>
    <?php endif; ?>
</section>

<!--        Propriétés -->
<section>
    <div class="head">
        <h2>Propriété</h2>
    </div>
    <?php if (count($ownedApartments) > 0): ?>
        <?php foreach ($ownedApartments as $ownedApartment): ?>
            <p>Appartement : <?= $ownedApartment->name; ?> de l'immeuble <?= $ownedApartment->name; ?></p>
            <a href="/apartments/show/<?= $ownedApartment->id; ?>">Voir</a>
        <?php endforeach; ?>
    <?php else : ?>
        <p style="color: #9d9b9b"><?= $user->firstName; ?> <?= $user->lastName; ?> ne possède aucun appartement</p>
    <?php endif; ?>
</section>