<?php 

    class PostController{
        public function index($coreParams){
            
            try {
                $post = Post::getPostById($coreParams);
                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('single.html');
               
                $params = array();
                $params['id']  = $post->id;
                $params['titulo']  = $post->titulo;
                $params['conteudo']  = $post->conteudo;
                $params['comentarios']  = $post->comentarios;

                $page_file_temp = $_SERVER["PHP_SELF"];
                $page_directory = dirname($page_file_temp);
                $page_directory = $page_directory.'/?pagina=post&id=';
                $params['directory']  = $page_directory;
                
                $content =  $template->render($params);

                echo $content;

            } catch (Exception $e){
                echo $e->getMessage();
            }
        }
        
        public function addComment(){
            try{
                Comentario::insert($_POST);
                echo '<script>location.href="http://localhost/MVC-PHP/?page=post&id='.$_POST['id'].'";</script>';
            } catch(Exception $e){
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/MVC-PHP/?page=post&id='.$_POST['id'].'";</script>';
            }
        }
    
    }