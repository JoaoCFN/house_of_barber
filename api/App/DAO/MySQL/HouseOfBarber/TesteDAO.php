<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\TesteModel;

    class TesteDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAll(): array
        {
            $query = "SELECT 
                    *
                FROM teste
            ";

            $testes = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $testes;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    *
                FROM teste
                WHERE 
                    id_teste = :id_teste
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id_teste" => $id
            ]);

            $cidade = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $cidade;
        }

        public function insertTeste(TesteModel $teste): bool
        {
            $query = "INSERT INTO teste(
                nome
            ) VALUES (
                :nome
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome" => $teste->getNome()
            ]);

            return $result;
        }

        public function updateTeste(TesteModel $teste, int $id): bool
        {
           $query = "UPDATE teste
                SET
                    nome = :nome
            WHERE id_teste = :id_teste";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome" => $teste->getNome(),
                "id_teste" => $$id
            ]);

            return $result;
        }

        public function deleteTeste(int $id): bool
        {
            $query = "DELETE FROM teste
                WHERE id_teste = :id_teste
            ";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id_teste" => $id
            ]);

            return $result;
        }
    }