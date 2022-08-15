<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class AgendamentoServicoModel{
        private $agendamentoId;
        private $servicoId;
       
        /**
         * Get the value of agendamentoId
         */
        public function getAgendamentoId()
        {
            return $this->agendamentoId;
        }

        /**
         * Set the value of agendamentoId
         */
        public function setAgendamentoId($agendamentoId): self
        {
            $this->agendamentoId = $agendamentoId;

            return $this;
        }

        /**
         * Get the value of servicoId
         */
        public function getServicoId()
        {
            return $this->servicoId;
        }

        /**
         * Set the value of servicoId
         */
        public function setServicoId($servicoId): self
        {
            $this->servicoId = $servicoId;

            return $this;
        }
    }