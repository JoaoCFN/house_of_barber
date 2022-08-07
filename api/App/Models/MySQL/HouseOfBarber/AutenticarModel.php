<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class AutenticarModel{
        private $idApiToken;
        private $email;
        private $token;
        private $dataAcesso;

        /**
         * Get the value of idApiTokens
         */
        public function getIdApiToken()
        {
            return $this->idApiToken;
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
         *
         * @return  self
         */
        public function setEmail($email)
        {
            $this->email = $email;

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
         *
         * @return  self
         */
        public function setToken($token)
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
         *
         * @return  self
         */
        public function setDataAcesso($dataAcesso)
        {
            $this->dataAcesso = $dataAcesso;

            return $this;
        }
    }