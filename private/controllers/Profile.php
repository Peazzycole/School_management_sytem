<?php

class Profile extends Controller
{
    function index($id = "")
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }


        $user = new User();
        $id = trim($id == '') ? Auth::getUser_id() : $id;
        $row = $user->firstResult('user_id', $id);
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['profile', 'profile'];




        if (is_object($row)) {
            $crumbs[] = [$row->firstname, 'profile'];
        }


        $data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';

        if ($data['page_tab'] == 'classes' && $row) {

            $class = new MyClasses();
            $myTable = "class_students";
            if ($row->rank == "lecturer") {
                $myTable = "class_lecturers";
            }

            $query = "select * from $myTable where user_id = :user_id && disabled = 0";
            $data['stud_class'] = $class->query($query, ['user_id' => $id]);

            $data['student_classes'] = [];
            if ($data['stud_class']) {
                foreach ($data['stud_class'] as $key => $arow) {

                    $data['student_classes'][] = $class->firstResult('class_id', $arow->class_id);
                }
            }
        }

        $data['row'] = $row;
        $data['crumbs'] = $crumbs;

        if (Auth::access('reception') || Auth::iOwnContent($row)) {
            $this->view(
                'profile',
                $data
            );
        } else {
            $this->view('access-denied');
        }
    }

    public function edit($id = '')
    {
        if (!Auth::login()) {
            $this->redirect('login');
        }

        $errors = [];
        $user = new User();
        $id = trim($id == '') ? Auth::getUser_id() : $id;
        $row = $user->firstResult('user_id', $id);
        $data['row'] = $row;
        $data['errors'] = $errors;

        if (Auth::access('admin')) {
            $this->view(
                'profile-edit',
                $data
            );
        } else {
            $this->view('access-denied');
        }
    }
}
