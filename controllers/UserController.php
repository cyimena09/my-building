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
        $user = $this->dao->getUserById($id);
        $content = '../views/user/one.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}
