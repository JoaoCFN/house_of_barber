<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class AgendamentoModel{
        private $id;
        private $clienteId;
        private $estabelecimentoId;
        private $dataAgendamento;
        private $horarioAgendamento;
        private $valor;
        private $status;
        private $dataCriacao;

        /**
         * Get the value of id
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
            $this->id = $id;

            return $this;
        }

        /**
         * Get the value of clienteId
         */
        public function getClienteId()
        {
            return $this->clienteId;
        }

        /**
         * Set the value of clienteId
         */
        public function setClienteId($clienteId): self
        {
            $this->clienteId = $clienteId;

            return $this;
        }

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
         * Get the value of dataAgendamento
         */
        public function getDataAgendamento()
        {
            return $this->dataAgendamento;
        }

        /**
         * Set the value of dataAgendamento
         */
        public function setDataAgendamento($dataAgendamento): self
        {
            $this->dataAgendamento = $dataAgendamento;

            return $this;
        }

        /**
         * Get the value of horarioAgendamento
         */
        public function getHorarioAgendamento()
        {
            return $this->horarioAgendamento;
        }

        /**
         * Set the value of horarioAgendamento
         */
        public function setHorarioAgendamento($horarioAgendamento): self
        {
            $this->horarioAgendamento = $horarioAgendamento;

            return $this;
        }

        /**
         * Get the value of valor
         */
        public function getValor()
        {
            return $this->valor;
        }

        /**
         * Set the value of valor
         */
        public function setValor($valor): self
        {
            $this->valor = $valor;

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
         * Get the value of dataCriacao
         */
        public function getDataCriacao()
        {
            return $this->dataCriacao;
        }

        /**
         * Set the value of dataCriacao
         */
        public function setDataCriacao($dataCriacao): self
        {
            $this->dataCriacao = $dataCriacao;

            return $this;
        }
    }