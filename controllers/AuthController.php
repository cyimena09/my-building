<?php


class AuthController extends AbstractController {

    public function __construct() {
       $this->dao = new UserDao();
    }

    public function registerView() {
        $buildingDao = new BuildingDao();
        $buildings = $buildingDao->getBuildings();

        include ('../views/header.php');
        include ('../views/auth/register.php');
        include ('../views/footer.php');
    }

    public function register($id, $data) {
        $this->dao->createUser($data);
    }

    public function loginView() {
        include ('../views/header.php');
        include ('../views/auth/login.php');
        include ('../views/footer.php');
    }

    public function login($id, $data) {
        $authenticatedUser = $this->dao->verify($data); // retourne 'false' si 'data' ne matche avec aucun utilisateur

        if ($authenticatedUser) {
            $url = $data['route'] ? $data['route'] : '/auth/accountView';
            header("Location:{$url}");
        } else {
            $errorMessage = 'Email ou mot de passe incorrect !';
            include ('../views/header.php');
            include ('../views/auth/login.php');
            include ('../views/footer.php');
        }
    }

    public function logout() {
        // on supprime le cookie
        if (isset($_COOKIE['session_token'])) {
            unset($_COOKIE['session_token']);
            setcookie('session_token', null, -1, '/');
        }

        include ('../views/header.php');
        include ('../views/auth/login.php');
        include ('../views/footer.php');
    }

    public function accountView() {
        $authenticatedUser = $this->isLogged();

        $content = 'user-account.php';
        include ('../views/header.php');
        include ('../views/user/user-space.php');
        include ('../views/footer.php');
    }

}