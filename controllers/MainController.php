<?php

class MainController extends AbstractController {

    public function index() {
        $user = $this->isLogged();

        include('../views/header.php');
        include('../views/main.php');
        include('../views/footer.php');
    }
}
