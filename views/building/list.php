<?php $i = 0; ?>
<h1>Immeubles</h1>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nom de l'immeuble</th>
        <th>Nombre d'appatement</th>
        <th>Ville</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php if (!empty($buildings)): ?>
        <?php foreach ($buildings as $building): $i++; ?>
            <tr>
                <th><?= $i; ?></th>
                <td><?= $building->__get('name'); ?></td>
                <td><?= $building->__get('nbApartments'); ?></td>
                <td><?= $building->__get('address')->city; ?></td>
                <td><a href="/buildings/show/<?= $building->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
