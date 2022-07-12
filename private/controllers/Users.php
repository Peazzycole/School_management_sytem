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

        $limit = 2;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $query = "SELECT * FROM users WHERE school_id = :school_id && rank not in ('student') order by id desc limit $limit offset $offset";

        $arr['school_id'] = $school_id;

        if (isset($_GET['find'])) {

            $find = "%" . $_GET['find'] . "%";
            $query = "SELECT * FROM users WHERE school_id = :school_id && rank not in ('student') && ( firstname like :find || lastname like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find;
        }

        $data = $user->query(
            $query,
            $arr             //&& rank != 'superAdmin' 
        );

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['staff', 'users'];

        if (Auth::access('admin')) {
            $this->view('users', [
                'rows' => $data,
                'crumbs' => $crumbs,
                'pager' => $pager
            ]);
        } else {
            $this->view('access-denied');
        }
    }
}
