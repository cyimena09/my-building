<h1>Information sur le ticket</h1>
<section>
    <form id="form-update-ticket" class="form-in-column" action="" method="post">
        <div class="group group-hover">
            <label for="idTicket">Numéro du ticket</label>
            <input id="idTicket" type="text" placeholder="Numéro du ticket" name="idTicket"
                   value="<?= $ticket->id ?>" disabled>
        </div>
        <div class="group group-hover">
            <label for="subject">Sujet</label>
            <input id="subject" type="text" placeholder="Sujet" name="subject"
                   value="<?= $ticket->subject ?>" <?php if ($authenticatedUser->__get('role')->name == RoleEnum::SYNDIC): ?> disabled <?php endif; ?>>
        </div>
        <div class="group group-hover">
            <p>Date de création</p>
            <p><?= $ticket->dateCreation ?></p>
        </div>

        <div class="group group-hover">
            <p>Dernière mise à jour</p>
            <p><?= $ticket->lastUpdate ?></p>
        </div>

        <!--        Statut si non syndic -->
        <?php if ($authenticatedUser->__get('role')->name != RoleEnum::SYNDIC): ?>
            <div>
                <p class="group status-ticket">
                    <?php if ($ticket->__get('status')->name == StatusEnum::NON_TRAITE): ?>
                        <span class="bg-error"><?= $ticket->__get('status')->name; ?></span>
                    <?php elseif ($ticket->__get('status')->name == StatusEnum::EN_ATTENTE): ?>
                        <span class="bg-orange"><?= $ticket->__get('status')->name; ?></span>
                    <?php elseif ($ticket->__get('status')->name ==  StatusEnum::TRAITE): ?>
                        <span class="bg-success"><?= $ticket->__get('status')->name; ?></span>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- Statut du ticket pour le syndic -->
        <?php if ($authenticatedUser->__get('role') == RoleEnum::SYNDIC): ?>
            <div class="group">
                <select name="status" id="<?= $ticket->__get('id'); ?>">
                    <?php foreach (StatusEnum::StatusList as $enum): ?>
                        <?php if ($ticket->__get('status')->name == $enum): ?>
                            <option value="<?= $ticket->__get('id'); ?>"
                                    selected="selected"><?= $ticket->__get('status')->name; ?></option>
                        <?php endif; ?>
                        <?php if ($ticket->__get('status')->name !== $enum): ?>
                            <option value="<?= $enum; ?>"><?= $enum; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <div class="group">
            <textarea id="description" name="description" cols="30" rows="10"
                      placeholder="Description" <?php if ($authenticatedUser->__get('role')->name == RoleEnum::SYNDIC): ?> disabled <?php endif; ?>><?= $ticket->description ?></textarea>
        </div>

        <?php if ($authenticatedUser->__get('role')->name !== RoleEnum::SYNDIC): ?>
            <div class="group">
                <button>Mettre à jour</button>
            </div>
        <?php endif; ?>
    </form>
</section>
<script src="/js/ticket.js"></script>