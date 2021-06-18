<h1>Information sur l'utilisateur</h1>
<section>
    <div class="head">
        <h2>Personnelles</h2>
    </div>
    <form class="form-in-column" action="" method="post">
        <div class="group">
            <label for="firstName"></label>
            <input id="firstName" type="text" placeholder="Prénom" name="firstName"
                   value="<?= $user->firstName; ?>">
        </div>
        <div class="group">
            <label for="lastName"></label>
            <input id="lastName" type="text" placeholder="Nom" name="lastName" value="<?= $user->lastName; ?>">
        </div>
        <div class="group">
            <label for="gender"></label>
            <input id="gender" type="text" placeholder="Genre" name="gender" value="<?= $user->gender; ?>">
        </div>
        <div class="group">
            <label for="email"></label>
            <input id="email" type="text" placeholder="Email" name="email" value="<?= $user->email; ?>">
        </div>
        <div class="group">
            <label for="phone"></label>
            <input id="phone" type="text" placeholder="Téléphone" name="firstName" value="<?= $user->phone; ?>">
        </div>
        <div class="group">
            <label for="role"></label>
            <input id="role" type="text" placeholder="Rôle" name="role" value="<?= $user->role; ?>">
        </div>
        <div class="group">
            <button>Mettre à jour</button>
        </div>
    </form>
</section>

<!--        Locations-->
<section>
    <div class="head">
        <h2>Location</h2>
    </div>
    <?php if (count($rentedApartments) > 0): ?>
        <?php foreach ($rentedApartments as $rentedApartment): ?>
            <p>Apartement : <?= $rentedApartment->name; ?> ( immeuble : <?= $rentedApartment->building->name; ?> )</p>
            <a href="/apartments/show/<?= $rentedApartment->id; ?>">Voir</a>
        <?php endforeach; ?>
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
            <p>Apartement : <?= $ownedApartment->name; ?> de l'immeuble <?= $ownedApartment->name; ?></p>
            <a href="/apartments/show/<?= $ownedApartment->id; ?>">Voir</a>
        <?php endforeach; ?>
    <?php else : ?>
        <p style="color: #9d9b9b"><?= $user->firstName; ?> <?= $user->lastName; ?> ne possède aucun appartement</p>
    <?php endif; ?>
</section>