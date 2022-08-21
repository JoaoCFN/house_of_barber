<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\EnderecoModel;

    class EnderecoDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAll(): array
        {
            $query = "SELECT 
                    *
                FROM endereco
            ";

            $enderecos = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $enderecos;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    *
                FROM endereco
                WHERE 
                    id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $endereco = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $endereco;
        }

        public function insertEndereco(EnderecoModel $endereco): bool
        {
            $query = "INSERT INTO endereco(
                estabelecimento_id,
                cep,
                estado,
                cidade,
                bairro,
                rua,
                numero
            ) VALUES (
                :estabelecimento_id,
                :cep,
                :estado,
                :cidade,
                :bairro,
                :rua,
                :numero
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "estabelecimento_id" => $endereco->getEstabelecimentoId(),
                "cep" => $endereco->getCep(),
                "estado" => $endereco->getEstado(),
                "cidade" => $endereco->getCidade(),
                "bairro" => $endereco->getBairro(),
                "rua" => $endereco->getRua(),
                "numero" => $endereco->getNumero()
            ]);

            return $result;
        }

        public function updateEndereco(EnderecoModel $endereco, int $id): bool
        {
           $query = "UPDATE endereco
                SET
                    cep = :cep,
                    estado = :estado,
                    cidade = :cidade,
                    bairro = :bairro,
                    rua = :rua,
                    numero = :numero
            WHERE estabelecimento_id = :estabelecimento_id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "cep" => $endereco->getCep(),
                "estado" => $endereco->getEstado(),
                "cidade" => $endereco->getCidade(),
                "bairro" => $endereco->getBairro(),
                "rua" => $endereco->getRua(),
                "numero" => $endereco->getNumero(),
                "estabelecimento_id" => $id
            ]);

            return $result;
        }

        public function deleteEndereco(int $id): bool
        {
            $query = "DELETE FROM endereco
                WHERE id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id" => $id
            ]);

            return $result;
        }
    }