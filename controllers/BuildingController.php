<?php


class BuildingController extends AbstractController {

    public function __construct() {
        $this->dao = new BuildingDao();
    }

    public function index() {
        $authenticatedUser = $this->isLogged();

        $buildings = $this->dao->getBuildingsWithNbApartmentsAndAddress();

        $content = '../views/building/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show($id) {
        $authenticatedUser = $this->isLogged();
        $building = $this->dao->getBuildingById($id);

        // récupération des appartments
        $apartmentDao = new ApartmentDao();
        $apartments = $apartmentDao->getApartmentsByBuildingId($building->id);
        // récupération des communications
        $communicationDao = new communicationDao();
        $communications = $communicationDao->getCommunicationsByBuildingId($building->id);
        // récupération des tickets
        $ticketDao = new ticketDao();
        $tickets = $ticketDao->getTicketsByBuildingId($building->id);

        $content = '../views/building/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create($id, $data) {
        $authenticatedUser = $this->isLogged();

        if (!$this->dao->createBuilding($data)) {
        $errorMessage = "L'immeuble n'a pas pu être sauvegardé, veuillez vérifier tous les champs.";
        $content = '../views/building/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
        } else {
            $this->index();
        }
    }

    public function createView() {
        $authenticatedUser = $this->isLogged();

        $content = '../views/building/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function update($id, $data) {
        $authenticatedUser = $this->isLogged();

        $idBuilding = $data['idBuilding'];
        $this->dao->updateBuilding($idBuilding, $data);
    }

    public function delete($id) {
        $authenticatedUser = $this->isLogged();

        $this->dao->deleteBuilding($id);
        $this->index();
    }

}