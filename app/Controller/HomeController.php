<?php 

    class HomeController{
        public function index(){

            try {
                $posts = Post::getPosts();

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');

                $params = array();
                $params['posts']  = $posts;
            
                $page_file_temp = $_SERVER["PHP_SELF"];
                $page_directory = dirname($page_file_temp);
                $page_directory = $page_directory.'/?page=post&id=';
                $params['directory']  = $page_directory;

                $content =  $template->render($params);

                echo $content;

            } catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }