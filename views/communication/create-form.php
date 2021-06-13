<div class="page">
    <div class="content-page">
        <h1>Envoyer une communication</h1>
        <form action="/communication/create" method="post">


            <!-- Choix de la résidence -->
            <div class="group">
                <label class="label" for="fkBuilding">Choisissez la résidence</label>
                <select name="fkBuilding" id="fkBuilding">
                    <!-- Lorsque la résidence est inqué dans l'url (arrive lorsque l'on charge la page depuis une résidence) -->
                    <?php if (isset($_GET['idBuilding'])): ?>
                        <?php foreach ($buildings as $building): ?>
                            <?php if ($_GET['idBuilding'] == $building->id): ?>
                                <option value="<?= ($_GET['idBuilding']) ?>"
                                        selected="selected"><?= $building->__get('name') ?></option>
                            <?php endif; ?>
                            <?php if ($_GET['idBuilding'] !== $building->id): ?>
                                <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <?php foreach ($buildings as $building): ?>
                            <option value="<?= $building->__get('id'); ?>"><?= $building->__get('name'); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="group">
                <label for="subject"></label>
                <input id="subject" name="subject" placeholder="Sujet">
            </div>
            <div class="group">
                <label for="message">Message</label>
                <textarea id="message" name="message" cols="30" rows="10"></textarea>
            </div>
            <?php if (isset($_GET['idBuilding'])): ?>
                <input type="hidden" name="fkBuilding" value="<?= $_GET['idBuilding']; ?>">
            <?php elseif (!empty($idBuilding)): ?>
                <input type="hidden" name="fkBuilding" value="<?= $idBuilding; ?>">
            <?php endif; ?>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>
