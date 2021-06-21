<?php


class RequestController extends AbstractController {

    public function __construct() {
        $this->dao = new RequestDao();
        $this->userDao = new UserDao();
        $this->apartmentDao = new ApartmentDao();
    }

    /**
     * Retourne toutes les demandes d'affiliation d'appartements des utilisateurs nouvellement inscrit
     */
    public function index() {
        $authenticatedUser = $this->isLogged();
        $requests = $this->dao->getRequests();

        foreach ($requests as $request) {
            $user = $this->userDao->getUserById($request->user); // user contient l'id de l'user
            $request->user = $user;

            $apartment = $this->apartmentDao->getApartmentById($request->apartment); // appartment contient l'id de l'appartment
            $request->apartment = $apartment;
        }

        $content = '../views/request/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    /**
     * Valide une demande d'affiliation, la validation entraine la suppression de la requete dans la Db,
     * active le compte de l'utilisateur et lui affilie l'appartement de sa requête
     * @param $id
     */
    public function validate($id) {
        $authenticatedUser = $this->isLogged();
        $request = $this->dao->getRequestById($id);
        $apartment = $this->apartmentDao->getApartmentById($request->apartment);

        // CAS 1 : L'utilisateur souhaite devenir propriétaire
        // Dans ce cas là, on modifie uniquement l'appartement concerné
        if ($request->isOwnerRequest == 1) {
            $data = [
                'name' => $apartment->name,
                'owner' => $request->user
            ];

            if ($this->apartmentDao->updateApartment($apartment->id, $data) && $this->userDao->setIsActive($request->user)) {
                $this->dao->deleteRequest($request->id);
            }
        }

        // CAS 2 : L'utilisateur souhaite devenir locataire
        // Dans ce cas là, on modifie l'user
        elseif ($request->isOwnerRequest == 0) {
            $data = [
                'fkApartment' => $apartment->id,
            ];

            if ($this->userDao->setLocation($request->user, $data) && $this->userDao->setIsActive($request->user)) {
                $this->dao->deleteRequest($request->id);
            }
        }

        $this->index();
    }

}