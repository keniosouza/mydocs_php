<?php

/** Defino o local da classe */
namespace vendor\model;

class Situations
{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $situation_id = null;
    private $name = null;
    private $history = null;

    /** Construtor da classe */
    public function __construct()
    {

        /** Instanciamento da classe */
        $this->connection = new MySql();

    }

    /** Listagem de todos os registros */
    public function all()
    {

        /** Montagem do SQL */
        $this->sql = 'SELECT * FROM situations';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($situation_id, $name, $history)
    {

        /** Parâmetros de entrada */
        $this->situation_id = $situation_id;
        $this->name = $name;
        $this->history = $history;

        /** Verifico se é cadastro ou atualização */
        if ($this->situation_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO situations(situation_id, name, history) VALUES (:situation_id, :name, :history)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE situations SET name = :name, history = :history WHERE situation_id = :situation_id';
        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':situation_id', $this->situation_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function delete($situation_id)
    {

        /** Parâmetros de entrada */
        $this->situation_id = $situation_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM situations WHERE situation_id = :situation_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':situation_id', $this->situation_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($situation_id)
    {

        /** Parâmetros de entrada */
        $this->situation_id = $situation_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM situations WHERE situation_id = :situation_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':situation_id', $this->situation_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }

}