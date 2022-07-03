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
        $data = $user->query(
            "SELECT * FROM users WHERE school_id = :school_id && rank in ('student') order by id desc",
            ['school_id' => $school_id]              //&& rank != 'superAdmin' 
        );

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['students', 'students'];
        $this->view('students', ['rows' => $data, 'crumbs' => $crumbs]);
    }
}
