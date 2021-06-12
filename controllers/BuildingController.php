<?php


class BuildingController extends AbstractController {

    public function __construct () {
        $this->dao = new BuildingDao();
    }

    public function index () {
        $user = $this->isLogged();
        $buildings = $this->dao->getBuildings();

        $content = '../views/building/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $user = $this->isLogged();
        $building = $this->dao->getBuildingById($id);

        // on récupère les appartments de l'immeuble
        $apartmentDao = new ApartmentDao();
        $apartments = $apartmentDao->getApartmentsByBuildingId($building->id);

        $content = '../views/building/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $user = $this->isLogged();
        $this->dao->createBuilding($data);
        $this->index();
    }

    public function createView () {
        $user = $this->isLogged();

        $content = '../views/building/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}