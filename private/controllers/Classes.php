<?php


class Classes extends Controller
{



    public function index()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }

        $classes = new MyClasses;

        $data = $classes->findAll();


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $this->view('classes', ['rows' => $data, 'crumbs' => $crumbs]);
    }

    public function add()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }


        $errors = array();



        if (count($_POST) > 0) {
            $classes = new MyClasses;
            if ($classes->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $classes->insert($_POST);
                $this->redirect('classes');
            } else {
                $errors = $classes->errors;
            }
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Add', 'classes/add'];

        $this->view('classes.add', ['errors' => $errors, 'crumbs' => $crumbs]);
    }

    public function edit($id = null)
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }

        $classes = new MyClasses;
        $errors = array();
        if (count($_POST) > 0) {

            if ($classes->validate($_POST)) {
                $classes->update($id, $_POST);
                $this->redirect('classes');
            } else {
                $errors = $classes->errors;
            }
        }


        $row = $classes->where('id', $id);
        if ($row) {
            $row = $row[0];
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Edit', 'classes/edit'];
        $this->view('classes.edit', ['row' => $row, 'errors' => $errors, 'crumbs' => $crumbs]);
    }

    public function delete($id = null)
    {
        if (!Auth::login()) {
            $this->redirect('login');
        }

        $classes = new MyClasses;
        $errors = array();
        if (count($_POST) > 0) {


            $classes->delete($id);
            $this->redirect('classes');
        }


        $row = $classes->where('id', $id);
        if ($row) {
            $row = $row[0];
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Classes', 'classes'];
        $crumbs[] = ['Delete', 'classes/delete'];
        $this->view('classes.delete', ['row' => $row, 'errors' => $errors, 'crumbs' => $crumbs]);
    }
}