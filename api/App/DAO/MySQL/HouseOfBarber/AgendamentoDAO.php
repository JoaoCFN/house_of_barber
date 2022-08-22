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
                LEFT JOIN agendamento_servico
                ON agendamento_servico.agendamento_id = agendamento.id
                WHERE 
                    id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $agendamento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $agendamento;
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

        public function findByClienteId(string $clienteId): array
        {
            $query = "SELECT 
                    agendamento.*,
                    estabelecimento.*,
                    endereco.*,
                    cliente.nome AS nome_cliente,
                    DATE_FORMAT(agendamento.data_agendamento, '%d/%m/%Y') AS data_agendamento_format,
                    TIME_FORMAT(agendamento.horario_agendamento, '%H:%i') AS horario_agendamento_format,
                    agendamento.id AS agendamento_id,
                    agendamento.status AS status_agendamento
                FROM agendamento
                INNER JOIN estabelecimento
                ON agendamento.estabelecimento_id = estabelecimento.id
                INNER JOIN cliente
                ON agendamento.cliente_id = cliente.id
                INNER JOIN endereco
                ON estabelecimento.id = endereco.estabelecimento_id
                WHERE 
                    cliente_id = :cliente_id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "cliente_id" => $clienteId
            ]);

            $agendamento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $agendamento;
        }

        public function findAgendamento(AgendamentoModel $agendamento): array
        {
            $query = "SELECT 
                    * 
                FROM agendamento
                WHERE 
                    estabelecimento_id = :estabelecimento_id
                    AND data_agendamento = :data_agendamento
                    AND horario_agendamento = :horario_agendamento
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $agendamento->getEstabelecimentoId(),
                "data_agendamento" => $agendamento->getDataAgendamento(),
                "horario_agendamento" => $agendamento->getHorarioAgendamento()
            ]);

            $agendamento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $agendamento;
        }

        public function findHorariosAgendamentosByData(AgendamentoModel $agendamento): array
        {
            $query = "SELECT 
                    horario_agendamento
                FROM agendamento
                WHERE 
                    estabelecimento_id = :estabelecimento_id
                    AND data_agendamento = :data_agendamento
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $agendamento->getEstabelecimentoId(),
                "data_agendamento" => $agendamento->getDataAgendamento()
            ]);

            $agendamento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $agendamento;
        }

        public function getTotaAgendamentos(string $estabelecimentoId): array
        {
            $query = "SELECT 
                    COUNT(*) AS total_agendamentos
                FROM agendamento
                WHERE 
                    estabelecimento_id = :estabelecimento_id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $estabelecimentoId
            ]);

            $totalAgendamentos = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $totalAgendamentos;
        }

        public function getTotaAgendamentosWithStatus(
            string $estabelecimentoId, 
            string $status,
            string $labelReturn
        ): array
        {
            $query = "SELECT 
                    COUNT(*) AS total_agendamentos_$labelReturn
                FROM agendamento
                WHERE 
                    estabelecimento_id = :estabelecimento_id
                    AND status = :status
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $estabelecimentoId,
                "status" => $status
            ]);

            $totalAgendamentos = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $totalAgendamentos;
        }

        public function getAgendamentosDataChart(string $estabelecimentoId): array 
        {
            $query = "SELECT 
                    DATE_FORMAT(data_criacao, '%d/%m') AS data,
                    COUNT(*) AS total_agendamentos
                FROM agendamento
                WHERE 
                    MONTH(data_criacao) = MONTH(NOW())
                    AND estabelecimento_id = :estabelecimento_id
                GROUP BY DATE(data_criacao)
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "estabelecimento_id" => $estabelecimentoId
            ]);
            
            $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $data;
        }

        public function insertAgendamento(AgendamentoModel $agendamento): array
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

            return [
                $result,
                $result ? $this->pdo->lastInsertId() : 0
            ];
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

        public function updateStatusAgendamento(AgendamentoModel $agendamento, int $id): bool
        {
           $query = "UPDATE agendamento
                SET
                    status = :status
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
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