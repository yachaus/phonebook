<?php

namespace App\Classes\Controllers;

use App\Classes\Models\Contact;
use App\Classes\Models\Country;

class Ajax extends Base
{
    private $public_phonebook = __DIR__ . '/../../templates/public_phonebook.php';
    private $login = __DIR__ . '/../../templates/login.php';
    private $my_contact = __DIR__ . '/../../templates/my_contact.php';

    protected function actionPublicPhonebook()
    {
        $this->view['contacts'] = Contact::findAll();
        $this->view->display($this->public_phonebook);
    }

    protected function actionLogin()
    {
        $this->view->display($this->login);
    }

    protected function actionMyContact()
    {
        $this->view['countries'] = Country::findAll();
        $this->view['user'] = Contact::findById($_SESSION['user_id']);
        $this->view->display($this->my_contact);
    }
}
