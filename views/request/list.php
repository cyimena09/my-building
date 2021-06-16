<?php $i = 0; ?>
<h1>Demandes</h1>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Type</th>
        <th>Utilisateurs</th>
        <th>Appartements</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($requests)): ?>
        <?php foreach ($requests as $request): $i++ ?>
            <tr>
                <th><?= $i ?></th>

                <?php if ($request->__get('isOwnerRequest') == 0): ?>
                    <td><span class="ask-for bg-orange">Devenir locataire</span></td>
                <?php elseif ($request->__get('isOwnerRequest') == 1): ?>
                    <td><span class="ask-for bg-mauve">Devenir propriétaire</span></td>
                <?php endif; ?>
                <td><?= $request->__get('user')->firstName; ?> <?= $request->__get('user')->lastName; ?></td>
                <td><?= $request->__get('apartment')->name; ?></td>
                <td>
                    <a class="a-btn a-btn-dark-grey" href="/users/show/<?= $request->__get('user')->id; ?>">Voir</a>
                    <a style="font-size: 14px" class="a-btn a-btn-green" href="/requests/validate/<?= $request->__get('id'); ?>"><i class="fas fa-check"></i>Valider</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>