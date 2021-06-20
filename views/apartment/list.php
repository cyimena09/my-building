<?php $i = 0; ?>
<h1>Liste des appartements par immeubles</h1>
<?php if (!empty($buildings)): ?>
    <?php foreach ($buildings as $building): ?>
        <section>
            <div class="head" style="flex-direction: row">
                <h2><?= $building->__get('name'); ?></h2>
                <a href="/buildings/show/<?= $building->__get('id'); ?>">Voir</a>
            </div>
            <?php if (count($building->apartments) > 0): ?>
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Numéro de l'appartement</th>
                        <th>Nombre de résident - locataire</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($building->apartments as $apartment): $i++ ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $apartment->__get('name'); ?></td>
                            <td><?= $apartment->__get('nbTenants'); ?></td>
                            <td>
                                <a href="/apartments/show/<?= $apartment->__get('id'); ?>"><i
                                            class="fas fa-edit icon-update"></i></a>
                                <a href="/apartments/delete/<?= $apartment->__get('id'); ?>"><i
                                            class="fas fa-trash icon-delete"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #9d9b9b">L'immeuble ne contient pas d'appartements</p>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
<?php endif; ?>