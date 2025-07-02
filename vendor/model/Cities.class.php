<?php

/** Defino o local da classe */
namespace vendor\model;

class Cities
{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $state_id = null;

    /** Construtor da classe */
    public function __construct()
    {

        /** Instanciamento da classe */
        $this->connection = new MySql();

    }

    /** Listagem de todos os registros */
    public function all($state_id)
    {

        /** Parâmetros de entrad */
        $this->state_id = $state_id;

        /** Montagem do SQL */
        $this->sql = 'SELECT * FROM cities WHERE state_id = :state_id ORDER BY name ASC';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores */
        $this->stmt->bindParam(':state_id', $this->state_id);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }

}