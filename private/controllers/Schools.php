<?php

class Schools extends Controller
{



    public function index()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }

        $school = new School;

        $data = $school->findAll();


        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Schools', 'schools'];

        if(Auth::access('superAdmin')){
            $this->view('schools', ['rows' => $data, 'crumbs' => $crumbs]);

        }else{
            $this->view('access-denied');
        }
    }

    public function add()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }


        $errors = array();



        if (count($_POST) > 0 && Auth::access('superAdmin')) {
            $school = new School;
            if ($school->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $school->insert($_POST);
                $this->redirect('schools');
            } else {
                $errors = $school->errors;
            }
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Schools', 'schools'];
        $crumbs[] = ['Add', 'schools/add'];

        if(Auth::access('superAdmin')){
            $this->view('schools.add', ['errors' => $errors, 'crumbs' => $crumbs]);

        }else{
            $this->view('access-denied');
        }
    }

    public function edit($id = null)
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }

        $school = new School;
        $errors = array();
        if (count($_POST) > 0 && Auth::access('superAdmin')) {

            if ($school->validate($_POST)) {
                $school->update($id, $_POST);
                $this->redirect('schools');
            } else {
                $errors = $school->errors;
            }
        }


        $row = $school->where('id', $id);
        if ($row) {
            $row = $row[0];
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Schools', 'schools'];
        $crumbs[] = ['Edit', 'schools/edit'];

        if(Auth::access('superAdmin')){
            $this->view('schools.edit', ['row' => $row, 'errors' => $errors, 'crumbs' => $crumbs]);

        }else{
            $this->view('access-denied');
        }
    }

    public function delete($id = null)
    {
        if (!Auth::login()) {
            $this->redirect('login');
        }

        $school = new School;
        $errors = array();
        if (count($_POST) > 0 && Auth::access('superAdmin')) {


            $school->delete($id);
            $this->redirect('schools');
        }


        $row = $school->where('id', $id);
        if ($row) {
            $row = $row[0];
        }

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Schools', 'schools'];
        $crumbs[] = ['Delete', 'schools/delete'];

        if(Auth::access('superAdmin')){
            $this->view('schools.delete', ['row' => $row, 'errors' => $errors, 'crumbs' => $crumbs]);
        }else{
            $this->view('access-denied');
        }
        
    }
}
