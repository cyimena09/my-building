<?php


class UserController extends AbstractController {

    public function __construct() {
        $this->dao = new UserDao();
    }

    /**
     * Affiche la liste de tous les locataires et propriétaire
     */
    public function index() {
        $authenticatedUser = $this->isLogged();

        $filter = 'role'; // champ dans la db
        $value = 'LOCATAIRE'; // valeur du champ  todo utiliser l'enum
        $users = $this->dao->getUsers();
//
//        // pour chaque utilisateurs on affiche leur immeuble
//        $buildingDao = new BuildingDao();
//
//        foreach ($users as $user) {
//            $building = $buildingDao->getBuildingById($user->building->id);
//            $user->building = $building;
//        }

        $content = '../views/user/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }
//
//    /**
//     * Affiche la liste de tout les utilisateurs avec leur immeuble
//     */
//    public function ownerView() {
//        $user = $this->isLogged();
//        $users = $this->dao->getUsers();
//
//        // pour chaque utilisateurs on affiche leur immeuble
//        $buildingDao = new BuildingDao();
//
//        foreach ($users as $user) {
//            $building = $buildingDao->getBuildingById($user->building->id);
//            $user->building = $building;
//        }
//
//        $content = 'list.php';
//        include ('../views/header.php');
//        include ('../views/user/user-space.php');
//        include ('../views/footer.php');
//    }

    public function show($id) {
        $authenticatedUser = $this->isLogged(); // attention ici il s'agit de vérifier que l'utilisateur est connecté

        $user = $this->dao->getUserById($id); // cette variable contient les informations de l'utilisateur à afficher

        // récupéraiton de l'appartement loué
        $apartmentDao = new ApartmentDao();
        $buildingDao = new BuildingDao();

        // récupérations des locations
        $rentedApartments = $apartmentDao->getApartmentsByFilter('fkTenant', $user->id);
        // on ajoute aux appartements leurs immeubles
        foreach ($rentedApartments as $rentedApartment) {
            $building = $buildingDao->getBuildingById($rentedApartment->building);
            $rentedApartment->building = $building;
        }

        // récupération des propriétés
        $ownedApartments = $apartmentDao->getApartmentsByFilter('fkOwner', $user->id);
        // on ajoute aux appartements leurs immeubles
        foreach ($ownedApartments as $ownedApartment) {
            $building = $buildingDao->getBuildingById($ownedApartment->building);
            $ownedApartment->building = $building;
        }

        $content = '../views/user/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function delete($id) {
        $authenticatedUser = $this->isLogged();

        $this->dao->deleteUser($id);

        // pour l'instant notre application ne permet de supprimer des utilisateurs depuis la liste d'user
        // ou depuis un appartement. Le code si dessous définit ou l'internaute sera dirigé après la suppression
        // en fonction de la page ou la suppression a été fait
        if (isset($_GET['apartment'])) {
            $apartmentController = new ApartmentController();
            $apartmentController->show($_GET['apartment']);
        } else {
            $this->index();
        }
    }

}
