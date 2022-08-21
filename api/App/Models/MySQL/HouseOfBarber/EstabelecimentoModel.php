<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class EstabelecimentoModel{
        private $nomeAdmin;
        private $telefoneAdmin;
        private $cpfAdmin;
        private $email;
        private $senha;
        private $nome;
        private $tipo;
        private $telefone;
        private $cnpj;
        private $dataCadastro;
        private $status;
        private $fotoPerfil;

        /**
         * Get the value of nomeAdmin
         */
        public function getNomeAdmin()
        {
            return $this->nomeAdmin;
        }

        /**
         * Set the value of nomeAdmin
         */
        public function setNomeAdmin($nomeAdmin): self
        {
            $this->nomeAdmin = $nomeAdmin;

            return $this;
        }

        /**
         * Get the value of telefoneAdmin
         */
        public function getTelefoneAdmin()
        {
            return $this->telefoneAdmin;
        }

        /**
         * Set the value of telefoneAdmin
         */
        public function setTelefoneAdmin($telefoneAdmin): self
        {
            $this->telefoneAdmin = $telefoneAdmin;

            return $this;
        }

        /**
         * Get the value of cpfAdmin
         */
        public function getCpfAdmin()
        {
            return $this->cpfAdmin;
        }

        /**
         * Set the value of cpfAdmin
         */
        public function setCpfAdmin($cpfAdmin): self
        {
            $this->cpfAdmin = $cpfAdmin;

            return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of senha
         */
        public function getSenha()
        {
            return $this->senha;
        }

        /**
         * Set the value of senha
         */
        public function setSenha($senha): self
        {
            $this->senha = $senha;

            return $this;
        }

        /**
         * Get the value of nome
         */
        public function getNome()
        {
            return $this->nome;
        }

        /**
         * Set the value of nome
         */
        public function setNome($nome): self
        {
            $this->nome = $nome;

            return $this;
        }

        /**
         * Get the value of tipo
         */
        public function getTipo()
        {
            return $this->tipo;
        }

        /**
         * Set the value of tipo
         */
        public function setTipo($tipo): self
        {
            $this->tipo = $tipo;

            return $this;
        }

        /**
         * Get the value of telefone
         */
        public function getTelefone()
        {
            return $this->telefone;
        }

        /**
         * Set the value of telefone
         */
        public function setTelefone($telefone): self
        {
            $this->telefone = $telefone;

            return $this;
        }

        /**
         * Get the value of cnpj
         */
        public function getCnpj()
        {
            return $this->cnpj;
        }

        /**
         * Set the value of cnpj
         */
        public function setCnpj($cnpj): self
        {
            $this->cnpj = $cnpj;

            return $this;
        }

        /**
         * Get the value of dataCadastro
         */
        public function getDataCadastro()
        {
            return $this->dataCadastro;
        }

        /**
         * Set the value of dataCadastro
         */
        public function setDataCadastro($dataCadastro): self
        {
            $this->dataCadastro = $dataCadastro;

            return $this;
        }

        /**
         * Get the value of status
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * Set the value of status
         */
        public function setStatus($status): self
        {
            $this->status = $status;

            return $this;
        }

        /**
         * Get the value of fotoPerfil
         */
        public function getFotoPerfil()
        {
            return $this->fotoPerfil;
        }

        /**
         * Set the value of fotoPerfil
         */
        public function setFotoPerfil($fotoPerfil): self
        {
            $this->fotoPerfil = $fotoPerfil;

            return $this;
        }
    }