<?php

namespace App\controllers;

use App\core\Controller;
use App\lib\Db;
use App\models\Insert;

class AccountController extends Controller
{
    public $insertModel = null;

    public function __construct($route)
    {

        parent::__construct($route);
        $this->insertModel = new Insert();


    }

    public function loginAction()
    {
        $this->view->render('Login');
    }

    public function registerAction()
    {
        $this->view->render('Register');
    }


    public function postLoginAction()
    {
        if (!empty($_POST)) {
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $data = $this->insertModel->login($email);
            if ($data) {

                $_SESSION['id'] = $data[0]["id"];
                $_SESSION['username'] = $data[0]["username"];
                $_SESSION['email'] = $data[0]["email"];
                if ($data[0]["password"] == md5($password)) {
                    echo json_encode([
                        $data,
                        'success' => true
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'errorMessage' => "Incorrect Email or password",
                    ]);
                    exit;
                }

            } else {
                echo json_encode([
                    'success' => false,
                    'errorMessage' => "Incorrect Email or password"
                ]);
//                $this->view->path = 'error';
//                $this->view->render('Error');
            }
        }
    }

    public function postRegisterAction()
    {

        if (!empty($_POST)) {
            $userName = isset($_POST['username']) ? $_POST['username'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $_SESSION["username"] = $_POST['username'];
            $res1 = $this->insertModel->register($userName, $email, $password);

        }

    }


    public function postMessageAction()
    {
        if (!empty($_POST)) {
            $us = $_SESSION["username"];
            $message = isset($_POST["message"]) ? $_POST['message'] : null;
            $this->insertModel->message($message, $us);


        } else {
            $arr = $this->insertModel->selMess();
            echo(json_encode($arr));
        }

    }

    public function postPersMessageAction()
    {

        if (!empty($_POST)) {
            if ($_POST['persmessage'] != "") {
                $us = $_SESSION["username"];
                $persmessage = isset($_POST['persmessage']) ? $_POST['persmessage'] : null;
                $us_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
                $mess1 = $this->insertModel->message1($persmessage, $us_id, $us);

                echo(json_encode($mess1));
            } else {
                $us_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
                $m = $this->insertModel->selMessage1($us_id);
                echo json_encode($m);
            }
        }
    }

    public function logoutAction()
    {
        session_destroy();

    }


}


