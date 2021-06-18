<?php
include('../enumerations/statusEnum.php');
$enums = statusEnum();
$i = 0;
$x = 0;
?>
<div>
    <h1>Information sur l'immeuble</h1>

    <section>
        <div class="head">
            <h2>Localisation</h2>
        </div>
        <form id="form-update-building" class="form-in-line" action="/buildings/update/<?= $building->id ?>"
              method="post">
            <input type="hidden" name="idBuilding" value="<?= $building->id; ?>">
            <div class="group group-hover">
                <label for="name">Nom de l'immeuble</label>
                <input id="name" type="text" placeholder="Nom de l'immeuble" name="name"
                       value="<?= $building->name ?>">
            </div>

            <!-- Adresse -->
            <div class="group group-hover">
                <label for="street">Rue</label>
                <input id="street" type="text" placeholder="Rue" name="street"
                       value="<?= $building->address->street; ?>">
            </div>

            <div class="group group-hover">
                <label for="houseNumber">Numéro</label>
                <input id="houseNumber" type="text" placeholder="Nom" name="houseNumber"
                       value="<?= $building->address->houseNumber; ?>">
            </div>

            <div class="group group-hover">
                <label for="zip">Code postal</label>
                <input id="zip" type="text" placeholder="Code postal" name="zip"
                       value="<?= $building->address->zip; ?>">
            </div>

            <div class="group group-hover">
                <label for="city">Ville</label>
                <input id="city" type="text" placeholder="Ville" name="city" value="<?= $building->address->city; ?>">
            </div>

            <div class="group group-hover">
                <label for="country">Pays</label>
                <input id="country" type="text" placeholder="Pays" name="country"
                       value="<?= $building->address->country; ?>">
            </div>

            <button>Mettre à jour</button>
        </form>
    </section>

    <!-- Liste des appartements de l'immeuble-->
    <section>
        <div class="head">
            <h2>Appartements de l'immeuble</h2>
            <a href="/apartments/createView?idBuilding=<?= $building->__get('id'); ?>">
                <i class="fas fa-plus"></i>
                Ajouter un nouvel appartement
            </a>
        </div>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Numéro de l'appartement</th>
                <th>Nombre de locataire</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($apartments)): ?>
                <?php foreach ($apartments as $apartment): $i++ ?>
                    <tr>
                        <th><?= $i ?></th>
                        <td><?= $apartment->__get('name'); ?></td>
                        <td><?= $apartment->__get('nbTenants'); ?></td>
                        <td><a href="/apartments/show/<?= $apartment->__get('id'); ?>">Voir</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </section>

    <!-- Communications -->
    <section>

        <div class="head">
            <h2>Communications</h2>
            <a href="/communications/createView?idBuilding=<?= $building->__get('id'); ?>">
                <i class="fas fa-plus"></i>
                Ajouter une nouvelle communication
            </a>
        </div>

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
                <?php foreach ($communications as $communication): $x++ ?>
                    <tr>
                        <th><?= $x ?></th>
                        <td><?= $communication->__get('subject'); ?></td>
                        <td><?= $communication->__get('dateCreation'); ?></td>
                        <td><?= $communication->__get('lastUpdate'); ?></td>
                        <td><?= $communication->__get('message'); ?></td>
                        <td><a href="/communications/show/<?= $communication->__get('id'); ?>">Voir</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </section>

    <!-- Tickets -->
    <section>
        <div class="head">
            <h2>Tickets</h2>
            <a href="/tickets/createView?idBuilding=<?= $building->__get('id'); ?>">
                <i class="fas fa-plus"></i>
                Ajouter une nouveau ticket
            </a>
        </div>

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
                        <th><?= $ticket->__get('id'); ?></th>
                        <td><?= $ticket->__get('subject'); ?></td>
                        <!-- Tickets-->
                        <td>
                            <label for="status"></label>
                            <select name="status" id="<?= $ticket->__get('id'); ?>">
                                <?php foreach ($enums as $enum): ?>
                                    <?php if ($ticket->__get('status') == $enum): ?>
                                        <option value="<?= $ticket->__get('id'); ?>"
                                                selected="selected"><?= $ticket->__get('status'); ?></option>
                                    <?php endif; ?>
                                    <?php if ($ticket->__get('status') !== $enum): ?>
                                        <option value="<?= $enum; ?>"><?= $enum; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </td>

                        <td><?= $ticket->__get('dateCreation'); ?></td>
                        <td><a href="/tickets/show/<?= $ticket->__get('id'); ?>">Voir</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
</div>
<script src="/js/building.js"></script>
<script src="/js/ticket.js"></script>