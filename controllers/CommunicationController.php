<?php


class CommunicationController extends AbstractController {

    public function __construct () {
        $this->dao = new CommunicationDao();
    }

    public function index () {
        $user = $this->isLogged();
        // todo a terminer
        $communications = $this->dao->getCommunicationsByBuildingId(1);

        $content = '../views/communication/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $ticket = $this->dao->getCommunicationById($id);

        $content = '../views/communication/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $user = $this->isLogged();
        $data['fkUser'] = $user->id;
        $data['fkBuilding'] = 1;

        if ($this->dao->createCommunication($data)) {
            $successMessage = 'Le communication a bien été envoyé.';
        } else {
            $errorMessage = "Désolé, le communication n'a pas pu être envoyé.";
        }

        $content = '../views/communication/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function createView () {
        $user = $this->isLogged();

        $content = '../views/communication/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}