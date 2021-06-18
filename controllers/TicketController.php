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
     * Retourne tous les tickets de l'immeuble de l'utilisateur connecté
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

        $data['idUser'] = $authenticatedUser->id;

        if ($this->dao->createTicket($data)) {
            $successMessage = 'Un nouveau ticket a été créé !';
        } else {
            $errorMessage = "Désolé, le ticket n'a pas pu être créé.";
        }
        $this->ticketByUserView();
    }

    public function createView() {
        $authenticatedUser = $this->isLogged();

        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildings();

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

    public function update($id, $data) {
        $authenticatedUser = $this->isLogged();

        $idTicket = $data['idTicket'];
        $this->dao->updateTicket($idTicket, $data);
    }

    /**
     * Supprime un ticket.
     * Un ticket ne peut être supprimé que si l'utilisateur est syndic ou créateur du ticket
     * @param $id
     */
    public function delete($id) {
        $authenticatedUser = $this->isLogged();

        $ticket = $this->dao->getTicketById($id);

        if ($ticket->user == $authenticatedUser->id || $authenticatedUser->role == 'SYNDIC') {
            $this->dao->deleteTicket($id);
        }

        if ($authenticatedUser->role != 'SYNDIC') {
            $this->ticketByBuildingView();
        } else {
            $this->index();
        }
    }

}