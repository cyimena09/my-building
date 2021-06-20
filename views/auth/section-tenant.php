<div id="tenant" class="group">
    <h3>ajouter votre résidence</h3>
    <label class="label" for="fkBuildingRented">Dans quelle résidence vivez-vous ?</label>
    <select class="test" name="fkBuilding" id="fkBuildingRented">
        <option value="" selected>Choissiez votre résidence</option>
        <?php foreach ($buildings as $building): ?>
            <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Container pour la liste des appartements -->
    <div id="js-result-rented" style="visibility: hidden;">

    </div>
</div>