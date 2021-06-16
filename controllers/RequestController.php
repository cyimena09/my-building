<?php


class RequestController extends AbstractController {

    public function __construct() {
        $this->dao = new RequestDao();
    }

    /**
     * Retourne toutes les demandes d'affiliation d'appartements des utilisateurs nouvellement inscrit
     */
    public function index() {
        $authenticatedUser = $this->isLogged();

        $requests = $this->dao->getRequests();
        // recupération des users
        $userDao = new UserDao();
        $apartmentDao = new ApartmentDao();
        foreach ($requests as $request) {
            $user = $userDao->getUserById($request->user); // user contient l'id de l'user
            $request->user = $user;

            $apartment = $apartmentDao->getApartmentById($request->apartment); // apartment contient l'id de l'apartment
            $request->apartment = $apartment;
        }

        $content = '../views/request/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    /**
     * Valide une demande d'affiliation, la validation entraine la suppression de la requete dans la Db
     * Et active le compte de l'utilisateur
     * @param $id
     */
    public function validate($id) {
        // todo terminer ce code
        $authenticatedUser = $this->isLogged();

        $request = $this->dao->getRequestById($id);
        $apartmentDao = new ApartmentDao();
        $apartment = $apartmentDao->getApartmentById($request->apartment);

        $userDao = new UserDao();

        // si un utilisateur signal qu'il possède l'appartement alors on modifie uniquement l'appartement concerné
        if ($request->isOwnerRequest == 1) {
            $apartment->owner = $request->user; // ici l'user est le propriétaire

            $data = [
                'name' => $apartment->name,
                'owner' => $apartment->owner
            ];

            if ($apartmentDao->updateApartment($apartment->id, $data)) {
                $this->dao->deleteRequest($request->id);
            }
        }
        // si l'utilisateur signal qu'il loue l'appartement alors on modifie l'appartement et l'user
        elseif ($request->isOwnerRequest == 0) {
            $apartment->tenant = $request->user; // ici l'user est le locataire

            $data = [
                'name' => $apartment->name,
                'tenant' => $apartment->tenant
            ];

            if ($apartmentDao->updateApartment($apartment->id, $data)) {
                $this->dao->deleteRequest($request->id);
            }
        }

        $this->index();
    }

}