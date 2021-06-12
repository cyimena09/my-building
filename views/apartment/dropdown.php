<div id="dropdown-apartment" class="group">
    <label class="label" for="fkApartment">Choisissez l'appartement</label>
    <select name="fkApartment" id="fkApartment">
        <?php foreach ($apartments as $apartment): ?>
            <option value="<?= $apartment->__get('id'); ?>"><?= $apartment->__get('name'); ?></option>
        <?php endforeach; ?>
    </select>
</div>