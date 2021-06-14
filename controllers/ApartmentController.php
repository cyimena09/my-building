<?php


class ApartmentController extends AbstractController {

    public function __construct() {
        $this->dao = new ApartmentDao();
    }

    public function index() {
        $authenticatedUser = $this->isLogged();
        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildingsWithApartments();

        $content = '../views/apartment/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show($id) {
        $authenticatedUser = $this->isLogged();

        $apartment = $this->dao->getApartmentById($id);
        // on récupère les locataires de l'appartement
        $userDao = new UserDao();
        $tenants = $userDao->getUsersByApartmentId($id); // récupération des locataires
        $owner = $userDao->getUserById($apartment->owner); // récupération du propriétaire

        $content = '../views/apartment/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create($id, $data) {
        $authenticatedUser = $this->isLogged();

        $this->dao->createApartment($data);
    }

    public function createView() {
        $authenticatedUser = $this->isLogged();

        // récupération des immeubles
        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildings();

        $content = '../views/apartment/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function update($id, $data) {
        $authenticatedUser = $this->isLogged();

        $idApartment = $data['idApartment'];
        $this->dao->updateApartment($idApartment, $data);
    }

    /**
     * Affiche une liste déroulante d'appartements en fonction de l'id contenu dans le paramètre data
     * @param $id
     * @param $data
     */
    public function dropdown($id, $data) {
        $apartments = $this->dao->getApartmentsByBuildingId($data['idBuilding']);

        include ('../views/apartment/dropdown.php');
    }

    public function includesList() {
        // todo regrouper tous les includes
    }

}