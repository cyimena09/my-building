<?php


class TicketController extends AbstractController {

    public function __construct () {
        $this->dao = new TicketDao();
    }

    public function index () {
        $user = $this->isLogged();
        $tickets = $this->dao->getTicketsByUserId($user->id);

        $content = '../views/ticket/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $user = $this->isLogged();
        $ticket = $this->dao->getTicketById($id);

        $content = '../views/ticket/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $user = $this->isLogged();
        $data['fkUser'] = $user->id;

        if ($this->dao->createTicket($data)) {
            $successMessage = 'Un nouveau ticket a été créé !';
        } else {
            $errorMessage = "Désolé, le ticket n'a pas pu être créé.";
        }

        $content = '../views/ticket/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function createView () {
        $user = $this->isLogged();

        $content = '../views/ticket/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}