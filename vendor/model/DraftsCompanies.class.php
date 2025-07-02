<?php

/** Defino o local da classe */
namespace vendor\model;

class DraftsCompanies{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $draft_companies_id = null;
    private $draft_id = null;
    private $company_id = null;
    private $text = null;
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
                      dc.draft_companies_id,
                      dc.company_id,
                      d.name
                      FROM drafts_companies dc 
                      LEFT JOIN drafts d ON dc.draft_id = d.draft_id
                      WHERE dc.company_id = :company_id
                      ORDER BY dc.draft_companies_id ASC';

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
    public function Save($draft_companies_id, $draft_id, $company_id, $text, $history)
    {

        /** Parâmetros de entrada */
        $this->draft_companies_id = $draft_companies_id;
        $this->draft_id = $draft_id;
        $this->company_id = $company_id;
        $this->text = $text;
        $this->history = $history;

        /** Verifico se é cadastro ou atualização */
        if ($this->draft_companies_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO drafts_companies(draft_companies_id, draft_id, company_id, text, history) VALUES(:draft_companies_id, :draft_id, :company_id, :text, :history)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE drafts_companies SET draft_id = :draft_id, company_id = :company_id, text = :text, history = :history WHERE draft_companies_id = :draft_companies_id';

        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':draft_companies_id', $this->draft_companies_id);
        $this->stmt->bindParam(':draft_id', $this->draft_id);
        $this->stmt->bindParam(':company_id', $this->company_id);
        $this->stmt->bindParam(':text', $this->text);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    /** Método para salvar um registro */
    public function SaveText($draft_companies_id, $text, $history)
    {

        /** Parâmetros de entrada */
        $this->draft_companies_id = $draft_companies_id;
        $this->text = $text;
        $this->history = $history;

        /** Sql para atualização */
        $this->sql = 'UPDATE drafts_companies SET text = :text, history = :history WHERE draft_companies_id = :draft_companies_id';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':draft_companies_id', $this->draft_companies_id);
        $this->stmt->bindParam(':text', $this->text);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function delete($draft_companies_id)
    {

        /** Parâmetros de entrada */
        $this->draft_companies_id = $draft_companies_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM drafts_companies WHERE draft_companies_id = :draft_companies_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':draft_companies_id', $this->draft_companies_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function Get(int $draft_companies_id)
    {

        /** Parâmetros de entrada */
        $this->draft_companies_id = $draft_companies_id;

        /** Sql de busca */
        $this->sql = 'SELECT dc.draft_companies_id,
                             dc.draft_id,
                             dc.company_id,
                             dc.text,
                             dc.history,
                             d.name,
                             c.nickname,
                             c.email
                      FROM drafts_companies dc
                      JOIN drafts d ON dc.draft_id = d.draft_id
                      JOIN companies c ON dc.company_id = c.company_id
                      WHERE dc.draft_companies_id = :draft_companies_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':draft_companies_id', $this->draft_companies_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    /** Método para salvar um registro */
    public function SaveHistory($draft_companies_id, $history)
    {

        /** Parâmetros de entrada */
        $this->draft_companies_id = $draft_companies_id;
        $this->history = $history;

        /** Sql para atualização */
        $this->sql = 'UPDATE drafts_companies SET history = :history WHERE draft_companies_id = :draft_companies_id';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':draft_companies_id', $this->draft_companies_id);
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