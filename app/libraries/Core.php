<?php

/*
 * App main(core) class
 * Creates URL & loads core controller
 * URL format - /controller/method/params
*/

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        // $this->getUrl();
        // print_r($this->getUrl());
        $url = $this->getUrl();

        // Look in controllers for first index(value);
        
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){

            // if exist, Set as current controller
            $this->currentController = ucwords($url[0]);
            //unset 0 index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate the controller class 
        $this->currentController = new $this->currentController;

        // Check for second part of the Url
        if(isset($url[1])){
            // Check if method exists in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];

                // Unset index 1
                unset($url[1]);
            }
        }
        
        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        // Check if Params is set.
        if(isset($_GET['url'])){
            //Strip the ending slash(/) if there is any
            $url = rtrim($_GET['url'],'/');
            //Sanitize it as Url (Filter var as URL)
            $url = filter_var($url,FILTER_SANITIZE_URL);
            //Break it into array
            $url = explode('/',$url);
            return $url;
        }
    }
}