<?php $i = 0; ?>
<h1>Utilisateurs</h1>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Role</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): $i++; ?>
            <tr>
                <th><?= $i; ?></th>
                <td><?= $user->__get('firstName'); ?></td>
                <td><?= $user->__get('lastName'); ?></td>
                <?php if ($user->__get('role')->name == RoleEnum::LOCATAIRE): ?>
                    <td><span class="ask-for bg-orange"><?= $user->__get('role')->name; ?></span></td>
                <?php elseif ($user->__get('role')->name == RoleEnum::SYNDIC) : ?>
                    <td><span class="ask-for bg-mauve"><?= $user->__get('role')->name; ?></span></td>
                <?php else : ?>
                    <td><span class="ask-for bg-success"><?= $user->__get('role')->name; ?></span></td>
                <?php endif; ?>
                <td><?= $user->__get('phone'); ?></td>
                <td><?= $user->__get('email'); ?></td>
                <td>
                    <a href="/users/show/<?= $user->__get('id'); ?>"><i class="fas fa-edit icon-update"></i></a>
                    <a href="/users/delete/<?= $user->__get('id'); ?>"><i class="fas fa-trash icon-delete"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>