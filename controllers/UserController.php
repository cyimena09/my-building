<?php


class UserController extends AbstractController {

    public function __construct () {
        $this->dao = new UserDao();
    }

    public function index() {
        $user = $this->isLogged();
        $users = $this->dao->getUsers();

        $content = 'list.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

    public function show ($id) {
        $user = $this->isLogged(); // attention ici il s'agit de vérifier que l'utilisateur est connecté
        $userInfo = $this->dao->getUserById($id); // cette variable contient les informations de l'utilisateur à afficher

        $content = '../views/user/one.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}
