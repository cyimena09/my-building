<?php


class CommunicationController extends AbstractController {

    public function __construct () {
        $this->dao = new CommunicationDao();
    }

//    public function index () {
//        $user = $this->isLogged();
//        // todo a terminer
//        $communications = $this->dao->getCommunicationsByBuildingId(1);
//
//        $content = '../views/communication/list.php';
//        include ('../views/header.php');
//        include ('../views/user/user-space.php');
//        include ('../views/footer.php');
//    }

    public function show ($id) {
        $user = $this->isLogged();
        $communication = $this->dao->getCommunicationById($id);

        $content = '../views/communication/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $user = $this->isLogged();

        if ($this->dao->createCommunication($data)) {
            $successMessage = 'Le communication a bien été envoyé.';
        } else {
            $errorMessage = "Désolé, le communication n'a pas pu être envoyé.";
        }

        // on récupère l'id de l'immeuble pour retourner le meme formulaire et permettre des ajouts multiples
        $idBuilding = $data['fkBuilding'];

        $content = '../views/communication/create-form.php';
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