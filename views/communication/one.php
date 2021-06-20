<div>
    <h1>Communication</h1>
    <form id="form-update-communication" class="form-in-column"
          action="/communications/update/<?= $communication->id ?>" method="post">
        <input type="hidden" name="idCommunication"
               value="<?= $communication->id; ?>" <?php if ($authenticatedUser->role->name !== RoleEnum::SYNDIC): ?> disabled <?php endif; ?>>

        <div class="group">
            <label for="subject"></label>
            <input id="subject" type="text" placeholder="Sujet" name="subject"
                   value="<?= $communication->subject ?>" <?php if ($authenticatedUser->role->name !== RoleEnum::SYNDIC): ?> disabled <?php endif; ?>>
        </div>
        <div class="group">
            <p>Date de création : <?= $communication->dateCreation ?></p>
        </div>
        <div class="group">
            <p>Dernière mise à jour : <?= $communication->lastUpdate ?></p>
        </div>
        <div class="group">
            <label for="message"></label>
            <textarea id="message" name="message" cols="30" rows="10"
                      placeholder="Message"<?php if ($authenticatedUser->role->name !== RoleEnum::SYNDIC): ?> disabled <?php endif; ?>><?= $communication->message ?>
            </textarea>
        </div>

        <?php if ($authenticatedUser->role->name === RoleEnum::SYNDIC): ?>
            <div class="group">
                <button>Mettre à jour</button>
            </div>
        <?php endif; ?>
    </form>
</div>
<script src="/js/communication.js"></script>