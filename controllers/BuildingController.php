<?php
include "../utils/functions.php";

class BuildingController extends AbstractController {

    public function __construct() {
        $this->dao = new BuildingDao();
    }

    public function index() {
        $authenticatedUser = $this->isLogged();
        $buildings = $this->dao->getBuildings();
        $content = '../views/building/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show($id) {
        $authenticatedUser = $this->isLogged();
        $building = $this->dao->getBuildingById($id);
        // récupération des communications
        $communicationDao = new communicationDao();
        $communications = $communicationDao->getCommunicationsByBuildingId($building->id);
        // récupération des tickets
        $ticketDao = new ticketDao();
        $tickets = $ticketDao->getDataByFilter('fkBuilding', $building->id);
        // récupération des statuts
        $statusDao = new StatusDao();
        $status = $statusDao->getStatus();
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

        if (!$this->dao->updateBuilding($idBuilding, $data)) {
            return http_response_code(401);
        }
    }

    public function delete($id) {
        $authenticatedUser = $this->isLogged();
        $this->dao->deleteBuilding($id);
        $this->index();
    }

}