<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\AgendamentoServicoModel;

    class AgendamentoServicoDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function findByAgendamentoId(string $id): array
        {
            $query = "SELECT 
                    * 
                FROM agendamento_servico
                INNER JOIN servico
                ON agendamento_servico.servico_id = servico.id
                WHERE 
                    agendamento_id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $servicos = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $servicos;
        }

        public function insertAgendamentoServico(AgendamentoServicoModel $agendamentoServico): bool
        {
            $query = "INSERT INTO agendamento_servico(
                agendamento_id,
                servico_id
            ) VALUES (
                :agendamento_id,
                :servico_id
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "agendamento_id" => $agendamentoServico->getAgendamentoId(),
                "servico_id" => $agendamentoServico->getServicoId()
            ]);

            return $result;
        }
    }