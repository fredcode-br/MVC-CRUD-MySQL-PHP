<?php 

    class HomeController{
        public function index(){

            try {
                $posts = Post::getPosts();
                var_dump($posts);

            } catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }