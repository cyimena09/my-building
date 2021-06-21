<h1>Tickets</h1>
<table>
    <thead>
    <tr>
        <th>Numéro</th>
        <th>Sujet</th>
        <th>Statut</th>
        <th>Créé le</th>
        <th>Mise à jour</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($tickets)): ?>
        <?php foreach ($tickets as $ticket) : ?>
            <tr>
                <td><?= $ticket->__get('id'); ?></td>
                <td><?= $ticket->__get('subject'); ?></td>

                <!-- Statut du ticket pour le syndic -->
                <?php if ($authenticatedUser->__get('role')->name == RoleEnum::SYNDIC) : ?>
                    <td>
                        <label for="status"></label>
                        <select name="idStatus" id="<?= $ticket->__get('id'); ?>">
                            <?php foreach ($status as $statu): ?>
                                <?php if ($ticket->__get('status')->name == $statu->name): ?>
                                    <option value="<?= $ticket->__get('status')->id; ?>"
                                            selected="selected"><?= $ticket->__get('status')->name; ?></option>
                                <?php endif; ?>
                                <?php if ($ticket->__get('status')->name !== $statu->name): ?>
                                    <option value="<?= $statu->id; ?>"><?= $statu->name; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>

                    <!-- Statut du ticket pour les autres utilisateurs (seul un syndic peut modifier le ticket) -->
                <?php else: ?>
                    <td>
                        <?php foreach ($status as $statu): ?>
                            <p class="status-ticket">
                                <?php if ($ticket->__get('status')->name == $statu->name && $statu->name == StatusEnum::NON_TRAITE): ?>
                                    <span class="bg-error"><?= $ticket->__get('status')->name; ?></span>
                                <?php elseif ($ticket->__get('status')->name == $statu->name && $statu->name == StatusEnum::EN_ATTENTE): ?>
                                    <span class="bg-orange"><?= $ticket->__get('status')->name; ?></span>
                                <?php elseif ($ticket->__get('status')->name == $statu->name && $statu->name == StatusEnum::TRAITE) : ?>
                                    <span class="bg-success"><?= $ticket->__get('status')->name; ?></span>
                                <?php endif; ?>
                            </p>
                        <?php endforeach; ?>
                    </td>
                <?php endif; ?>

                <!-- Date de création -->
                <td><?= $ticket->__get('dateCreation'); ?></td>
                <td><?= $ticket->__get('lastUpdate'); ?></td>
                <td>
                    <a href="/tickets/show/<?= $ticket->__get('id'); ?>"><i class="fas fa-edit icon-update"></i></a>
                    <!-- Un ticket n'est supprimable que par un syndic ou le propriétaire-->
                    <?php if ($ticket->__get('user')->id == $authenticatedUser->id || $authenticatedUser->role->name == RoleEnum::SYNDIC): ?>
                        <a href="/tickets/delete/<?= $ticket->__get('id'); ?>"><i
                                    class="fas fa-trash icon-delete"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<script src="/js/ticket.js"></script>