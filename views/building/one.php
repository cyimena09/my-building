<div>
    <h1>Information sur l'immeuble</h1>

    <form action="/building/update/<?= $building->id ?>" method="post">
        <div class="group">
            <label for="name"></label>
            <input id="name" type="text" placeholder="Nom de l'immeuble" name="name"
                   value="<?= $building->name ?>">
        </div>

        <!-- Adresse -->
        <div class="group">
            <label for="street"></label>
            <input id="street" type="text" placeholder="Rue" name="street" value="<?= $building->address->street; ?>">
        </div>

        <div class="group">
            <label for="houseNumber"></label>
            <input id="houseNumber" type="text" placeholder="Nom" name="houseNumber"
                   value="<?= $building->address->houseNumber; ?>">
        </div>

        <div class="group">
            <label for="zip"></label>
            <input id="zip" type="text" placeholder="Code postal" name="zip" value="<?= $building->address->zip; ?>">
        </div>

        <div class="group">
            <label for="city"></label>
            <input id="city" type="text" placeholder="Ville" name="city" value="<?= $building->address->city; ?>">
        </div>

        <div class="group">
            <label for="country"></label>
            <input id="country" type="text" placeholder="Pays" name="country"
                   value="<?= $building->address->country; ?>">
        </div>

        <button>Mettre à jour</button>
    </form>

    <!-- Liste des appartements de l'immeuble-->
    <h2>Ses appartements</h2>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Numéro de l'appartement</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php if (!empty($apartments)): ?>
            <?php foreach ($apartments as $apartment): ?>
                <tr>
                    <td></td>
                    <td><?= $apartment->__get('name'); ?></td>
                    <td><a href="/apartment/show/<?= $apartment->__get('id'); ?>">Voir</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Communications -->
    <a href="/communication/createView?idBuilding=<?= $building->__get('id'); ?>">Ajouter une nouvelle communication</a>
    <h2>Communications</h2>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Sujet</th>
            <th>Date de création</th>
            <th>Dernière mise à jour</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php if (!empty($communications)): ?>
            <?php foreach ($communications as $communication): ?>
                <tr>
                    <td></td>
                    <td><?= $communication->__get('subject'); ?></td>
                    <td><?= $communication->__get('dateCreation'); ?></td>
                    <td><?= $communication->__get('lastUpdate'); ?></td>
                    <td><?= $communication->__get('message'); ?></td>
                    <td><a href="/communication/show/<?= $communication->__get('id'); ?>">Voir</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>


    <!-- Tickets -->
    <a href="/ticket/createView?idBuilding=<?= $building->__get('id'); ?>">Ajouter une nouveau ticket</a>
    <h2>Tickets</h2>
    <table>
        <thead>
        <tr>
            <th>Numéro</th>
            <th>Sujet</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($tickets)): ?>
            <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td><?= $ticket->__get('id'); ?></td>
                    <td><?= $ticket->__get('subject'); ?></td>
                    <td><?= $ticket->__get('status'); ?></td>
                    <td><?= $ticket->__get('dateCreation'); ?></td>

                    <td></td>
                    <td><a href="/ticket/show/<?= $ticket->__get('id'); ?>">Voir</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>
