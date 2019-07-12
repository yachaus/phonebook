<?php

namespace App\Classes\Controllers;

use App\Classes\View\View;

class Base
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function beforeAction()
    {

    }

    public function action($method)
    {
        $this->beforeAction();
        $methodName = 'action' . $method;
        $this->$methodName();
    }

    public function act()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace('/', '\\', $url);
        $url = substr($url, 1);
        if ('index.php' == $url || '' == $url) {
            $action = 'All';
        }
        $action = stristr($url, '\\');
        $action = substr($action, 1);
        if ('MyContact' != $action) {
            $action = 'All';
        }
        return $action;
    }
}

