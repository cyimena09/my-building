<?php

abstract class AbstractController {

    public function getUser() {
        if (!isset($_COOKIE['session_token'])) {
            return false;
        }
        $userDao = new UserDao();

        return $userDao->fetchBySession($_COOKIE['session_token']);
    }

    public function isLogged() {
        $authenticatedUser = $this->getUser();

        if (!$authenticatedUser) {
            include ('../views/header.php');
            include ('../views/auth/login.php');
            include ('../views/footer.php');
            die;
        }

        if (!$authenticatedUser->isActive) {
            $errorMessage = "Un administrateur doit activer votre compte.";
            $authenticatedUser = null;
            include ('../views/header.php');
            include ('../views/auth/login.php');
            include ('../views/footer.php');
            die;
        }
        return $authenticatedUser;
    }

    public function index() {
        var_dump('no index');
    }

    public function show($id) {
        var_dump('no show');
    }

    public function create($id, $data) {
        var_dump('no create');
    }

    public function update($id, $data) {
        var_dump('no update');
    }

    public function delete($id) {
        var_dump('no delete');
    }

}