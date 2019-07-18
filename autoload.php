<?php
spl_autoload_register(function ($class) {
//    echo $class.'</br>';
    require __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
});
