<?php

/** Defino o local da classe */
namespace vendor\model;

class Trails{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $trail_id = null;
    private $user_id = null;
    private $text = null;
    private $date_register = null;

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
        $this->sql = 'SELECT * FROM drafts';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function Save($trail_id, $user_id, $text, $date_register) : void
    {

        /** Parâmetros de entrada */
        $this->trail_id = $trail_id;
        $this->user_id = $user_id;
        $this->text = $text;
        $this->date_register = $date_register;

        /** Sql para inserção */
        $this->sql = 'INSERT INTO trails(trail_id, user_id, text, date_register) VALUES (:trail_id, :user_id, :text, :date_register)';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':trail_id', $this->trail_id);
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':text', $this->text);
        $this->stmt->bindParam(':date_register', $this->date_register);

        /** Execução do sql */
        $this->stmt->execute();

    }

    public function delete($trail_id)
    {

        /** Parâmetros de entrada */
        $this->trail_id = $trail_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM trails WHERE trail_id = :trail_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':trail_id', $this->trail_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get(int $trail_id)
    {

        /** Parâmetros de entrada */
        $this->trail_id = $trail_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM trails WHERE trail_id = :trail_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':trail_id', $this->trail_id);

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