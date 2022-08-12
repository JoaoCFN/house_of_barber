<?php
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\AutenticarModel;

    class AutenticarDAO extends Conexao{
        public function __construct(){
            parent::__construct();
        }

        public function findToken(AutenticarModel $autenticarModel): int
        {
            $query = "SELECT
                    token
                FROM api_token
                WHERE 
                    DATE(data_acesso) = DATE(NOW())
                    AND token = :token
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "token" => $autenticarModel->getToken()
            ]);

            $numRows = $statement->rowCount();

            return $numRows;
        } 

        public function findUserByToken(AutenticarModel $autenticarModel): array
        {
            $query = "SELECT
                    id_usuario,
                    perfil
                FROM api_token
                WHERE 
                    DATE(data_acesso) = DATE(NOW())
                    AND token = :token
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "token" => $autenticarModel->getToken()
            ]);

            $userData = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $userData;
        }

        public function insertToken(AutenticarModel $autenticarModel): bool 
        {
            $query = "INSERT INTO api_token(
                id_usuario,
                perfil,
                token
            ) VALUES (
                :id_usuario,
                :perfil,
                :token
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id_usuario" => $autenticarModel->getIdUsuario(),
                "perfil" => $autenticarModel->getPerfil(),
                "token" => $autenticarModel->getToken()
            ]);

            return $result;
        }
    }