<?php


class CommunicationController extends AbstractController {

    public function __construct() {
        $this->dao = new CommunicationDao();
        $this->apartmentDao = new ApartmentDao();
    }

    public function index() {
        $authenticatedUser = $this->isLogged();
        $communications = $this->dao->getCommunications();
        $content = '../views/communication/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    /**
     * Retourne toutes les communications en fonction du filtre
     */
    public function communicationByBuildingView() {
        $authenticatedUser = $this->isLogged();
        // on récupère le batiment dans lequel l'utilisateur vis
        $apartmentRented = $this->apartmentDao->getApartmentById($authenticatedUser->apartment->id);
        $communications = $this->dao->getDataByFilter('fkBuilding', $apartmentRented->building->id);
        $content = '../views/communication/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show($id) {
        $authenticatedUser = $this->isLogged();
        $communication = $this->dao->getCommunicationById($id);
        $content = '../views/communication/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create($id, $data) {
        include "../utils/functions.php";
        $authenticatedUser = $this->isLogged();

        if ($this->dao->createCommunication($data)) {
            $successMessage = 'La communication a été envoyé.';
        } else {
            $errorMessage = "Désolé, la communication n'a pas pu être envoyé.";
        }

        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildings();
        $content = '../views/communication/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function createView() {
        $authenticatedUser = $this->isLogged();
        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildings();
        $content = '../views/communication/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function update($id, $data) {
        include "../utils/functions.php";
        $authenticatedUser = $this->isLogged();
        $idCommunication = $data['idCommunication'];

        if (!$this->dao->updateCommunication($idCommunication, $data)) {
            return http_response_code(401);
        }
    }

    /**
     * Une communication n'est supprimable que par un SYNDIC
     * @param $id
     */
    public function delete($id) {
        $authenticatedUser = $this->isLogged();

        if ($authenticatedUser->role->name == RoleEnum::SYNDIC) {
            $this->dao->deleteCommunication($id);
            $this->index();
        }
    }

}