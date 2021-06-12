<?php


class ApartmentController extends AbstractController {

    public function __construct () {
        $this->dao = new ApartmentDao();
    }

    public function index () {
        $user = $this->isLogged();
        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildingsWithApartments();

        $content = '../views/apartment/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $user = $this->isLogged();
        $apartment = $this->dao->getApartmentById($id);
        // on récupère les locataires de l'appartement
        $userDao = new UserDao();
        $tenants = $userDao->getUsersByApartmentId($id); // récupération des locataires
        $owner = $userDao->getUserById($apartment->ownerId); // récupération du propriétaire

        $content = '../views/apartment/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $user = $this->isLogged();

        if ( $this->dao->createApartment($data)) {
            $successMessage = "L'appartement a bien été ajouté au batiment";
        } else {
            $errorMessage = "Désolé, l'appartement n'a pas pu être créé.";
        }

        // on récupère l'id de l'immeuble pour retourner le meme formulaire et permettre des ajouts multiples
        $idBuilding = $data['fkBuilding'];

        $content = '../views/apartment/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function createView () {
        $user = $this->isLogged();

        $content = '../views/apartment/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    /**
     * Affiche une liste déroulante d'appartements en fonction de l'id contenu dans le paramètre data
     * @param $id
     * @param $data
     */
    public function dropdown($id, $data) {
        $apartments = $this->dao->getApartmentsByBuildingId($data['idBuilding']);

        include ('../views/apartment/dropdown.php');
    }

}