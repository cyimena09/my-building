<?php


class TicketController extends AbstractController {

    public function __construct () {
        $this->dao = new TicketDao();
    }

    public function index () {
        $user = $this->isLogged();
        $content = '../views/ticket/list.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $ticket = $this->dao->getTicketById($id);
        $content = '../ticket/one.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $this->dao->createTicket($data);
        $this->index();
    }

    public function createView () {
        $user = $this->isLogged();
        $content = '../views/ticket/create-form.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}