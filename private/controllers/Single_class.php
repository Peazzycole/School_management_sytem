<?php

class Single_class extends Controller
{
    public function index($id = '')
    {
        // code...
        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $row = $classes->firstResult('class_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $lect = new Lecturers_model();

        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $results = false;

        if ($page_tab == 'lecturers') {

            //display lecturers
            $query = "select * from class_lecturers where class_id = :class_id && disabled = 0 order by id desc limit $limit offset $offset";
            $lecturers = $lect->query($query, ['class_id' => $id]);

            $data['lecturers']         = $lecturers;
        } else if ($page_tab == 'students') {

            //display lecturers
            $query = "select * from class_students where class_id = :class_id && disabled = 0 order by id desc limit $limit offset $offset";
            $students = $lect->query($query, ['class_id' => $id]);

            $data['students'] = $students;
        } else if ($page_tab == 'tests') {

            //display lecturers
            $query = "select * from tests where class_id = :class_id order by id desc limit $limit offset $offset";
            $tests = $lect->query($query, ['class_id' => $id]);

            $data['tests'] = $tests;
        }

        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;
        $data['pager']     = $pager;

        $this->view('single_class', $data);
    }

    public function lecturerAdd($id = '')
    {

        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $row = $classes->firstResult('class_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = 'lecturers-add';
        $lect = new Lecturers_model();

        $results = false;

        if (count($_POST) > 0) {

            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {

                    //find lecturer
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'lecturer' limit 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
                } else {
                    $errors[] = "please type a name to find";
                }
            } else
			if (isset($_POST['selected'])) {

                //add lecturer
                $query = "select disabled,id from class_lecturers where user_id = :user_id && class_id = :class_id limit 1";

                if (!$check = $lect->query($query, [
                    'user_id' => $_POST['selected'],
                    'class_id' => $id,
                ])) {

                    $arr = array();
                    $arr['user_id']     = $_POST['selected'];
                    $arr['class_id']     = $id;
                    $arr['disabled']     = 0;
                    $arr['date']         = date("Y-m-d H:i:s");

                    $lect->insert($arr);

                    $this->redirect('single_class/' . $id . '?tab=lecturers');
                } else {
                    if (isset($check[0]->disabled)) {
                        if ($check[0]->disabled) {
                            $arr = array();

                            $arr['disabled']     = 0;

                            $lect->update($check[0]->id, $arr);

                            $this->redirect('single_class/' . $id . '?tab=lecturers');
                        } else {
                            $errors[] = "that lecturer already belongs to this class";
                        }
                    }
                    $errors[] = "that lecturer already belongs to this class";
                }
            }
        }

        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;

        $this->view('single_class', $data);
    }


    public function lecturerRemove($id = '')
    {

        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $row = $classes->firstResult('class_id', $id);


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = 'lecturers-remove';
        $lect = new Lecturers_model();

        $results = false;

        if (count($_POST) > 0) {

            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {

                    //find lecturer
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'lecturer' limit 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
                } else {
                    $errors[] = "please type a name to find";
                }
            } else
			if (isset($_POST['selected'])) {

                //add lecturer
                $query = "select id from class_lecturers where user_id = :user_id && class_id = :class_id && disabled = 0 limit 1";

                if ($row = $lect->query($query, [
                    'user_id' => $_POST['selected'],
                    'class_id' => $id,
                ])) {

                    $arr = array();
                    $arr['disabled']     = 1;

                    $lect->update($row[0]->id, $arr);

                    $this->redirect('single_class/' . $id . '?tab=lecturers');
                } else {
                    $errors[] = "that lecturer was not found in this class";
                }
            }
        }

        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;

        $this->view('single_class', $data);
    }

