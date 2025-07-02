<?php

/** Defino o local da classe */
namespace vendor\model;

class Products
{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $product_id = null;
    private $user_id = null;
    private $situation_id = null;
    private $name = null;
    private $description = null;
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
        $this->sql = 'SELECT * FROM products';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($product_id, $user_id, $situation_id, $name, $description, $date_register, $date_update)
    {

        /** Parâmetros de entrada */
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->situation_id = $situation_id;
        $this->name = $name;
        $this->description = $description;
        $this->date_register = $date_register;
        $this->date_update = $date_update;

        /** Verifico se é cadastro ou atualização */
        if ($this->product_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO products(product_id, user_id, situation_id, name, description, date_register, date_update) VALUES (:product_id, :user_id, :situation_id, :name, :description, :date_register, :date_update)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE products SET product_id = :product_id, user_id = :user_id, situation_id = :situation_id, name = :name, description = :description, date_register = :date_register, date_update = :date_update WHERE product_id = :product_id';
        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':product_id', $this->product_id);
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':situation_id', $this->situation_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':description', $this->description);
        $this->stmt->bindParam(':date_register', $this->date_register);
        $this->stmt->bindParam(':date_update', $this->date_update);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function delete($product_id)
    {

        /** Parâmetros de entrada */
        $this->product_id = $product_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM products WHERE product_id = :product_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':product_id', $this->product_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($product_id)
    {

        /** Parâmetros de entrada */
        $this->product_id = $product_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM products WHERE product_id = :product_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':product_id', $this->product_id);

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