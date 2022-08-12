<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class AutenticarModel{
        private $idApiToken;
        private $idUsuario;
        private $perfil;
        private $token;
        private $dataAcesso;

        /**
         * Get the value of idApiToken
         */
        public function getIdApiToken()
        {
            return $this->idApiToken;
        }

        /**
         * Set the value of idApiToken
         */
        public function setIdApiToken($idApiToken): self
        {
            $this->idApiToken = $idApiToken;

            return $this;
        }

        /**
         * Get the value of idUsuario
         */
        public function getIdUsuario()
        {
            return $this->idUsuario;
        }

        /**
         * Set the value of idUsuario
         */
        public function setIdUsuario($idUsuario): self
        {
            $this->idUsuario = $idUsuario;

            return $this;
        }

        /**
         * Get the value of perfil
         */
        public function getPerfil()
        {
            return $this->perfil;
        }

        /**
         * Set the value of perfil
         */
        public function setPerfil($perfil): self
        {
            $this->perfil = $perfil;

            return $this;
        }

        /**
         * Get the value of token
         */
        public function getToken()
        {
            return $this->token;
        }

        /**
         * Set the value of token
         */
        public function setToken($token): self
        {
            $this->token = $token;

            return $this;
        }

        /**
         * Get the value of dataAcesso
         */
        public function getDataAcesso()
        {
            return $this->dataAcesso;
        }

        /**
         * Set the value of dataAcesso
         */
        public function setDataAcesso($dataAcesso): self
        {
            $this->dataAcesso = $dataAcesso;

            return $this;
        }
    }