<?php

class Single_test extends Controller
{
    public function index($id = '')
    {
        // code...
        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $tests = new MyTests();
        $row = $tests->firstResult('test_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];

        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'view';


        if ($row) {
            $crumbs[] = [$row->test, ''];
        }

        $quest = new MyQuestions();


        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $results = false;
        $questions = $quest->where('test_id', $id);
        $totalQuestions = count($questions);




        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['results']     = $results;
        $data['questions']     = $questions;
        $data['totalQuestions']     = $totalQuestions;
        $data['page_tab']     = $page_tab;
        $data['errors']     = $errors;
        $data['pager']     = $pager;

        $this->view('single_test', $data);
    }

    public function addSubjective($id)
    {
        // code...
        $errors = array();
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $tests = new MyTests();
        $row = $tests->firstResult('test_id', $id);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];

        $page_tab = 'add-subjective';


        if ($row) {
            $crumbs[] = [$row->test, ''];
        }

        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $quest = new MyQuestions();

        if (count($_POST) > 0) {

            if ($quest->validate($_POST)) {

                if ($myImage = uploadImage($_FILES)) {
                    $_POST['image'] = $myImage;
                };
                $_POST['question_type'] = 'subjective';
                $_POST['test_id'] = $id;
                $_POST['date'] = date("Y-m-d H:i:s");

                $quest->insert($_POST);
                $this->redirect('single_test/' . $id);
            } else {
                $errors = $quest->errors;
            }
        }

        $results = false;



        $data['row']         = $row;
        $data['crumbs']     = $crumbs;
        $data['results']     = $results;
        $data['page_tab']     = $page_tab;
        $data['errors']     = $errors;
        $data['pager']     = $pager;

        $this->view('single_test', $data);
    }
}
