<?php


class CommunicationController extends AbstractController {

    public function __construct () {
        $this->dao = new CommunicationDao();
    }

    public function index () {
        $authenticatedUser = $this->isLogged();
        // todo a terminer
        $communications = $this->dao->getCommunications();

        $content = '../views/communication/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $authenticatedUser = $this->isLogged();
        $communication = $this->dao->getCommunicationById($id);

        $content = '../views/communication/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $authenticatedUser = $this->isLogged();

        if ($this->dao->createCommunication($data)) {
            $successMessage = 'Le communication a bien été envoyé.';
        } else {
            $errorMessage = "Désolé, le communication n'a pas pu être envoyé.";
        }

        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildings();

        $content = '../views/communication/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function createView () {
        $authenticatedUser = $this->isLogged();
        // récupération des résidences
        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildings();

        $content = '../views/communication/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}