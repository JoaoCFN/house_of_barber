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
                        WHEN dias_funcionamento.dia IS NOT NULL 
                            THEN dias_funcionamento.dia
                        ELSE
                            'FECHADO'
                    END AS status_funcionamento,
                    dias_funcionamento.horario_abertura,
                    dias_funcionamento.horario_fechamento
                FROM estabelecimento
                LEFT JOIN endereco
                ON estabelecimento.id = endereco.estabelecimento_id
                LEFT JOIN dias_funcionamento
                ON estabelecimento.id = dias_funcionamento.estabelecimento_id
            ";

            $estabelecimentos = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $estabelecimentos;
        }

        public function findById(string $id): array
        {
            $query = "SELECT 
                    *
                FROM estabelecimento
                WHERE 
                    id = :id
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
                    email = :email,
                    senha = :senha,
                    nome = :nome,
                    tipo = :tipo,
                    telefone = :telefone,
                    cnpj = :cnpj,
                    data_cadastro = :data_cadastro,
                    status = :status
            WHERE id = :id";

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
                "data_cadastro" => $estabelecimento->getDataCadastro(),
                "status" => "ATIVO",
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