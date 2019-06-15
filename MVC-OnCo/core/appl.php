<?php
    class Application {
        public function __construct()
        {
            $url = $this->parseUrl();
            // print_r($url);

            if(empty($url[0])){
                require 'controllers/index.php';
                $controller = new Index();
                return false;
            }

            $file = 'controllers/'. $url[0] .'.php';
            if(file_exists($file)){
                require $file;
            }

            $controller = new $url[0];
            $controller->loadModel($url[0]);
            if(isset($url[2])){
                if(method_exists($controller, $url[1])){
                    $controller->{$url[1]}($url[2]);
                } else {
                    $this->error();
                }
            } else {
                if(isset($url[1])){
                    if(method_exists($controller,$url[1])){
                        $controller->{$url[1]}();
                    } else {
                        $this->error();
                    }
                } else {
                    $controller->__construct();
                }
            }


        }

        public function parseUrl(){
            if(isset($_GET['url'])) {
                return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            }
        }

        public function error(){
            echo 'error';
            return false;
        }
    }
?>