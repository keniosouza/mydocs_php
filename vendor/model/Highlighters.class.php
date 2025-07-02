<?php

/** Defino o local da classe */
namespace vendor\model;

class Highlighters
{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $highlighter_id = null;
    private $name = null;
    private $text = null;
    private $group = null;
    private $history = null;
    private $preferences = null;

    /** Construtor da classe */
    public function __construct()
    {

        /** Instanciamento da classe */
        $this->connection = new MySql();

    }

    /** Listagem de todos os registros */
    public function All()
    {

        /** Montagem do SQL */
        $this->sql = 'SELECT * FROM highlighters';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function Save($highlighter_id, $name, $text, $group, $history, $preferences)
    {

        /** Parâmetros de entrada */
        $this->highlighter_id = $highlighter_id;
        $this->name = $name;
        $this->text = $text;
        $this->group = $group;
        $this->history = $history;
        $this->preferences = $preferences;

        /** Verifico se é cadastro ou atualização */
        if ($this->highlighter_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO highlighters(highlighter_id, name, text, `group`, history, preferences) VALUES (:highlighter_id, :name, :text, :group, :history, :preferences)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE highlighters SET name = :name, text = :text, `group` = :group, history = :history, preferences = :preferences WHERE highlighter_id = :highlighter_id';
        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam('highlighter_id', $this->highlighter_id);
        $this->stmt->bindParam('name', $this->name);
        $this->stmt->bindParam('text', $this->text);
        $this->stmt->bindParam('group', $this->group);
        $this->stmt->bindParam('history', $this->history);
        $this->stmt->bindParam('preferences',$this->preferences);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function Delete($highlighter_id)
    {

        /** Parâmetros de entrada */
        $this->highlighter_id = $highlighter_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM highlighters WHERE highlighter_id = :highlighter_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':highlighter_id', $this->highlighter_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function Get($highlighter_id)
    {

        /** Parâmetros de entrada */
        $this->highlighter_id = $highlighter_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM highlighters WHERE highlighter_id = :highlighter_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':highlighter_id', $this->highlighter_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    /** Busco o registro pelo nome */
    public function GetByName($name)
    {

        /** Parâmetros de entrada */
        $this->name = $name;

        /** Consulta SQL*/
        $this->sql = 'SELECT * FROM highlighters WHERE name = :name';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preenchimento dos para^metros */
        $this->stmt->bindParam(':name',$this->name);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchObject();

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }

}