<?php

namespace App\Classes\Controllers;

use App\Classes\Models\Contact;
use App\Classes\Models\Email;
use App\Classes\Models\Number;

class Phonebook extends Base
{
    private $layout = __DIR__.'/../../templates/layout.php';

    protected function actionAll()
    {
        unset($_SESSION['user_id']);
        $this->view->display($this->layout);
    }

    protected function actionMyContact()
    {
        if (!empty($_SESSION['user_id'])) {
            $this->save($_POST);
            $this->view['user'] = Contact::findById($_SESSION['user_id']);
            $this->view->display($this->layout);
        } elseif (isset($_POST['password']) && isset($_POST['login'])) {
            $user = Contact::signIn($_POST['password'], $_POST['login']);
            if (!empty($user)) {
                $this->view['user'] = $user;
                $this->view->display($this->layout);
            } else header('Location:index.php');
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
