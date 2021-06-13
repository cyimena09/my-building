<?php
include('../enumerations/statusEnum.php');
$enums = statusEnum();
?>

<table>
    <thead>
    <tr>
        <th>Numéro</th>
        <th>Sujet</th>
        <th>Statut</th>
        <th>Créé le</th>
        <th>Dernière mise à jour</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($tickets)): ?>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= $ticket->__get('id'); ?></td>
                <td><?= $ticket->__get('subject'); ?></td>

                <!-- Statut du ticket -->
                <td>
                    <label for="status"></label>
                    <select name="status" id="status">
                        <!-- Lorsque la résidence est inqué dans l'url (arrive lorsque l'on charge la page depuis une résidence) -->
                        <?php foreach ($enums as $enum): ?>
                            <?php if ($ticket->__get('status') == $enum): ?>
                                <option value="<?= $ticket->__get('id') ?>"
                                        selected="selected"><?= $ticket->__get('status') ?></option>
                            <?php endif; ?>
                            <?php if ($ticket->__get('status') !== $enum): ?>
                                <option value="<?= $enum; ?>"><?= $enum; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>

                <!-- Date de création -->
                <td><?= $ticket->__get('dateCreation'); ?></td>
                <td><?= $ticket->__get('lastUpdate'); ?></td>

                <td></td>
                <td><a href="/ticket/show/<?= $ticket->__get('id'); ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
