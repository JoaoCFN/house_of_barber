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

        public function insertToken(AutenticarModel $autenticarModel): bool 
        {
            $query = "INSERT INTO api_token(
                email,
                token
            ) VALUES (
                :email,
                :token
            )";

            $statement = $this->pdo->prepare($query);
            $statement = $statement->execute([
                "email" => $autenticarModel->getEmail(),
                "token" => $autenticarModel->getToken()
            ]);

            if($statement){
                return true;
            }
            else{
                return false;
            }
        }
    }