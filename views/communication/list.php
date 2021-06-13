<?php $i = 0; ?>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Sujet</th>
        <th>Date d'envoi</th>
        <th>Mise à jour</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($communications)): ?>
        <?php foreach ($communications as $communication): $i++; ?>
            <tr>
                <th><?= $i; ?></th>
                <td><?= $communication->__get('subject'); ?></td>
                <td><?= $communication->__get('dateCreation'); ?></td>
                <td><?= $communication->__get('lastUpdate'); ?></td>
                <td><a href="/communication/show/<?= $communication->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