    // Add student
    public function studentAdd($id = '')
    {

        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $row = $classes->firstResult('class_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = 'students-add';
        $stud = new Students_model();

        $results = false;

        if (count($_POST) > 0) {

            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {

                    //find student
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'student' limit 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
                } else {
                    $errors[] = "please type a name to find";
                }
            } else
			if (isset($_POST['selected'])) {

                //add lecturer
                $query = "select disabled,id from class_students where user_id = :user_id && class_id = :class_id limit 1";

                if (!$check = $stud->query($query, [
                    'user_id' => $_POST['selected'],
                    'class_id' => $id,
                ])) {

                    $arr = array();
                    $arr['user_id']     = $_POST['selected'];
                    $arr['class_id']     = $id;
                    $arr['disabled']     = 0;
                    $arr['date']         = date("Y-m-d H:i:s");

                    $stud->insert($arr);

                    $this->redirect('single_class/' . $id . '?tab=students');
                } else {
                    if (isset($check[0]->disabled)) {
                        if ($check[0]->disabled) {
                            $arr = array();

                            $arr['disabled']     = 0;

                            $stud->update($check[0]->id, $arr);

                            $this->redirect('single_class/' . $id . '?tab=students');
                        } else {
                            $errors[] = "that student already belongs to this class";
                        }
                    }
                    $errors[] = "that student already belongs to this class";
                }
            }
        }

        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;

        $this->view('single_class', $data);
    }


    // Remove Student

    public function studentRemove($id = '')
    {

        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $row = $classes->firstResult('class_id', $id);


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = 'students-remove';
        $stud = new Students_model();

        $results = false;

        if (count($_POST) > 0) {

            if (isset($_POST['search'])) {

                if (trim($_POST['name']) != "") {

                    //find lecturer
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . "%";
                    $query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'student' limit 10";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
                } else {
                    $errors[] = "please type a name to find";
                }
            } else
			if (isset($_POST['selected'])) {

                //add lecturer
                $query = "select id from class_students where user_id = :user_id && class_id = :class_id && disabled = 0 limit 1";

                if ($row = $stud->query($query, [
                    'user_id' => $_POST['selected'],
                    'class_id' => $id,
                ])) {

                    $arr = array();
                    $arr['disabled']     = 1;

                    $stud->update($row[0]->id, $arr);

                    $this->redirect('single_class/' . $id . '?tab=students');
                } else {
                    $errors[] = "that studet was not found in this class";
                }
            }
        }

        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;

        $this->view('single_class', $data);
    }


    // Add Test
    public function testAdd($id = '')
    {

        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $row = $classes->firstResult('class_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = 'test-add';
        $testClass = new MyTests();

        $results = false;

        if (count($_POST) > 0) {

            if (isset($_POST['test'])) {
                $arr = array();
                $arr['test']     = $_POST['test'];
                $arr['description']     = $_POST['description'];
                $arr['class_id']     = $id;
                $arr['disabled']     = 0;
                $arr['date']         = date("Y-m-d H:i:s");

                $testClass->insert($arr);

                $this->redirect('single_class/' . $id . '?tab=tests');
            }
        }

        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;

        $this->view('single_class', $data);
    }


    public function testEdit($id = '', $test_id = '')
    {

        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $tests = new MyTests();
        $row = $classes->firstResult('class_id', $id);
        $testRow = $tests->firstResult('test_id', $test_id);


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = 'test-edit';
        $testClass = new MyTests();

        $results = false;

        if (count($_POST) > 0) {

            if (isset($_POST['test'])) {
                $arr = array();
                $arr['test']     = $_POST['test'];
                $arr['description']     = $_POST['description'];
                $arr['disabled']     = $_POST['disabled'];

                $testClass->update($testRow->id, $arr);

                $this->redirect('single_class/' . $id . '?tab=tests');
            }
        }

        $data['row']         = $row;
        $data['testRow']         = $testRow;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;

        $this->view('single_class', $data);
    }

    public function testDelete($id = '', $test_id = '')
    {

        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $classes = new MyClasses();
        $tests = new MyTests();
        $row = $classes->firstResult('class_id', $id);
        $testRow = $tests->firstResult('test_id', $test_id);


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->class, ''];
        }

        $page_tab = 'test-delete';
        $testClass = new MyTests();

        $results = false;

        if (count($_POST) > 0) {

            if (isset($_POST['test'])) {


                $testClass->delete($testRow->id);

                $this->redirect('single_class/' . $id . '?tab=tests');
            }
        }

        $data['row']         = $row;
        $data['testRow']         = $testRow;
        $data['crumbs']     = $crumbs;
        $data['page_tab']     = $page_tab;
        $data['results']     = $results;
        $data['errors']     = $errors;

        $this->view('single_class', $data);
    }
}
