<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\ServicoModel;

    class ServicoDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAll(): array
        {
            $query = "SELECT 
                    *
                FROM servico
            ";

            $servicos = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $servicos;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    *
                FROM servico
                WHERE 
                    id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $servico = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $servico;
        }

        public function findByEstabelecimentoId(string $estabelecimentoId): array
        {
            $query = "SELECT 
                    *
                FROM servico
                WHERE 
                    estabelecimento_id = :estabelecimento_id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $estabelecimentoId
            ]);

            $servico = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $servico;
        }

        public function insertServico(ServicoModel $servico): bool
        {
            $query = "INSERT INTO servico(
                nome,
                valor,
                estabelecimento_id
            ) VALUES (
                :nome,
                :valor,
                :estabelecimento_id
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome" => $servico->getNome(),
                "valor" => $servico->getValor(),
                "estabelecimento_id" => $servico->getEstabelecimentoId()
            ]);

            return $result;
        }

        public function updateServico(ServicoModel $servico, int $id): bool
        {
           $query = "UPDATE servico
                SET
                    nome = :nome,
                    valor = :valor
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome" => $servico->getNome(),
                "valor" => $servico->getValor(),
                "id" => $id
            ]);

            return $result;
        }

        public function deleteServico(int $id): bool
        {
            $query = "DELETE FROM servico
                WHERE id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id" => $id
            ]);

            return $result;
        }
    }