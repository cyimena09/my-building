<?php


class TicketController extends AbstractController {

    public function __construct() {
        $this->dao = new TicketDao();
    }

    /**
     * Retourne tous les tickets (uniquement pour le syndicat)
     */
    public function index() {
        $authenticatedUser = $this->isLogged();
        $tickets = $this->dao->getTickets();

        $content = '../views/ticket/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    /**
     * Retourne les tickets créé par un utilisateur
     */
    public function ticketByUserView() {
        $authenticatedUser = $this->isLogged();

        $tickets = $this->dao->getTicketsByFilter('fkUser', $authenticatedUser->id);

        $content = '../views/ticket/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    /**
     * Retourne tous les tickets d'un immeuble
     */
    public function ticketByBuildingView() {
        $authenticatedUser = $this->isLogged();

        $tickets = $this->dao->getTicketsByFilter('fkBuilding', $authenticatedUser->id);

        $content = '../views/ticket/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show($id) {
        $authenticatedUser = $this->isLogged();
        $ticket = $this->dao->getTicketById($id);

        $content = '../views/ticket/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create($id, $data) {
        $authenticatedUser = $this->isLogged();
        $data['fkUser'] = $authenticatedUser->id;

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

    public function createView() {
        $authenticatedUser = $this->isLogged();

        $content = '../views/ticket/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function updateStatus($id, $data) {
        $authenticatedUser = $this->isLogged();

        $idTicket = $data['idTicket'];

        $this->dao->updateStatus($idTicket, $data);
    }

}