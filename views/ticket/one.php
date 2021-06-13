<div>
    <h1>Information sur le ticket</h1>
    <form action="" method="post">
        <div class="group">
            <label for="id"></label>
            <input id="id" type="text" placeholder="Numéro de ticket" name="id"
                   value="<?= $ticket->id ?>">
        </div>
        <div class="group">
            <label for="subject"></label>
            <input id="subject" type="text" placeholder="Sujet" name="subject"
                   value="<?= $ticket->subject ?>">
        </div>
        <div class="group">
            <p>Date de création : <?= $ticket->dateCreation ?></p>
            <p>Dernière mise à jour : <?= $ticket->lastUpdate ?></p>
        </div>
        <div class="group">
            <p>Statut : <?= $ticket->status ?></p>
        </div>
        <div class="group">
            <label for="description"></label>
            <textarea id="description" name="description" cols="30" rows="10" placeholder="Description"><?= $ticket->description ?></textarea>
        </div>
        <button>Mettre à jour</button>
    </form>
</div>
