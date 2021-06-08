<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nom de l'immeuble</th>
        <th>Nombre d'appatement</th>
        <th>Ville</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php if (!empty($buildings)): ?>
        <?php foreach ($buildings as $building): ?>
            <tr>
                <td></td>
                <td><?= $building->__get('name'); ?></td>
                <td></td>
                <td></td>
                <td><a class="btn bg-yellow" href="/building/show/<?= $building->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
