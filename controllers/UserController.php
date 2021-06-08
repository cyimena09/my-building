<?php


class UserController extends AbstractController {
    public function __construct () {
        $this->dao = new UserDao();
    }

    public function accountView () {
        $user = $this->isLogged();

        include ('../views/header.php');
        include ('../views/user/user-account.php');
        include ('../views/footer.php');
    }

    public function edit ($id) {
        $user = $this->dao->fetch($id);
        include('../views/user/form.php');
    }

    public function store ($id, $data) {
        $this->dao->store($data);
    }


}
