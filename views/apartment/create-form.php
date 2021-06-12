<div class="page">
    <div class="content-page">
        <h1>Ajouter un nouvel appartement</h1>
        <form action="/apartment/create" method="post">
            <div class="group">
                <label for="name"></label>
                <input id="name" type="text" placeholder="Nom de l'appartement" name="name">
            </div>

            <?php if (isset($_GET['idBuilding'])): ?>
                <input type="hidden" name="fkBuilding" value="<?= $_GET['idBuilding']; ?>">
            <?php elseif (!empty($idBuilding)): ?>
                <input type="hidden" name="fkBuilding" value="<?= $idBuilding; ?>">
            <?php endif; ?>

            <button type="submit">Enregistrer</button>
        </form>
    </div>
</div>