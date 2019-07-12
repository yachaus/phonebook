<?php

namespace App\Classes\Controllers;

use App\Classes\Models\Contact;
use App\Classes\Models\Country;
use App\Classes\Models\Email;
use App\Classes\Models\Number;

class Phonebook
    extends Base
{
    private $index_template = '/../../templates/index.php';
    private $myContact_template = '/../../templates/myContact.php';

    protected function actionAll()
    {
        unset($_SESSION['user_id']);
        $this->view['contacts'] = Contact::findAll();
        $this->view['login_tab'] = (empty($_GET['login_tab']))? NULL : $_GET['login_tab'];
        $this->view->display(__DIR__ . $this->index_template);
    }

    protected function actionMyContact()
    {
        $this->view['countries'] = Country::findAll();
        $this->view['contacts'] = Contact::findAll();
        if (!empty($_SESSION['user_id'])) {
            $this->save($_POST);
            $this->view['user'] = Contact::findById($_SESSION['user_id']);
            $this->view->display(__DIR__ . $this->myContact_template);
        } elseif (isset($_POST['password']) && isset($_POST['login'])) {
            $user = Contact::signIn($_POST['password'], $_POST['login']);
            if (!empty($user)) {
                $this->view['user'] = $user;
                $this->view->display(__DIR__ . $this->myContact_template);
            } else header('Location:index.php/?login_tab=show');
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