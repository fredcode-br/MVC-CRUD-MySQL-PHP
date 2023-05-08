<?php 

    class AdminController{
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');

            $objPosts = Post::getPosts();

            $params = array();
            $params['posts'] = $objPosts;

            $content =  $template->render($params);
            echo $content;
        }

        public function create(){
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('create.html');

            $params = array();

            $content =  $template->render($params);
            echo $content;
        }

        public function insert(){
            try{
                Post::insert($_POST);
                echo '<script>alert("Publicação inserida com sucesso!");</script>';
                echo '<script>location.href="http://localhost/MVC-PHP/?page=admin&method=index";</script>';
            } catch(Exception $e){
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/MVC-PHP/?page=admin&method=create";</script>';
            }
        }

        public function change($id){
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('update.html');

            $objPost = Post::getPostById($id);

            
            $params = array();
            $params['id'] = $objPost->id;
            $params['titulo'] = $objPost->titulo;
            $params['conteudo'] = $objPost->conteudo;

            $content =  $template->render($params);
           echo $content;
        }

        public function update(){
            try{
                Post::update($_POST);
                echo '<script>alert("Publicação alterada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/MVC-PHP/?page=admin&method=index";</script>';
            } catch(Exception $e){
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/MVC-PHP/?page=admin&method=change&id='.$_POST['id'].'";</script>';
            }
        }

        public function delete($id){
            try{
                Post::delete($id);
                echo '<script>alert("Publicação excluida com sucesso!");</script>';
                echo '<script>location.href="http://localhost/MVC-PHP/?page=admin&method=index";</script>';
            } catch(Exception $e){
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/MVC-PHP/?page=admin&method=index";</script>';
            }
        }

    }