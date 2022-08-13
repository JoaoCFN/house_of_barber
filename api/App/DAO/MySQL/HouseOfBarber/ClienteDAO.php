<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\ClienteModel;

    class ClienteDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAll(): array
        {
            $query = "SELECT 
                    *
                FROM cliente
            ";

            $clientes = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $clientes;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    *
                FROM cliente
                WHERE 
                    id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $cidade = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $cidade;
        }

        public function findUserByEmail(string $email): array
        {
            $query = "SELECT 
                    id,
                    nome,
                    telefone,
                    data_nascimento,
                    cpf,
                    email,
                    senha
                FROM cliente
                WHERE 
                    email = :email
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "email" => $email
            ]);

            $cliente = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $cliente;
        }

        public function insertCliente(ClienteModel $cliente): bool
        {
            $query = "INSERT INTO cliente(
                nome,
                telefone,
                data_nascimento,
                cpf,
                email,
                senha,
                sub_google
            ) VALUES (
                :nome,
                :telefone,
                :data_nascimento,
                :cpf,
                :email,
                :senha,
                :sub_google
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome" => $cliente->getNome(),
                "telefone" => $cliente->getTelefone(),
                "data_nascimento" => $cliente->getDataNascimento(),
                "cpf" => $cliente->getCpf(),
                "email" => $cliente->getEmail(),
                "senha" => $cliente->getSenha(),
                "sub_google" => ""
            ]);

            return $result;
        }

        public function updateCliente(ClienteModel $cliente, int $id): bool
        {
           $query = "UPDATE cliente
                SET
                    nome = :nome,
                    telefone = :telefone,
                    data_nascimento = :data_nascimento
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome" => $cliente->getNome(),
                "telefone" => $cliente->getTelefone(),
                "data_nascimento" => $cliente->getDataNascimento(),
                "id" => $id
            ]);

            return $result;
        }

        public function deleteCliente(int $id): bool
        {
            $query = "DELETE FROM cliente
                WHERE id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id" => $id
            ]);

            return $result;
        }
    }