<?php

/** Defino o local da classe */
namespace vendor\model;

class Permissions{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $permission_id = null;
    private $name = null;
    private $permissions = null;
    private $date_register = null;
    private $date_update = null;

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
        $this->sql = 'SELECT * FROM permissions';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($permission_id, $name, $permissions, $date_register, $date_update)
    {

        /** Parâmetros de entrada */
        $this->permission_id = $permission_id;
        $this->name = $name;
        $this->permissions = $permissions;
        $this->date_register = $date_register;
        $this->date_update = $date_update;

        /** Verifico se é cadastro ou atualização */
        if ($this->permission_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO permissions(permission_id, name, permissions, date_register, date_update) VALUES (:permission_id, :name, :permissions, :date_register, :date_update)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE permissions SET permission_id = :permission_id, name = :name, permissions = :permissions, date_register = :date_register, date_update = :date_update WHERE permission_id = :permission_id';

        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':permission_id', $this->permission_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':permissions', $this->permissions);
        $this->stmt->bindParam(':date_register', $this->date_register);
        $this->stmt->bindParam(':date_update', $this->date_update);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function delete($permission_id)
    {

        /** Parâmetros de entrada */
        $this->permission_id = $permission_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM permissions WHERE permission_id = :permission_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':permission_id', $this->permission_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($permission_id)
    {

        /** Parâmetros de entrada */
        $this->permission_id = $permission_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM permissions WHERE permission_id = :permission_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':permission_id', $this->permission_id);

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