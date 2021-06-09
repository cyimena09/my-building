<div id="user-space-menu">
    <ul >
        <li><a href="/auth/accountView">Votre compte</a></li>
        <li><a href="/communication">Liste des communications</a></li>
    </ul>
    <!-- ROLE == TENANT -->
    <?php if ($user->role == 'TENANT'): ?>
        <!--TICKETS-->
        <ul>
            <li><a href="/ticket">Voir mes tickets</a></li>
            <li><a href="/ticket/createView">Créer un ticket</a></li>
        </ul>
    <?php endif; ?>

    <!-- ROLE == SYNDIC -->
    <?php if ($user->role == 'SYNDIC'): ?>
        <!--COMMUNICATION-->
        <h3>Communications</h3>
        <ul>
            <li><a href="/communication/createView">Nouvelle communication</a></li>
        </ul>
        <!-- IMMEUBLES -->
        <h3>Immeubles</h3>
        <ul>
            <li><a href="/building">Liste des immeubles</a></li>
            <li><a href="/building/createView">Ajouter un immeuble</a></li>
        </ul>
        <!-- APPARTEMENTS -->
        <h3>Appartements</h3>
        <ul>
            <li><a href="/apartment">Liste des appartements</a></li>
            <li><a href="/apartment/createView">Ajouter un appartement</a></li>
        </ul>
        <!-- PROPRIETAIRES -->
        <h3>Propriétaires</h3>
        <ul>
            <li><a href="/user">Liste des utilisateurs</a></li>
        </ul>
    <?php endif; ?>
</div>
