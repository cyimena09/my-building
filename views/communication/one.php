<div>
    <h1>Communication</h1>

    <form action="" method="post">
        <div class="group">
            <label for="subject"></label>
            <input id="subject" type="text" placeholder="Sujet" name="subject"
                   value="<?= $communication->subject ?>">
        </div>
        <div class="group">
            <p>Date de création : <?= $communication->dateCreation ?></p>
            <p>Dernière mise à jour : <?= $communication->lastUpdate ?></p>
        </div>

        <div class="group">
            <label for="message"></label>
            <textarea id="message" name="message" cols="30" rows="10" placeholder="Message"><?= $communication->message ?></textarea>
        </div>
        <button>Mettre à jour</button>
    </form>
</div>
