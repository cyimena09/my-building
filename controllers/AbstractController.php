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
        return $authenticatedUser;
    }

    public function create ($id, $data) {
        var_dump('no create');
    }

    public function edit ($id) {
        var_dump('no edit');
    }

    public function delete ($id) {
        var_dump('no delete');
    }

    public function show ($id) {
        var_dump('no show');
    }

    public function update ($id, $data) {
        var_dump('no update');
    }

    public function store ($id, $data) {
        var_dump('no store');
    }

    public function index () {
        var_dump('no index');
    }
}