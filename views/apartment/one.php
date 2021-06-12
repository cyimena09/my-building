<div>
    <h1>Information sur l'appartement</h1>

    <form action="/apartment/update/<?= $apartment->id ?>" method="post">
        <div class="group">
            <label for="name"></label>
            <input id="name" type="text" placeholder="Nom de l'immeuble" name="name"
                   value="<?= $apartment->name ?>">
        </div>
        <button>Mettre à jour</button>
    </form>

    <!-- Locataire de l'appartement -->
    <h2>Ses appartements</h2>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        <?php if (!empty($tenants)): ?>
            <?php foreach ($tenants as $tenant): ?>
                <tr>
                    <td></td>
                    <td><?= $tenant->__get('firstName'); ?></td>
                    <td><?= $tenant->__get('lastName'); ?></td>
                    <td>
                        <a href="/user/show/<?= $tenant->__get('id'); ?>">Voir</a>
                        <a href="/user/delete/<?= $tenant->__get('id'); ?>">Voir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>
