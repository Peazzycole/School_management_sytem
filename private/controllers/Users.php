<?php

class Users extends Controller
{
    function index()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }
        $school_id = Auth::getSchool_id();
        $user = new User;
        $data = $user->query(
            "SELECT * FROM users WHERE school_id = :school_id && rank not in ('student') order by id desc",
            ['school_id' => $school_id]              //&& rank != 'superAdmin' 
        );

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['staff', 'users'];
        $this->view('users', [
            'rows' => $data,
            'crumbs' => $crumbs,
        ]);
    }
}
