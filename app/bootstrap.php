<?php
require_once "config/config.php";
spl_autoload_register(function ($class) {
    include 'libraries/' . $class . '.php';
});