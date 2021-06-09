<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Sujet</th>
        <th>Date d'envoi</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($communications)): ?>
        <?php foreach ($communications as $communication): ?>
            <tr>
                <th>1</th>
                <td><?= $communication->__get('subject'); ?></td>
                <td><?= $communication->__get('dateCreation'); ?></td>
                <td><a href="/communication/show/<?= $communication->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
