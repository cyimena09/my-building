<?php


class UserController extends AbstractController {
    public function __construct () {
        $this->dao = new UserDao();
    }

    public function index() {
        $user = $this->isLogged();
        $content = 'user-account.php';

        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}
