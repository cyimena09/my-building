<div id="user-space-menu">
    <div class="group account-group">
        <i class="fas fa-user-circle"></i><a href="/auth/accountView">Votre compte</a>
    </div>

    <!-- ROLE == TENANT -->
    <?php if ($authenticatedUser->role == 'LOCATAIRE'): ?>
        <!-- Tickets -->
        <div class="group">
            <h3><i class="fas fa-tasks"></i>Tickets</h3>
            <ul>
                <li><a href="/ticket/ticketByUserView">Vos tickets</a></li>
                <li><a href="/ticket/ticketByBuildingView">Tous les tickets</a></li>
                <li><a href="/ticket/createView">Créer un ticket</a></li>
            </ul>
        </div>

        <!-- Communication -->
        <div class="group">
            <h3><i class="fas fa-comments"></i>Communications</h3>
            <ul>
                <li><a href="/communication/communicationByBuildingView">Voir les communications</a></li>
            </ul>
        </div>
    <?php endif; ?>

    <!-- ROLE == SYNDIC -->
    <?php if ($authenticatedUser->role == 'SYNDIC'): ?>
        <!-- Communication -->
        <div class="group">
            <h3><i class="fas fa-comments"></i>Communications</h3>
            <ul>
                <li><a href="/communication">Voir les communications</a></li>
                <li><a href="/communication/createView">Nouvelle communication</a></li>
            </ul>
        </div>

        <!-- Tickets -->
        <div class="group">
            <h3><i class="fas fa-tasks"></i>Tickets</h3>
            <ul>
                <li><a href="/ticket">Voir les tickets</a></li>
            </ul>
        </div>

        <!-- Immeubles -->
        <div class="group">
            <h3><i class="fas fa-building"></i>Immeubles</h3>
            <ul>
                <li><a href="/building">Liste des immeubles</a></li>
                <li><a href="/building/createView">Ajouter un immeuble</a></li>
            </ul>
        </div>

        <!-- Appartements -->
        <div class="group">
            <h3><i class="fas fa-door-closed"></i>Appartements</h3>
            <ul>
                <li><a href="/apartment">Liste des appartements</a></li>
                <li><a href="/apartment/createView">Ajouter un appartement</a></li>
            </ul>
        </div>

        <!-- Utilisateurs -->
        <div class="group">
            <h3><i class="fas fa-users"></i>Utilisateurs</h3>
            <ul>
                <li><a href="/user">Liste des utilisateurs</a></li>
            </ul>
        </div>

    <?php endif; ?>
</div>
