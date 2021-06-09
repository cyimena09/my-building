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
        $this->dao->createMessage($data);
        $this->index();
    }

    public function createView () {
        $user = $this->isLogged();
        $content = '../views/message/create-form.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}