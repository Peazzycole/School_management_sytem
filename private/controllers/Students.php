<?php

class Students extends Controller
{
    function index()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }
        $user = new User;
        $school_id = Auth::getSchool_id();

        $limit = 10;
        // $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // $page_number = $page_number < 1 ? 1 : $page_number;


        $pager = new Pager($limit);
        $offset = $pager->offset;

        $query = "SELECT * FROM users WHERE school_id = :school_id && rank in ('student') order by id desc limit $limit offset $offset";

        $arr['school_id'] = $school_id;

        if (isset($_GET['find'])) {

            $find = "%" . $_GET['find'] . "%";
            $query = "SELECT * FROM users WHERE school_id = :school_id && rank in ('student') && ( firstname like :find || lastname like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find;
        }

        $data = $user->query(
            $query,
            $arr              //&& rank != 'superAdmin' 
        );


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['students', 'students'];

        if (Auth::access('reception')) {
            $this->view('students', ['rows' => $data, 'crumbs' => $crumbs, 'pager' => $pager]);
        } else {
            $this->view('access-denied');
        }
    }
}
