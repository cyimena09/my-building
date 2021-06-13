<div>
    <h1>Information sur le ticket</h1>
    <form action="" method="post">
        <div class="group">
            <label for="id">Numéro du ticket :</label>
            <input id="id" type="text" placeholder="Numéro du ticket" name="id"
                   value="<?= $ticket->id ?>">
        </div>
        <div class="group">
            <label for="subject">Sujet :</label>
            <input id="subject" type="text" placeholder="Sujet" name="subject"
                   value="<?= $ticket->subject ?>">
        </div>
        <div class="group">
            <p>Date de création : <?= $ticket->dateCreation ?></p>
            <p>Dernière mise à jour : <?= $ticket->lastUpdate ?></p>
        </div>

        <div>


        <p class="group status-ticket">
            <?php if ($ticket->__get('status')  == 'Non traité'): ?>
                <span class="bg-error"><?= $ticket->__get('status'); ?></span>
            <?php elseif ($ticket->__get('status') == 'En attente'): ?>
                <span class="bg-orange"><?= $ticket->__get('status'); ?></span>
            <?php elseif ($ticket->__get('status') == 'Traité'): ?>
                <span class="bg-success"><?= $ticket->__get('status'); ?></span>
            <?php endif; ?>
        </p>
        </div>


        <div class="group">
            <label for="description"></label>
            <textarea id="description" name="description" cols="30" rows="10" placeholder="Description"><?= $ticket->description ?></textarea>
        </div>
        <button>Mettre à jour</button>
    </form>
</div>
