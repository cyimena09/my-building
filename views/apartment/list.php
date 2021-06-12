<h2>Liste des appartements par immeubles</h2>
<?php if (!empty($buildings)): ?>
    <?php foreach ($buildings as $building): ?>
        <h3><?= $building->__get('name'); ?> <a href="/building/show/<?= $building->__get('id'); ?>">Voir</a></h3>
        <ul>
            <?php foreach ($building->apartments as $apartment): ?>
                <li><?= $apartment->__get('name'); ?> <a href="/apartment/show/<?= $apartment->__get('id'); ?>">Voir</a></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
<?php endif; ?>