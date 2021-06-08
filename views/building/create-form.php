<div class="page">
    <div class="content-page">
        <h1>Ajouter un nouvel immeuble</h1>
        <form action="/building/create">
            <div class="group">
                <label for="name"></label>
                <input id="name" type="text" placeholder="Nom de l'immeuble" name="name">
            </div>
            <div class="group">
                <label for="street"></label>
                <input id="street" type="text" placeholder="Rue" name="street">
            </div>
            <div class="group">
                <label for="houseNumber"></label>
                <input id="houseNumber" type="text" placeholder="Numéro" name="houseNumber">
            </div>
            <div class="group">
                <label for="boxNumber"></label>
                <input id="boxNumber" type="text" placeholder="Boite" name="boxNumber">
            </div>
            <div class="group">
                <label for="zip"></label>
                <input id="zip" type="text" placeholder="Code postal" name="zip">
            </div>
            <div class="group">
                <label for="city"></label>
                <input id="city" type="text" placeholder="Ville" name="city">
            </div>
            <div class="group">
                <label for="country"></label>
                <input id="country" type="text" placeholder="Pays" name="country">
            </div>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</div>