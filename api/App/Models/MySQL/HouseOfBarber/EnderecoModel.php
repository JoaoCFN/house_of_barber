<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class EnderecoModel{
        private $estabelecimentoId;
        private $cep;
        private $estado;
        private $cidade;
        private $bairro;
        private $rua;
        private $numero;

        /**
         * Get the value of estabelecimentoId
         */
        public function getEstabelecimentoId()
        {
            return $this->estabelecimentoId;
        }

        /**
         * Set the value of estabelecimentoId
         */
        public function setEstabelecimentoId($estabelecimentoId): self
        {
            $this->estabelecimentoId = $estabelecimentoId;

            return $this;
        }

        /**
         * Get the value of cep
         */
        public function getCep()
        {
            return $this->cep;
        }

        /**
         * Set the value of cep
         */
        public function setCep($cep): self
        {
            $this->cep = $cep;

            return $this;
        }

        /**
         * Get the value of estado
         */
        public function getEstado()
        {
            return $this->estado;
        }

        /**
         * Set the value of estado
         */
        public function setEstado($estado): self
        {
            $this->estado = $estado;

            return $this;
        }

        /**
         * Get the value of cidade
         */
        public function getCidade()
        {
            return $this->cidade;
        }

        /**
         * Set the value of cidade
         */
        public function setCidade($cidade): self
        {
            $this->cidade = $cidade;

            return $this;
        }

        /**
         * Get the value of bairro
         */
        public function getBairro()
        {
            return $this->bairro;
        }

        /**
         * Set the value of bairro
         */
        public function setBairro($bairro): self
        {
            $this->bairro = $bairro;

            return $this;
        }

        /**
         * Get the value of rua
         */
        public function getRua()
        {
            return $this->rua;
        }

        /**
         * Set the value of rua
         */
        public function setRua($rua): self
        {
            $this->rua = $rua;

            return $this;
        }

        /**
         * Get the value of numero
         */
        public function getNumero()
        {
            return $this->numero;
        }

        /**
         * Set the value of numero
         */
        public function setNumero($numero): self
        {
            $this->numero = $numero;

            return $this;
        }
    }