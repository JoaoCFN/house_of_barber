<?php 
    namespace App\DAO\MySQL\HouseOfBarber;

    use App\Models\MySQL\HouseOfBarber\EstabelecimentoModel;

    class EstabelecimentoDAO extends Conexao{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAll(): array
        {
            $query = "SELECT 
                    estabelecimento.id AS estabelecimento_id,
                    estabelecimento.nome,
                    estabelecimento.tipo,
                    estabelecimento.telefone,
                    estabelecimento.cnpj,
                    estabelecimento.foto_perfil,
                    endereco.cep,
                    endereco.cidade,
                    endereco.bairro,
                    endereco.rua,
                    endereco.numero,
                    CASE
                        WHEN 
                            dias_funcionamento.dia IS NOT NULL 
                            AND dias_funcionamento.dia = WEEKDAY(DATE(NOW()))
                            AND TIME(NOW()) >= dias_funcionamento.horario_abertura
                            AND TIME(NOW()) <= dias_funcionamento.horario_fechamento
                                THEN 'ABERTO'
                        ELSE
                            'FECHADO'
                    END AS status_funcionamento,
                    IF(dias_funcionamento.horario_abertura IS NOT NULL, TIME_FORMAT(dias_funcionamento.horario_abertura, '%H:%i'), 'FECHADO') AS horario_abertura,
                    IF(dias_funcionamento.horario_fechamento IS NOT NULL, TIME_FORMAT(dias_funcionamento.horario_fechamento, '%H:%i'), 'FECHADO') AS horario_fechamento
                FROM estabelecimento
                LEFT JOIN endereco
                ON estabelecimento.id = endereco.estabelecimento_id
                LEFT JOIN dias_funcionamento
                ON (estabelecimento.id = dias_funcionamento.estabelecimento_id AND dias_funcionamento.dia = WEEKDAY(DATE(NOW())))
            ";

            $estabelecimentos = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $estabelecimentos;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    estabelecimento.id AS estabelecimento_id,
                    estabelecimento.nome,
                    estabelecimento.tipo,
                    estabelecimento.telefone,
                    estabelecimento.cnpj,
                    endereco.cep,
                    endereco.cidade,
                    endereco.bairro,
                    endereco.rua,
                    endereco.numero,
                    CASE
                        WHEN 
                            dias_funcionamento.dia IS NOT NULL 
                            AND dias_funcionamento.dia = WEEKDAY(DATE(NOW()))
                            AND TIME(NOW()) >= dias_funcionamento.horario_abertura
                            AND TIME(NOW()) <= dias_funcionamento.horario_fechamento
                                THEN 'ABERTO'
                        ELSE
                            'FECHADO'
                    END AS status_funcionamento,
                    IF(dias_funcionamento.horario_abertura IS NOT NULL, TIME_FORMAT(dias_funcionamento.horario_abertura, '%H:%i'), 'FECHADO') AS horario_abertura,
                    IF(dias_funcionamento.horario_fechamento IS NOT NULL, TIME_FORMAT(dias_funcionamento.horario_fechamento, '%H:%i'), 'FECHADO') AS horario_fechamento
                FROM estabelecimento
                LEFT JOIN endereco
                ON estabelecimento.id = endereco.estabelecimento_id
                LEFT JOIN dias_funcionamento
                ON (estabelecimento.id = dias_funcionamento.estabelecimento_id AND dias_funcionamento.dia = WEEKDAY(DATE(NOW())))
                WHERE 
                    estabelecimento.id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $estabelecimento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $estabelecimento;
        }

        public function findPerfilEstabelecimento(string $id): array
        {
            $query = "SELECT 
                    estabelecimento.id AS estabelecimento_id,
                    estabelecimento.nome_admin,
                    estabelecimento.telefone_admin,
                    estabelecimento.cpf_admin,
                    estabelecimento.email,
                    estabelecimento.nome,
                    estabelecimento.tipo,
                    estabelecimento.telefone,
                    estabelecimento.cnpj,
                    estabelecimento.foto_perfil,
                    endereco.cep,
                    endereco.cidade,
                    endereco.bairro,
                    endereco.rua,
                    endereco.numero,
                    endereco.estado
                FROM estabelecimento
                LEFT JOIN endereco
                ON estabelecimento.id = endereco.estabelecimento_id
                WHERE 
                    estabelecimento.id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);

            $estabelecimento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $estabelecimento;
        }

        public function findUserByEmail(string $email): array
        {
            $query = "SELECT 
                    id,
                    nome_admin,
                    telefone_admin,
                    cpf_admin,
                    email,
                    senha,
                    nome, 
                    telefone,
                    cnpj,
                    status
                FROM estabelecimento
                WHERE 
                    email = :email
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "email" => $email
            ]);

            $estabelecimento = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $estabelecimento;
        }

        public function insertEstabelecimento(EstabelecimentoModel $estabelecimento): array
        {
            $query = "INSERT INTO estabelecimento(
                nome_admin,
                telefone_admin,
                cpf_admin,
                email,
                senha,
                nome,
                tipo,
                telefone,
                cnpj,
                status
            ) VALUES (
                :nome_admin,
                :telefone_admin,
                :cpf_admin,
                :email,
                :senha,
                :nome,
                :tipo,
                :telefone,
                :cnpj,
                :status
            )";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome_admin" => $estabelecimento->getNomeAdmin(),
                "telefone_admin" => $estabelecimento->getTelefoneAdmin(),
                "cpf_admin" => $estabelecimento->getCpfAdmin(),
                "email" => $estabelecimento->getEmail(),
                "senha" => $estabelecimento->getSenha(),
                "nome" => $estabelecimento->getNome(),
                "tipo" => "BARBEARIA",
                "telefone" => $estabelecimento->getTelefone(),
                "cnpj" => $estabelecimento->getCnpj(),
                "status" => "ATIVO"
            ]);

            return [
                $result,
                $result ? $this->pdo->lastInsertId() : 0
            ];
        }

        public function updateEstabelecimento(EstabelecimentoModel $estabelecimento, int $id): bool
        {
           $query = "UPDATE estabelecimento
                SET
                    nome_admin = :nome_admin,
                    telefone_admin = :telefone_admin,
                    cpf_admin = :cpf_admin,
                    nome = :nome,
                    telefone = :telefone,
                    cnpj = :cnpj
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "nome_admin" => $estabelecimento->getNomeAdmin(),
                "telefone_admin" => $estabelecimento->getTelefoneAdmin(),
                "cpf_admin" => $estabelecimento->getCpfAdmin(),
                "nome" => $estabelecimento->getNome(),
                "telefone" => $estabelecimento->getTelefone(),
                "cnpj" => $estabelecimento->getCnpj(),
                "id" => $id
            ]);

            return $result;
        }

        public function updateStatusEstabelecimento(EstabelecimentoModel $estabelecimento, int $id): bool
        {
           $query = "UPDATE estabelecimento
                SET
                    status = :status
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "status" => $estabelecimento->getStatus(),
                "id" => $id
            ]);

            return $result;
        }

        public function updateFotoPerfilEstabelecimento(EstabelecimentoModel $estabelecimento, int $id): bool
        {
           $query = "UPDATE estabelecimento
                SET
                    foto_perfil = :foto_perfil
            WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "foto_perfil" => $estabelecimento->getFotoPerfil(),
                "id" => $id
            ]);

            return $result;
        }

        public function deleteEstabelecimento(int $id): bool
        {
            $query = "DELETE FROM estabelecimento
                WHERE id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $result = $statement->execute([
                "id" => $id
            ]);

            return $result;
        }
    }