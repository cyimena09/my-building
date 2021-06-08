<?php


class AuthController extends AbstractController {

    public function __construct() {
       $this->dao = new UserDao();
    }

    public function registerView () {
        include ('../views/header.php');
        include ('../views/auth/register.php');
        include ('../views/footer.php');
    }

    public function register ($id, $data) {
        $this->dao->createUser($data);
    }

    public function loginView () {
        include ('../views/header.php');
        include ('../views/auth/login.php');
        include ('../views/footer.php');
    }

    public function login ($id, $data) {
        $user = $this->dao->verify($data); // retourne 'false' si 'data' ne matche avec aucun utilisateur

        if ($user) {
            $url = $data['route'] ? $data['route'] : '/user/accountView';
            header("Location:{$url}");
        } else {
            echo "Erreur au login";
        }
    }
}