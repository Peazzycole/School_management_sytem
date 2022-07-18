<?php


class Tests extends Controller
{



    public function index()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }

        $tests = new MyTests;
        $arr = [];

        if (Auth::access('admin')) {
            $query = "select * from tests order by id desc";

            if (isset($_GET['find'])) {

                $find = "%" . $_GET['find'] . "%";
                $query = "SELECT * FROM tests WHERE class like :find order by id desc";
                $arr['find'] = $find;
            }

            $data = $tests->query($query, $arr);
        }



        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];

        if (Auth::access('admin')) {

            $this->view('tests', ['rows' => $data, 'crumbs' => $crumbs]);
        } else {
            $this->view('access-denied');
        }
    }

    public function add()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }


        $errors = array();



        if (count($_POST) > 0) {
            $tests = new Mytests;
            if ($tests->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $tests->insert($_POST);
                $this->redirect('tests');
            } else {
                $errors = $tests->errors;
            }
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];
        $crumbs[] = ['Add', 'tests/add'];

        $this->view('tests.add', ['errors' => $errors, 'crumbs' => $crumbs]);
    }

    public function edit($id = null)
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }

        $tests = new Mytests;
        $errors = array();
        $row = $tests->where('id', $id);
        if ($row) {
            $row = $row[0];
        }

        if (count($_POST) > 0 && Auth::access('lecturer') && Auth::iOwnContent($row)) {

            if ($tests->validate($_POST)) {
                $tests->update($id, $_POST);
                $this->redirect('tests');
            } else {
                $errors = $tests->errors;
            }
        }



        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];
        $crumbs[] = ['Edit', 'tests/edit'];
        if (Auth::access('lecturer') && Auth::iOwnContent($row)) {
            $this->view('tests.edit', ['row' => $row, 'errors' => $errors, 'crumbs' => $crumbs]);
        } else {
            $this->view('access-denied');
        }
    }

    public function delete($id = null)
    {
        if (!Auth::login()) {
            $this->redirect('login');
        }


        $tests = new Mytests;
        $errors = array();
        $row = $tests->where('id', $id);
        if ($row) {
            $row = $row[0];
        }
        if (count($_POST) > 0 && Auth::access('lecturer') && Auth::iOwnContent($row)) {


            $tests->delete($id);
            $this->redirect('tests');
        }




        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['tests', 'tests'];
        $crumbs[] = ['Delete', 'tests/delete'];

        if (Auth::access('lecturer') && Auth::iOwnContent($row)) {
            $this->view('tests.delete', ['row' => $row, 'errors' => $errors, 'crumbs' => $crumbs]);
        } else {
            $this->view('access-denied');
        }
    }
}
