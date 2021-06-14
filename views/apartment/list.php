<?php $i = 0; ?>
<h1>Liste des appartements par immeubles</h1>
<?php if (!empty($buildings)): ?>
    <?php foreach ($buildings as $building): ?>
        <h2><?= $building->__get('name'); ?> <a href="/buildings/show/<?= $building->__get('id'); ?>">Voir</a></h2>
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
            <?php foreach ($building->apartments as $apartment): $i++ ?>
                <tr>
                    <th><?= $i; ?></th>
                    <td><?= $apartment->__get('name'); ?></td>
                    <td>xxx</td>
                    <td><a href="/apartments/show/<?= $apartment->__get('id'); ?>">Voir</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
<?php endif; ?>
