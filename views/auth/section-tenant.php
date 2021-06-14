<div class="group">
    <label class="label" for="fkBuilding">Choisissez votre résidence</label>
    <select name="fkBuilding" id="fkBuilding">
        <?php foreach ($buildings as $building): ?>
            <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div id="js-result" style="visibility: hidden">

</div>
