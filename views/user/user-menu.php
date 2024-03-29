<div id="user-space-menu">
    <div class="group account-group">
        <i class="fas fa-user-circle"></i><a href="/auth/accountView">Votre compte</a>
    </div>

    <!-- ROLE == LOCATAIRE OU PROPRIETAIRE RESIDENT -->
    <?php if ($authenticatedUser->role->name === RoleEnum::LOCATAIRE || $authenticatedUser->role->name === RoleEnum::PROPRIETAIRE_RESIDENT): ?>
        <!-- Tickets -->
        <div class="group">
            <h3><i class="fas fa-tasks"></i>Tickets</h3>
            <ul>
                <li><a href="/tickets/ticketByUserView">Vos tickets</a></li>
                <li><a href="/tickets/ticketByBuildingView">Tous les tickets</a></li>
                <li><a href="/tickets/createView">Créer un ticket</a></li>
            </ul>
        </div>

        <!-- Communication -->
        <div class="group">
            <h3><i class="fas fa-comments"></i>Communications</h3>
            <ul>
                <li><a href="/communications/communicationByBuildingView">Voir les communications</a></li>
            </ul>
        </div>
    <?php endif; ?>

    <!-- ROLE == SYNDIC -->
    <?php if ($authenticatedUser->role->name === RoleEnum::SYNDIC): ?>
        <!-- Communication -->
        <div class="group">
            <h3><i class="fas fa-comments"></i>Communications</h3>
            <ul>
                <li><a href="/communications">Voir les communications</a></li>
                <li><a href="/communications/createView">Nouvelle communication</a></li>
            </ul>
        </div>

        <!-- Tickets -->
        <div class="group">
            <h3><i class="fas fa-tasks"></i>Tickets</h3>
            <ul>
                <li><a href="/tickets">Voir les tickets</a></li>
            </ul>
        </div>

        <!-- Immeubles -->
        <div class="group">
            <h3><i class="fas fa-building"></i>Résidences</h3>
            <ul>
                <li><a href="/buildings">Liste des résidences</a></li>
                <li><a href="/buildings/createView">Ajouter une résidence</a></li>
            </ul>
        </div>

        <!-- Appartements -->
        <div class="group">
            <h3><i class="fas fa-door-closed"></i>Appartements</h3>
            <ul>
                <li><a href="/apartments">Liste des appartements</a></li>
                <li><a href="/apartments/createView">Ajouter un appartement</a></li>
            </ul>
        </div>

        <!-- Utilisateurs -->
        <div class="group">
            <h3><i class="fas fa-users"></i>Utilisateurs</h3>
            <ul>
                <li><a href="/users">Liste des utilisateurs</a></li>
                <li><a href="/requests">Demandes d'affiliation</a></li>
            </ul>
        </div>
    <?php endif; ?>
</div>