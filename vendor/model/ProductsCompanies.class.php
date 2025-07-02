<?php

/** Defino o local da classe */
namespace vendor\model;

class ProductsCompanies{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $product_company_id = null;
    private $product_id = null;
    private $company_id = null;
    private $history = null;

    /** Construtor da classe */
    public function __construct()
    {

        /** Instanciamento da classe */
        $this->connection = new MySql();

    }

    /** Listagem de todos os registros */
    public function All(int $company_id)
    {

        /** Parâmetros de entrada */
        $this->company_id = $company_id;

        /** Montagem do SQL */
        $this->sql = 'SELECT
                      pc.product_company_id,
                      pc.company_id,
                      p.name
                      FROM products_companies pc 
                      LEFT JOIN products p ON pc.product_id = p.product_id
                      WHERE pc.company_id = :company_id';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':company_id', $this->company_id);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function Save($product_company_id, $product_id, $company_id, $history)
    {

        /** Parâmetros de entrada */
        $this->product_company_id = $product_company_id;
        $this->product_id = $product_id;
        $this->company_id = $company_id;
        $this->history = $history;

        /** Sql para inserção */
        $this->sql = 'INSERT INTO products_companies(product_company_id, product_id, company_id, history) VALUES(:product_company_id, :product_id, :company_id, :history)';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':product_company_id', $this->product_company_id);
        $this->stmt->bindParam(':product_id', $this->product_id);
        $this->stmt->bindParam(':company_id', $this->company_id);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function Get($product_company_id)
    {

        /** Parâmetros de entrada */
        $this->product_company_id = $product_company_id;

        /** Sql de busca */
        $this->sql = 'SELECT * FROM products_companies WHERE product_company_id = :product_company_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':product_company_id', $this->product_company_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    public function delete($product_company_id)
    {

        /** Parâmetros de entrada */
        $this->product_company_id = $product_company_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM products_companies WHERE product_company_id = :product_company_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':product_company_id', $this->product_company_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }

}