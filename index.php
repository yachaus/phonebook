<?php
session_start();

require __DIR__ . '/autoload.php';

$base = new App\Classes\Controllers\Base();
$ctrl = $base->ctrl();
$action = $base->act();
$controller = new $ctrl();
$controller->action($action);
