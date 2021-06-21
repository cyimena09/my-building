<?php


class ApartmentController extends AbstractController {

    public function __construct() {
        $this->dao = new ApartmentDao();
        $this->buildingDao = new BuildingDao();
    }

    public function index() {
        $authenticatedUser = $this->isLogged();
        $buildingDao = new BuildingDao();
        $buildings = $this->buildingDao->getBuildings();
        $content = '../views/apartment/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show($id) {
        $authenticatedUser = $this->isLogged();
        $apartment = $this->dao->getApartmentById($id);
        $content = '../views/apartment/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create($id, $data) {
        $authenticatedUser = $this->isLogged();

        if (!$this->dao->createApartment($data)) {
            return http_response_code(401);
        }
    }

    public function createView() {
        $authenticatedUser = $this->isLogged();
        $buildings = $this->buildingDao->getBuildings();
        $content = '../views/apartment/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function update($id, $data) {
        $authenticatedUser = $this->isLogged();
        $idApartment = $data['idApartment'];
        $this->dao->updateApartment($idApartment, $data);
    }

    public function delete($id) {
        $authenticatedUser = $this->isLogged();
        $this->dao->deleteApartment($id);
        $this->index();
    }

    /**
     * Affiche une liste déroulante d'appartements en fonction de l'id du paramètre data
     * @param $id
     * @param $data
     */
    public function dropdown($id, $data) {
        $apartments = $this->dao->getDataByFilter('fkBuilding', $data['idBuilding']);
        include ('../views/apartment/dropdown.php');
    }

}