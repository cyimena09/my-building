<?php


class UserController extends AbstractController {

    public function __construct() {
        $this->dao = new UserDao();
        $this->apartmentDao = new ApartmentDao();
        $this->buildingDao = new BuildingDao();
    }

    /**
     * Affiche la liste de tous les locataires et propriétaire
     */
    public function index() {
        $authenticatedUser = $this->isLogged();
        $users = $this->dao->getUsers();
        $content = '../views/user/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show($id) {
        $authenticatedUser = $this->isLogged(); // l'utilisateur est connecté
        $user = $this->dao->getUserById($id); // l'utilisateur à afficher
        // récupéraiton de l'appartement loué si locataire ou locataire résident
        if ($user->role->name !== RoleEnum::PROPRIETAIRE) {
            $rentedApartment= $this->apartmentDao->getApartmentById($user->apartment->id);
            if ($rentedApartment->id === null) {
                $rentedApartment = null;
            }
        }
        // récupération des propriétés si l'utilisateur n'est pas un locataire
        if ($user->role->name !== RoleEnum::LOCATAIRE) {
            $ownedApartments = $this->apartmentDao->getDataByFilter('fkOwner', $user->id);
            if ($ownedApartments->id === null) {
                $ownedApartments = null;
            }
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
