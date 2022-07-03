<?php

// main controller class

class Controller
{


    public function view($view, $data = array())
    {
        extract($data);
        if (file_exists("../private/views/" . $view . ".view.php")) {
            require("../private/views/" . $view . ".view.php");
        } else {
            require("../private/views/404.view.php");
        }
    }


    public function redirect($link)
    {
        header("Location: " . ROOT . "/" . trim($link, "/"));  //Just incase a '/' is added at the end.
        die;
    }

    // public function loadModel($model)
    // {

    //     if (file_exists("../private/models/" . ucfirst($model) . ".php")) {
    //         require("../private/models/" . ucfirst($model) . ".php");
    //         return $model = new $model();
    //     }
    //     return false;
    // }
}
