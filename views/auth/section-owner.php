<div id="owner" class="group">
    <h3>Ajouter vos propriétés</h3>

    <label for="fkBuilding">Dans quel immeuble se trouve l'appartement ?</label>
    <select name="fkBuilding" id="fkBuildingOwned">
        <option value="" selected>Choisissez l'immeuble</option>
        <?php foreach ($buildings as $building): ?>
            <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
        <?php endforeach; ?>
    </select>


    <!-- Liste des appartments-->
    <div id="js-result-owned" style="visibility: hidden">

    </div>

    <!-- Button pour ajouter un appartement -->
    <div>
        <button type="button" id="js-add-btn">Ajouter à la liste</button>
    </div>

    <!--Liste des appartements ajoutés-->
    <div id="js-container-list-apartments" style="display: none">
        <p>Appartements ajoutés : </p>
        <ul id="js-ul">
        </ul>
    </div>

</div>