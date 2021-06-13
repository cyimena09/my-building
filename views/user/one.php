<div>
    <h1>Information sur l'utilisateur</h1>
    <form action="" method="post">

        <!--        Personelles-->
        <h2>Personnelles</h2>

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

        <button>Mettre à jour</button>
    </form>

    <!--        Locations-->
    <h2>Location</h2>
    <?php foreach ($rentedApartments as $rentedApartment): ?>
        <p>Apartement : <?= $rentedApartment->name; ?> de l'immeuble <?= $rentedApartment->building->name; ?></p>
        <a href="/apartment/show/<?= $rentedApartment->id; ?>">Voir</a>
    <?php endforeach; ?>

    <!--        Propriétés -->
    <h2>Propriété</h2>
    <?php foreach ($ownedApartments as $ownedApartment): ?>
        <p>Apartement : <?= $ownedApartment->name; ?> de l'immeuble <?= $ownedApartment->name; ?></p>
        <a href="/apartment/show/<?= $ownedApartment->id; ?>">Voir</a>
    <?php endforeach; ?>
</div>
