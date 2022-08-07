<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class ClienteModel{
        private $nome;
        private $telefone;
        private $dataNascimento;
        private $cpf;
        private $email;
        private $senha;
        private $subGoogle;
        private $dataCadastro;

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
         * Get the value of dataNascimento
         */
        public function getDataNascimento()
        {
            return $this->dataNascimento;
        }

        /**
         * Set the value of dataNascimento
         */
        public function setDataNascimento($dataNascimento): self
        {
            $this->dataNascimento = $dataNascimento;

            return $this;
        }

        /**
         * Get the value of cpf
         */
        public function getCpf()
        {
            return $this->cpf;
        }

        /**
         * Set the value of cpf
         */
        public function setCpf($cpf): self
        {
            $this->cpf = $cpf;

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
         * Get the value of subGoogle
         */
        public function getSubGoogle()
        {
            return $this->subGoogle;
        }

        /**
         * Set the value of subGoogle
         */
        public function setSubGoogle($subGoogle): self
        {
            $this->subGoogle = $subGoogle;

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
    }