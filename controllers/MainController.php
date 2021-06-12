<?php

class MainController extends AbstractController {

    public function index() {
        include('../views/header.php');
        include('../views/main.php');
        include('../views/footer.php');
    }
}
