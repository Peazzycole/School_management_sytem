<?php

class Switch_school extends Controller
{
    function index($id = '')
    {
        if(Auth::access('superAdmin')){
            Auth::switch_school($id);
        }
        $this->redirect('schools');
    }
}
