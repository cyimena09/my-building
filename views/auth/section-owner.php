<div id="owner" class="group">
    <h3>Ajouter votre ou vos propriétés(s)</h3>

    <label for="fkBuilding">Dans quel immeuble se trouve l'appartement ?</label>
    <select name="fkBuilding" id="fkBuildingOwned">
        <option value="" selected>Choisissez l'immeuble</option>
        <?php foreach ($buildings as $building): ?>
            <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Container pour la liste des appartements -->
    <div id="js-result-owned" style="visibility: hidden">

    </div>

    <!-- Button pour ajouter un appartement -->
    <div>
        <button type="button" id="js-add-btn">Ajouter à la liste</button>
    </div>

    <div id="js-container-list-apartments">
        <div id="js-ul">

        </div>
    </div>
</div>