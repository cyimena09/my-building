<?php $i = 0; ?>
<h1>Liste des appartements par immeubles</h1>
<?php if (!empty($buildings)): ?>
    <?php foreach ($buildings as $building): ?>
        <section>
            <div class="head" style="flex-direction: row">
                <h2><?= $building->__get('name'); ?></h2>
                <a href="/buildings/show/<?= $building->__get('id'); ?>">Voir</a>
            </div>
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
        </section>
    <?php endforeach; ?>
<?php endif; ?>
