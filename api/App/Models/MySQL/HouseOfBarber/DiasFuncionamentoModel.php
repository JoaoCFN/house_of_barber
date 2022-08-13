<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class DiasFuncionamentoModel{
       private $id;
       private $dia;
       private $horarioAbertura;
       private $horarioFechamento;
       private $estabelecimentoId;

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
        * Get the value of dia
        */
        public function getDia()
        {
            return $this->dia;
        }

        /**
        * Set the value of dia
        */
        public function setDia($dia): self
        {
            $this->dia = $dia;

            return $this;
        }

        /**
        * Get the value of horarioAbertura
        */
        public function getHorarioAbertura()
        {
            return $this->horarioAbertura;
        }

        /**
        * Set the value of horarioAbertura
        */
        public function setHorarioAbertura($horarioAbertura): self
        {
            $this->horarioAbertura = $horarioAbertura;

            return $this;
        }

        /**
        * Get the value of horarioFechamento
        */
        public function getHorarioFechamento()
        {
            return $this->horarioFechamento;
        }

        /**
        * Set the value of horarioFechamento
        */
        public function setHorarioFechamento($horarioFechamento): self
        {
            $this->horarioFechamento = $horarioFechamento;

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
    }