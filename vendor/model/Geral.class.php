<?php

/** Defino o local onde esta a classe */
namespace vendor\model;

/** Importação de classes */
use \vendor\controller\main\Main;

class Geral
{
	/** Declaro as variavéis da classe */
	private $connection = null;
	private $Main = null;
	private $Config = null;
	private $sql = null;
	private $stmt = null;

	private $table = null;
	private $primaryKey = null;
	private $primaryKeyValue = null;
	private $column = null;

	private $tableSchema = null;

    /** Construtor da classe */
	function __construct()
	{

		/** Cria o objeto de conexão com o banco de dados */
		$this->connection = new MySql();

        /** Instânciamento de classes */
        $this->Main = new Main();

        /** Operações */
        $this->Config = $this->Main->LoadConfig();

	}

	/** Busca genérica de registro */
    public function Get(string $table, string $primaryKey, string $column, int $primaryKeyValue) :  ? string
    {

        /** Parâmetros de Entrada */
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->primaryKeyValue = $primaryKeyValue;
        $this->column = $column;

        /** Consulta SQL*/
        $this->sql = "SELECT {$this->column} AS CAMPO FROM {$this->table} WHERE {$this->primaryKey} = :primaryKeyValue";

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preenchimento dos parâmetros */
        $this->stmt->bindParam(':primaryKeyValue',$this->primaryKeyValue);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno em formato de obeto */
        return $this->stmt->fetchObject()->CAMPO;

    }

    /** Busca genérica de registro */
    public function AllTables()
    {

        /** Parâmetros de Entrada */
        $this->tableSchema = (string)$this->Config->database->name;

        /** Consulta SQL*/
        $this->sql = "SELECT TABLE_NAME FROM information_schema.tables where table_schema = :tableSchema;";

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preenchimento dos parâmetros */
        $this->stmt->bindParam(':tableSchema', $this->tableSchema);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno em formato de obeto */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

	/** Fecha uma conexão aberta anteriormente com o banco de dados */
	function __destruct()
	{

		$this->connection = null;

    }

}
