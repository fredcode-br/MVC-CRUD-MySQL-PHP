<?php 

    class Comentario {
        public static function getComentarioById($idPost){
            $conn = Connection::getConn();

            $sql = "SELECT * FROM comentario WHERE id_postagem = :id ORDER BY id DESC";
        

            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $result = array();
    
            while($row = $sql->fetchObject('Comentario')){
                $result[] = $row;
            }
            
            return $result;
        }

        public static function insert($data){
            if(empty($data['name']) or empty($data['message'])){
                throw new Exception("Preencha todos os campos.");
                return false;
            }

            $conn = Connection::getConn();

            $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nm, :msg, :id)";

            $sql = $conn->prepare($sql);
            $sql->bindValue(':id', $data['id']);
            $sql->bindValue(':nm', $data['name']);
            $sql->bindValue(':msg', $data['message']);
            $result = $sql->execute();
    
            if($result == 0){
                throw new Exception("Falha ao inserir comentario.");
                return false;
            }
            return true;
        }

    }