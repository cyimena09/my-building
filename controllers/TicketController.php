<?php


class TicketController extends AbstractController {

    private $statusDao;
    public function __construct() {
        $this->dao = new TicketDao();
        $this->statusDao = new StatusDao();
        $this->apartmentDao = new ApartmentDao();
    }

    /**
     * Retourne tous les tickets (uniquement pour le syndicat)
     */
    public function index() {
        $authenticatedUser = $this->isLogged();
        $tickets = $this->dao->getTickets();
        $status = $this->statusDao->getStatus();
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
        $tickets = $this->dao->getDataByFilter('fkUser', $authenticatedUser->id);
        $status = $this->statusDao->getStatus();
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
        // on récupère le batiment dans lequel l'utilisateur vis
        $apartmentRented = $this->apartmentDao->getApartmentById($authenticatedUser->apartment->id);
        $tickets = $this->dao->getDataByFilter('fkBuilding', $apartmentRented->building->id);
        $status = $this->statusDao->getStatus();
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
        include "../utils/functions.php";
        $authenticatedUser = $this->isLogged();
        $data['idUser'] = $authenticatedUser->id;
        // on récupère la résidence pour l'associer au ticket
        $apartment = $this->apartmentDao->getApartmentById($authenticatedUser->apartment->id);
        $data['idBuilding'] =  $apartment->building->id;

        if ($this->dao->createTicket($data)) {
            $successMessage = 'Un nouveau ticket a été créé !';
        } else {
            $errorMessage = "Désolé, le ticket n'a pas pu être créé.";
        }

        $tickets = $this->dao->getDataByFilter('fkUser', $authenticatedUser->id);
        $status = $this->statusDao->getStatus();
        $content = '../views/ticket/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
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

    public function update($id, $data) {
        include "../utils/functions.php";
        $authenticatedUser = $this->isLogged();
        $idTicket = $data['idTicket'];

        if (!$this->dao->updateTicket($idTicket, $data)) {
            return http_response_code(401);
        }
    }

    public function updateStatus($id, $data) {
        $authenticatedUser = $this->isLogged();
        $idTicket = $data['idTicket'];

        if (!$this->dao->updateStatus($idTicket, $data)) {
            return http_response_code(401);
        }
    }

    /**
     * Supprime un ticket.
     * Un ticket ne peut être supprimé que si l'utilisateur est syndic ou créateur du ticket
     * @param $id
     */
    public function delete($id) {
        $authenticatedUser = $this->isLogged();
        $ticket = $this->dao->getTicketById($id);

        if ($ticket->user->id == $authenticatedUser->id || $authenticatedUser->role->name == RoleEnum::SYNDIC) {
            $this->dao->deleteTicket($id);
        }

        if ($authenticatedUser->role->name != RoleEnum::SYNDIC) {
            $this->ticketByUserView();
        } else {
            $this->index();
        }
    }

}