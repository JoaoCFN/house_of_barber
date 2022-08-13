<?php 
    namespace App\Models\MySQL\HouseOfBarber;

    class ServicoModel{
       private $id;
       private $nome;
       private $valor;
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