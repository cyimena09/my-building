<?php


class ApartmentController extends AbstractController {

    public function __construct () {
        $this->dao = new ApartmentDao();
    }

    public function index () {
        $user = $this->isLogged();
        $buildings = $this->dao->getApartments();

        $content = '../views/apartment/list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $user = $this->isLogged();
        $apartment = $this->dao->getApartmentById($id);
        $tenant = $this->dao->getTenantsByApartmentId($id);

        $content = '../apartment/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function create ($id, $data) {
        $user = $this->isLogged();
        $this->dao->createApartment($data);
        $this->index();
    }

    public function createView () {
        $user = $this->isLogged();

        $content = '../views/apartment/create-form.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}