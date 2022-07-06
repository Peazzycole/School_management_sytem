<?php

class Signup extends Controller
{

    function index()
    {
        if (!Auth::login()) {
            $this->redirect('login');
        }
        $errors = array();
        $mode = isset($_GET['mode']) ? $_GET['mode'] : '';
        if (count($_POST) > 0) {
            $user = new User;
            if ($user->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");
                if (Auth::access('reception')) {

                    if ($_POST['rank'] == 'superAdmin' && $_SESSION['USER']->rank != 'superAdmin') {
                        $_POST['rank'] = 'admin';
                    }
                    $user->insert($_POST);
                }
                $redirect = $mode == 'students' ? 'students' : 'users';
                $this->redirect($redirect);
            } else {
                $errors = $user->errors;
            }
        }


        if (Auth::access('reception')) {
            $this->view(
                'signup',
                [
                    'errors' => $errors,
                    'mode' => $mode
                ]
            );
        } else {
            $this->view('access-denied');
        }
    }
}
