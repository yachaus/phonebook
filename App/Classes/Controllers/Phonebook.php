<?php

namespace App\Classes\Controllers;

use App\Classes\Models\Contact;
use App\Classes\Models\Country;
use App\Classes\Models\Email;
use App\Classes\Models\Number;

class Phonebook
    extends Base
{
    protected function actionAll()
    {
        $this->view['contacts'] = Contact::findAll();
        if (!empty($_GET['login_tab'])){
            $this->view['login_tab'] = $_GET['login_tab'];
        }
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    protected function actionMyContact()
    {
        if (isset($_POST['save_id'])) {
            $this->save($_POST);
            $this->view['contacts'] = Contact::findAll();
            $this->view['user'] = Contact::findById($_POST['save_id']);
            $this->view['countries'] = Country::findAll();
            $this->view->display(__DIR__ . '/../../templates/myContact.php');
        } elseif (isset($_POST['password']) && isset($_POST['login'])) {
            $user = Contact::signIn($_POST['password'], $_POST['login']);
            if (!empty($user)) {
                $this->view['contacts'] = Contact::findAll();
                $this->view['user'] = $user;
                $this->view['countries'] = Country::findAll();
                $this->view->display(__DIR__ . '/../../templates/myContact.php');
            } else //$this->actionAll();
                header('Location:index.php/?login_tab=show');
        }
    }

    protected function save($data)
    {
        $user = new Contact();
        $user->fill($data);
        $user->save();

        $user_number = new Number();
        $numbers = $user_number->parse($data);
        foreach ($numbers as $number) {
            $user_number->fill($number);
            if ('' == $number['number']) {
                $user_number->delete();
            } else {
                $user_number->save();
            }
        }
        
        $user_email = new Email();
        $emails = $user_email->parse($data);
        foreach ($emails as $email) {
            $user_email->fill($email);
            if ('' == $email['email']) {
                $user_email->delete();
            } else {
                $user_email->save();
            }
        }

    }
}