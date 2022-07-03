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

        $this->view(
            'profile',
            $data
        );
    }
}
