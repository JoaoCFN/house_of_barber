<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class TesteModel{
        private $nome;

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
    }