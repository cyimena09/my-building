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
        if ($this->dao->createUser($data)) {
            $successMessage = 'Félicitation, votre compte a bien été créé !';
            include ('../views/header.php');
            include ('../views/auth/login.php');
            include ('../views/footer.php');
        }
    }

    public function loginView () {
        include ('../views/header.php');
        include ('../views/auth/login.php');
        include ('../views/footer.php');
    }

    public function login ($id, $data) {
        $user = $this->dao->verify($data); // retourne 'false' si 'data' ne matche avec aucun utilisateur

        if ($user) {
            $url = $data['route'] ? $data['route'] : '/user';
            header("Location:{$url}");
        } else {
            $errorMessage = 'Email ou mot de passe incorrect !';
            include ('../views/header.php');
            include ('../views/auth/login.php');
            include ('../views/footer.php');
        }
    }

    public function logout() {
        unset($_COOKIE['session_token']);

        include ('../views/header.php');
        include ('../views/auth/login.php');
        include ('../views/footer.php');
    }


}