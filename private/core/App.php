<?php

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params = array();
    public function __construct()
    {
        $URL = $this->getURL();
        if (file_exists("../private/controllers/" . $URL[0] . ".php")) {
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]); //Remove the first item from the area to get only the items that remain
        }

        require("../private/controllers/" . $this->controller . ".php");
        $this->controller = new $this->controller();

        if (isset($URL[1])) {
            if (method_exists($this->controller, ucfirst($URL[1]))) {
                $this->method = $URL[1];
                unset($URL[1]);
            } else {
                $this->method = "index";
            }
        }

        $URL = array_values($URL);  // creates a new array with the remaining values
        $this->params = $URL;
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function getURL()
    {
        // put the string separated by a / in an array an trim if there is an extra "/"   
        //at the end and filter unwanted characters 
        $url = isset($_GET['url']) ? $_GET['url'] : "home";    // Will go home if url is empty
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}
