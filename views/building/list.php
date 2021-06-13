<?php $i = 0; ?>
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
                <td></td>
                <td></td>
                <td><a href="/building/show/<?= $building->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
