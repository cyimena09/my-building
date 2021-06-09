<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Rôle</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td></td>
                <td><?= $user->__get('firstName'); ?></td>
                <td><?= $user->__get('lastName'); ?></td>
                <td><?= $user->__get('role'); ?></td>
                <td><?= $user->__get('phone'); ?></td>
                <td><?= $user->__get('email'); ?></td>
                <td><a href="/user/show/<?= $user->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>