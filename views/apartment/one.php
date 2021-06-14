<?php $i = 0; ?>
<div>
    <h1>Information sur l'appartement</h1>
    <section>
        <form id="form-update-apartment" class="form-in-column" action="/apartments/update/<?= $apartment->id ?>"
              method="post">
            <input type="hidden" name="idApartment" value="<?= $apartment->id; ?>">
            <div class="group">
                <label for="name"></label>
                <input id="name" type="text" placeholder="Nom de l'immeuble" name="name"
                       value="<?= $apartment->name ?>">
            </div>
            <div class="group">
                <button>Mettre à jour</button>
            </div>
        </form>
    </section>

    <!-- Propriétaire de l'appartement-->
    <section>
        <div class="head">
            <h2>Propriétaire de l'appartement</h2>
        </div>

        <p>
            <span style="margin-right: 20px; text-transform: uppercase">Prénom</span><span><?= $owner->__get('firstName'); ?></span>
        </p>
        <p>
            <span style="margin-right: 20px; text-transform: uppercase">Nom</span><span><?= $owner->__get('lastName'); ?></span>
        </p>

        <div style="margin-top: 15px">
            <a href="/users/show/<?= $owner->__get('id'); ?>">Voir</a>
        </div>
    </section>

    <!-- Locataire de l'appartement -->
    <section>
        <div class="head">
            <h2>Locataire de l'appartement</h2>
        </div>
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
            <?php if (!empty($tenants)): $i++ ?>
                <?php foreach ($tenants as $tenant): ?>
                    <tr>
                        <th><?= $i; ?></th>
                        <td><?= $tenant->__get('firstName'); ?></td>
                        <td><?= $tenant->__get('lastName'); ?></td>
                        <td>
                            <a href="/users/show/<?= $tenant->__get('id'); ?>">Voir</a>
                            <a href="/users/delete/<?= $tenant->__get('id'); ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
</div>
<script src="/js/apartment.js"></script>