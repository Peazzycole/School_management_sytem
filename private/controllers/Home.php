<?php

class Home extends Controller
{
    function index()
    {

        if (!Auth::login()) {
            $this->redirect('login');
        }


        $this->view('home');
    }
}
