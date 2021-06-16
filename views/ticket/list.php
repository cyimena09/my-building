<?php
include('../enumerations/statusEnum.php');
$enums = statusEnum();
?>
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
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= $ticket->__get('id'); ?></td>
                <td><?= $ticket->__get('subject'); ?></td>

                <!-- Statut du ticket pour le syndic -->
                <?php if ($authenticatedUser->__get('role') == 'SYNDIC'): ?>
                    <td>
                        <label for="status"></label>
                        <select name="status" id="<?= $ticket->__get('id'); ?>">
                            <?php foreach ($enums as $enum): ?>
                                <?php if ($ticket->__get('status') == $enum): ?>
                                    <option value="<?= $ticket->__get('id'); ?>"
                                            selected="selected"><?= $ticket->__get('status'); ?></option>
                                <?php endif; ?>
                                <?php if ($ticket->__get('status') !== $enum): ?>
                                    <option value="<?= $enum; ?>"><?= $enum; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>

                    <!-- Statut du ticket pour les autres utilisateurs-->
                <?php else : ?>
                    <td>
                        <?php foreach ($enums as $enum): ?>
                            <p class="status-ticket">
                                <?php if ($ticket->__get('status') == $enum && $enum == 'Non traité'): ?>
                                    <span class="bg-error"><?= $ticket->__get('status'); ?></span>
                                <?php elseif ($ticket->__get('status') == $enum && $enum == 'En attente'): ?>
                                    <span class="bg-orange"><?= $ticket->__get('status'); ?></span>
                                <?php elseif ($ticket->__get('status') == $enum && $enum == 'Traité'): ?>
                                    <span class="bg-success"><?= $ticket->__get('status'); ?></span>
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
                    <?php if ($ticket->__get('user') == $authenticatedUser->id || $authenticatedUser->role == 'SYNDIC'): ?>
                        <a href="/tickets/delete/<?= $ticket->__get('id'); ?>?tt=oui"><i class="fas fa-trash icon-delete"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<script src="/js/ticket.js"></script>