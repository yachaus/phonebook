<?php

namespace App\Classes\Controllers;

use App\Classes\Models\Contact;
use App\Classes\Models\Country;

class Ajax extends Base
{
    protected function actionPublicPhonebook()
    {
        $this->view['contacts'] = Contact::findAll();
        $this->view->display(__DIR__ . '/../../templates/public_phonebook.php');
    }

    protected function actionLogin()
    {
        $this->view->display(__DIR__ . '/../../templates/login.php');
    }

    protected function actionMyContact()
    {
        $this->view['countries'] = Country::findAll();
        $this->view['user'] = Contact::findById($_SESSION['user_id']);
        $this->view->display(__DIR__ . '/../../templates/my_contact.php');
    }
}
