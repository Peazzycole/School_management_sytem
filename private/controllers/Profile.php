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


        if (count($_POST) > 0 && Auth::access('reception')) {

            // check if passwords exist
            if (trim($_POST['password'] == "")) {
                unset($_POST['password']);
                unset($_POST['password2']);
            }

            if ($user->validate($_POST, $id)) {
                // check for files

                if (count($_FILES) > 0) {
                    $allowed[] = "image/jpeg";
                    $allowed[] = "image/png";

                    if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                        $folder = "uploads/";
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }
                        $destination = $folder . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                        $_POST['image'] = $destination;
                    }
                }


                if ($_POST['rank'] == 'superAdmin' && $_SESSION['USER']->rank != 'superAdmin') {
                    $_POST['rank'] = 'admin';
                }

                $myRow = $user->firstResult('user_id', $id);

                $user->update($myRow->id, $_POST);



                $redirect = 'profile/edit/' . $id;
                // $this->redirect($redirect);
            } else {
                $errors = $user->errors;
            }
        }

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
