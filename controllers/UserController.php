<?php


class UserController extends AbstractController {

    public function __construct () {
        $this->dao = new UserDao();
    }

    /**
     * Affiche la liste de tous les locataires
     */
    public function index() {
        $authenticatedUser = $this->isLogged();

        $filter = 'role'; // champ dans la db
        $value = 'TENANT'; // valeur du champ
        $users = $this->dao->getUsersByFilter($filter, $value);

        // pour chaque utilisateurs on affiche leur immeuble
        $buildingDao = new BuildingDao();

        foreach ($users as $user) {
            $building = $buildingDao->getBuildingById($user->building->id);
            $user->building = $building;
        }

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

    public function show ($id) {
        $authenticatedUser = $this->isLogged(); // attention ici il s'agit de vérifier que l'utilisateur est connecté
        $userInfo = $this->dao->getUserById($id); // cette variable contient les informations de l'utilisateur à afficher

        $content = '../views/user/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}
