<?php


class BuildingController extends AbstractController {

    public function __construct () {
        $this->dao = new BuildingDao();
    }

    public function index () {
        $user = $this->isLogged();
        $buildings = $this->dao->getBuildings();

        $content = '../views/building/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $user = $this->isLogged();
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

    public function create ($id, $data) {
        $user = $this->isLogged();
        $this->dao->createBuilding($data);
        $this->index();
    }

    public function createView () {
        $user = $this->isLogged();

        $content = '../views/building/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}