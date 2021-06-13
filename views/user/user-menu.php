<div id="user-space-menu">
    <ul >
        <li><a href="/auth/accountView">Votre compte</a></li>
        <li><a href="/communication">Voir les communications</a></li>
    </ul>
    <!-- ROLE == TENANT -->
    <?php if ($authenticatedUser->role == 'TENANT'): ?>
        <!--TICKETS-->
        <ul>
            <li><a href="/ticket/ticketByUserView">Vos tickets</a></li>
            <li><a href="/ticket/ticketByBuildingView">Vos tickets</a></li>
            <li><a href="/ticket/createView">Créer un ticket</a></li>
        </ul>
    <?php endif; ?>

    <!-- ROLE == SYNDIC -->
    <?php if ($authenticatedUser->role == 'SYNDIC'): ?>
        <!-- Communication -->
        <h3>Communications</h3>
        <ul>
            <li><a href="/communication/createView">Nouvelle communication</a></li>
        </ul>

        <!-- Tickets -->
        <h3>Tickets</h3>
        <ul>
            <li><a href="/ticket">Voir les tickets</a></li>
        </ul>

        <!-- Immeubles -->
        <h3>Immeubles</h3>
        <ul>
            <li><a href="/building">Liste des immeubles</a></li>
            <li><a href="/building/createView">Ajouter un immeuble</a></li>
        </ul>
        <!-- Appartements -->
        <h3>Appartements</h3>
        <ul>
            <li><a href="/apartment">Liste des appartements</a></li>
            <li><a href="/apartment/createView">Ajouter un appartement</a></li>
        </ul>
        <!-- Utilisateurs -->
        <h3>Utilisateurs</h3>
        <ul>
            <li><a href="/user">Liste des utilisateurs</a></li>
        </ul>
    <?php endif; ?>
</div>
