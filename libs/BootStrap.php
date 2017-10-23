<?php

class Bootstrap {

    function __construct() {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        if (empty($url[0])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }

        $file = 'Controllers/' . $url[0] . '.php';

        if (file_exists($file))
        {
            require $file;
            $ctrl = new $url[0];
            if(isset($url[1])) //calling a function
            {
                if(isset($url[2])) // the function has arguments
                {
                    $size = count($url) - 2;
                    $args = array();
                    for($i = 0; $i<$size; $i++)
                    {
                        array_push($args, $url[$i+2]);
                    }
                    $ctrl->{$url[1]}($args);
                }
                else
                {
                    $ctrl->$url[1]();
                }
            }
        }
        else {
            require 'controllers/error.php';
            $error = new Error();
            
            return false;
        }
    }

}

?>
