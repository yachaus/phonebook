<?php
session_start();
require __DIR__ . '/autoload.php';
$base = new App\Classes\Controllers\Base();
$controller = new App\Classes\Controllers\Phonebook();
$action = $controller->act();
$controller->action($action);