<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\AgendamentoModel;

    class AgendamentoDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAll(): array
        {
            $query = "SELECT 
                    *
                FROM agendamento
            ";

            $agendamentos = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $agendamentos;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    *
                FROM agendamento
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
                FROM agendamento
                WHERE 
                    estabelecimento_id = :estabelecimento_id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $estabelecimentoId
            ]);

            $agendamento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $agendamento;
        }

        public function findByIdWithServicos(string $id): array
        {
            $query = "SELECT 
                    * 
                FROM agendamento
                LEFT JOIN agendamento_servico
                ON agendamento_servico.agendamento_id = agendamento.id
                LEFT JOIN servico
                ON agendamento_servico.servico_id = servico.id
                WHERE 
                    agendamento.id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $servico = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $servico;
        }

        public function insertAgendamento(AgendamentoModel $agendamento): bool
        {
            $query = "INSERT INTO agendamento(
                cliente_id,
                estabelecimento_id,
                data_agendamento,
                horario_agendamento,
                valor,
                status
            ) VALUES (
                :cliente_id,
                :estabelecimento_id,
                :data_agendamento,
                :horario_agendamento,
                :valor,
                :status
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "cliente_id" => $agendamento->getClienteId(),
                "estabelecimento_id" => $agendamento->getEstabelecimentoId(),
                "data_agendamento" => $agendamento->getDataAgendamento(),
                "horario_agendamento" => $agendamento->getHorarioAgendamento(),
                "valor" => $agendamento->getValor(),
                "status" => $agendamento->getStatus()
            ]);

            return $result;
        }

        public function updateAgendamento(AgendamentoModel $agendamento, int $id): bool
        {
           $query = "UPDATE agendamento
                SET
                    cliente_id = :cliente_id,
                    estabelecimento_id = :estabelecimento_id,
                    data_agendamento = :data_agendamento,
                    horario_agendamento = :horario_agendamento,
                    valor = :valor,
                    status = :status
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "cliente_id" => $agendamento->getClienteId(),
                "estabelecimento_id" => $agendamento->getEstabelecimentoId(),
                "data_agendamento" => $agendamento->getDataAgendamento(),
                "horario_agendamento" => $agendamento->getHorarioAgendamento(),
                "valor" => $agendamento->getValor(),
                "status" => $agendamento->getStatus(),
                "id" => $id
            ]);

            return $result;
        }

        public function deleteAgendamento(int $id): bool
        {
            $query = "DELETE FROM agendamento
                WHERE id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id" => $id
            ]);

            return $result;
        }
    }