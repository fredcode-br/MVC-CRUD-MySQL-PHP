<?php 

    class Post {
        public static function getPosts(){
            $conn = Connection::getConn();

            $sql = "SELECT * FROM postagem ORDER BY id DESC";

            $sql = $conn->prepare($sql);
            $sql->execute();

            $result = array();
    
            while($row = $sql->fetchObject('Post')){
                $result[] = $row;
            }

            if(!$result){
                throw new Exception("Não foi encontrado nenhum registro no banco de dados.");
            }
            
            return $result;
        }

        public static function getPostById($idPost){
            $conn = Connection::getConn();

            $sql = "SELECT * FROM postagem WHERE id = :id";

            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $result = $sql->fetchObject('Post');
    
            if(!$result){
                throw new Exception("Não foi encontrado nenhum registro no banco de dados.");
            }else{
                $result->comentarios = Comentario::getComentarioById($idPost);
            }
            
            return $result;
        }

        public static function insert($data){
            if(empty($data['title']) or empty($data['content'])){
                throw new Exception("Preencha todos os campos.");
                return false;
            }

            $conn = Connection::getConn();

            $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:title, :content)";

            $sql = $conn->prepare($sql);
            $sql->bindValue(':title', $data['title']);
            $sql->bindValue(':content', $data['content']);
            $result = $sql->execute();
    
            if($result == 0){
                throw new Exception("Falha ao inserir postagem no banco de dados.");
                return false;
            }
            return true;
        }

        public static function update($data){
            if(empty($data['title']) or empty($data['content'])){
                throw new Exception("Preencha todos os campos.");
                return false;
            }

            $conn = Connection::getConn();

            $sql = "UPDATE postagem SET titulo = :title, conteudo = :content WHERE id= :id";

            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $data['id']);
            $sql->bindValue(':title', $data['title']);
            $sql->bindValue(':content', $data['content']);
            $result = $sql->execute();
    
            if($result == 0){
                throw new Exception("Falha ao alterar postagem.");
                return false;
            }
            return true;
        }

        public static function delete($idPost){
            $conn = Connection::getConn();

            $sql = "DELETE FROM postagem WHERE id = :id";

            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $result  =$sql->execute();

            if($result == 0){
                throw new Exception("Falha ao deletar postagem.");
                return false;
            }
            
            return true;
        }
    }