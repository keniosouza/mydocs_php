<?php

/** Defino o local da classe */
namespace vendor\model;

class CompaniesFiles{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $company_file_id = null;
    private $company_id = null;
    private $name = null;
    private $path = null;
    private $extension = null;
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
        $this->sql = 'SELECT * FROM companies_files WHERE company_id = :company_id';

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
    public function Save($company_file_id, $company_id, $name, $path, $extension, $history)
    {

        /** Parâmetros de entrada */
        $this->company_file_id = $company_file_id;
        $this->company_id = $company_id;
        $this->name = $name;
        $this->path = $path;
        $this->extension = $extension;
        $this->history = $history;

        /** Sql para inserção */
        $this->sql = 'INSERT INTO companies_files(company_file_id, company_id, name, path, extension, history) VALUES(:company_file_id, :company_id, :name, :path, :extension, :history)';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':company_file_id', $this->company_file_id);
        $this->stmt->bindParam(':company_id', $this->company_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':path', $this->path);
        $this->stmt->bindParam(':extension', $this->extension);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function Get($company_file_id)
    {

        /** Parâmetros de entrada */
        $this->company_file_id = $company_file_id;

        /** Sql de busca */
        $this->sql = 'SELECT cf.company_file_id,
                             cf.company_id,
                             cf.name,
                             cf.path,
                             cf.extension,
                             cf.history,
                             c.nickname,
                             c.email
                      FROM companies_files cf
                      JOIN companies c ON cf.company_id = c.company_id
                      WHERE cf.company_file_id = :company_file_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':company_file_id', $this->company_file_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    public function Delete($company_file_id)
    {

        /** Parâmetros de entrada */
        $this->company_file_id = $company_file_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM companies_files WHERE company_file_id = :company_file_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':company_file_id', $this->company_file_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    /** Método para salvar um registro */
    public function SaveHistory($company_file_id, $history)
    {

        /** Parâmetros de entrada */
        $this->company_file_id = $company_file_id;
        $this->history = $history;

        /** Sql para atualização */
        $this->sql = 'UPDATE companies_files SET history = :history WHERE company_file_id = :company_file_id';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':company_file_id', $this->company_file_id);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }

}