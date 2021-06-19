<?php $i = 0; ?>
<h1>Communications</h1>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Sujet</th>
        <th>Date d'envoi</th>
        <th>Mise à jour</th>
        <th>Actions</th>
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
                <td>
                    <a href="/communications/show/<?= $communication->__get('id'); ?>"><i
                                class="fas fa-edit icon-update"></i></a>

                    <!-- Une communication n'est supprimable que par un syndic -->
                    <?php if ($authenticatedUser->role->name == RoleEnum::SYNDIC) : ?>
                        <a href="/communications/delete/<?= $communication->__get('id'); ?>"><i
                                    class="fas fa-trash icon-delete"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>