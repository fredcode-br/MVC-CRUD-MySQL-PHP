<?php 

    class AboutController{
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('about.html');

            $params = array();

            $content =  $template->render($params);
            echo $content;
        }
    }