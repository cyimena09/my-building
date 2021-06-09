<?php


class MessageController extends AbstractController {

    public function __construct () {
        $this->dao = new MessageDao();
    }

    public function index () {
        $user = $this->isLogged();
        $content = '../views/message/list.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $ticket = $this->dao->getMessageById($id);
        $content = '../message/one.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $user = $this->isLogged();
        $data['fkUser'] = $user->id;

        if ($this->dao->createTicket($data)) {
            $successMessage = 'Le message a bien été envoyé.';
        } else {
            $errorMessage = "Désolé, le message n'a pas pu être envoyé.";
        }

        $content = '../views/message/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function createView () {
        $user = $this->isLogged();
        $content = '../views/message/create-form.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}