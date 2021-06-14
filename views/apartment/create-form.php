<div class="page">
    <div class="content-page">
        <h1>Ajouter un nouvel appartement</h1>
        <form id="form-create-apartment" class="form-in-column" action="/apartments/create" method="post">
            <div class="group">
                <label for="name"></label>
                <input id="name" type="text" placeholder="Nom de l'appartement" name="name">
            </div>

            <div class="group">
                <label for="idBuilding">A quel immeuble appartient-il ? </label>
                <select name="status" id="idBuilding">
                    <!--                    Si on sait a quel immeuble il faut affecter l'appartement-->
                    <?php if (isset($_GET['idBuilding'])): ?>
                        <?php foreach ($buildings as $building): ?>
                            <?php if ($_GET['idBuilding'] == $building->__get('id')) : ?>
                                <option value="<?= $building->__get('id'); ?>"
                                        selected="selected"><?= $building->__get('name'); ?></option>
                            <?php endif; ?>
                            <?php if ($_GET['idBuilding'] != $building->__get('id')) : ?>
                                <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!--                    Si on ne sait pas à quel immeuble il faut ajouter l'appartement-->
                    <?php if (!isset($_GET['idBuilding'])): ?>
                        <?php foreach ($buildings as $building): ?>
                            <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
            </div>

            <?php if (isset($_GET['idBuilding'])): ?>
                <input type="hidden" name="fkBuilding" value="<?= $_GET['idBuilding']; ?>">
            <?php elseif (!empty($idBuilding)): ?>
                <input type="hidden" name="fkBuilding" value="<?= $idBuilding; ?>">
            <?php endif; ?>

            <div class="group">
                <button type="submit">Enregistrer</button>
            </div>

        </form>
    </div>
</div>
<script src="/js/apartment.js"></script>