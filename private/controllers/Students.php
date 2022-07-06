<?php

class Students extends Controller
{
    function index()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }
        $school_id = Auth::getSchool_id();
        $user = new User;
        $query = "SELECT * FROM users WHERE school_id = :school_id && rank in ('student') order by id desc";

        $arr['school_id'] = $school_id;

        if (isset($_GET['find'])) {

            $find = "%" . $_GET['find'] . "%";
            $query = "SELECT * FROM users WHERE school_id = :school_id && rank in ('student') && ( firstname like :find || lastname like :find) order by id desc";
            $arr['find'] = $find;
        }

        $data = $user->query(
            $query,
            $arr              //&& rank != 'superAdmin' 
        );


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['students', 'students'];

        if (Auth::access('reception')) {
            $this->view('students', ['rows' => $data, 'crumbs' => $crumbs]);
        } else {
            $this->view('access-denied');
        }
    }
}
