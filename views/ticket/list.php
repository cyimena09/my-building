

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
