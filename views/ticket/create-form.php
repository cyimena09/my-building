<?php $buildings ?>

<div class="page">
    <div class="content-page">
        <h1>Créer un nouveau ticket</h1>
        <form class="form-in-column" action="/tickets/create" method="post">
            <div class="group">
                <label for="subject"></label>
                <input id="subject" name="subject" placeholder="Sujet">
            </div>

            <div class="group">


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
                <label for="description">Description</label>
                <textarea id="description" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="group">
                <button type="submit">Créer le ticket</button>
            </div>
        </form>
    </div>
</div>