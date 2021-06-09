

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
    <?php if (!empty($tickets)): ?>
        <?php foreach ($messages as $message): ?>
            <tr>
                <th>1</th>
                <td><?= $message->__get('subject'); ?></td>
                <td><?= $message->__get('dateCreation'); ?></td>
                <td><a href="/message/show/<?= $message->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
