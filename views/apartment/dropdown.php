<div  class="group" style="border: solid red">
    <label class="label" for="fkApartment">Choisissez l'appartement</label>
    <select name="fkApartment">
        <?php foreach ($apartments as $apartment): ?>
            <option value="<?= $apartment->__get('id'); ?>"><?= $apartment->__get('name'); ?></option>
        <?php endforeach; ?>
    </select>
</div>