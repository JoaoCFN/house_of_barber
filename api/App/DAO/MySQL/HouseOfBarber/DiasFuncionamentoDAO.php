<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\DiasFuncionamentoModel;

    class DiasFuncionamentoDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAll(): array
        {
            $query = "SELECT 
                    *
                FROM dias_funcionamento
            ";

            $diasFuncionamento = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $diasFuncionamento;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    *
                FROM dias_funcionamento
                WHERE 
                    id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $diaFuncionamento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $diaFuncionamento;
        }

        public function findByEstabelecimentoId(string $estabelecimentoId): array
        {
            $query = "SELECT 
                    *
                FROM dias_funcionamento
                WHERE 
                    estabelecimento_id = :estabelecimento_id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $estabelecimentoId
            ]);

            $diaFuncionamento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $diaFuncionamento;
        }

        public function insertDiaFuncionamento(DiasFuncionamentoModel $diasFuncionamento): bool
        {
            $query = "INSERT INTO dias_funcionamento(
                dia,
                horario_abertura,
                horario_fechamento,
                estabelecimento_id
            ) VALUES (
                :dia,
                :horario_abertura,
                :horario_fechamento,
                :estabelecimento_id
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "dia" => $diasFuncionamento->getDia(),
                "horario_abertura" => $diasFuncionamento->getHorarioAbertura(),
                "horario_fechamento" => $diasFuncionamento->getHorarioFechamento(),
                "estabelecimento_id" => $diasFuncionamento->getEstabelecimentoId()
            ]);

            return $result;
        }

        public function updateDiaFuncionamento(DiasFuncionamentoModel $diasFuncionamento, int $id): bool
        {
           $query = "UPDATE dias_funcionamento
                SET
                    dia = :dia,
                    horario_abertura = :horario_abertura,
                    horario_fechamento = :horario_fechamento
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "dia" => $diasFuncionamento->getDia(),
                "horario_abertura" => $diasFuncionamento->getHorarioAbertura(),
                "horario_fechamento" => $diasFuncionamento->getHorarioFechamento(),
                "id" => $id
            ]);

            return $result;
        }

        public function deleteDiaFuncionamento(int $id): bool
        {
            $query = "DELETE FROM dias_funcionamento
                WHERE id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id" => $id
            ]);

            return $result;
        }
    }