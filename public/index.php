<?php
spl_autoload_register ( function ($class) {
    if ($class === "Router") {
        include '../Router.php';
    } else if ( strpos( $class, "Controller")) {
        include "../controllers/{$class}.php";
    } else if ( strpos ( $class, "Dao")) {
        include "../models/dao/{$class}.php";
    } else {
        include "../models/entities/{$class}.php";
    }
});

$router = new Router();