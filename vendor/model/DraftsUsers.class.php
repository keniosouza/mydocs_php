<?php

/** Defino o local da classe */
namespace vendor\model;

class DraftsUsers{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $draft_user_id = null;
    private $draft_id = null;
    private $user_id = null;
    private $text = null;
    private $history = null;

    /** Construtor da classe */
    public function __construct()
    {

        /** Instanciamento da classe */
        $this->connection = new MySql();

    }

    /** Listagem de todos os registros */
    public function All(int $user_id)
    {

        /** Parâmetros de entrada */
        $this->user_id = $user_id;

        /** Montagem do SQL */
        $this->sql = 'SELECT
                      dc.draft_user_id,
                      d.name
                      FROM drafts_users dc 
                      LEFT JOIN drafts d ON dc.draft_id = d.draft_id
                      WHERE dc.user_id = :user_id
                      ORDER BY dc.user_id ASC';

        /** Preparo o SQL para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':user_id', $this->user_id);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function Save($draft_user_id, $draft_id, $user_id, $text, $history)
    {

        /** Parâmetros de entrada */
        $this->draft_user_id = $draft_user_id;
        $this->draft_id = $draft_id;
        $this->user_id = $user_id;
        $this->text = $text;
        $this->history = $history;

        /** Verifico se é cadastro ou atualização */
        if ($this->draft_user_id == 0)
        {

            /** Sql para inserção */
            $this->sql = 'INSERT INTO drafts_users(draft_user_id, draft_id, user_id, text, history) VALUES(:draft_user_id, :draft_id, :user_id, :text, :history)';

        }
        else{

            /** Sql para atualização */
            $this->sql = 'UPDATE drafts_users SET draft_id = :draft_id, user_id = :user_id, text = :text, history = :history WHERE draft_user_id = :draft_user_id';

        }

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':draft_user_id', $this->draft_user_id);
        $this->stmt->bindParam(':draft_id', $this->draft_id);
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':text', $this->text);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    /** Método para salvar um registro */
    public function SaveText($draft_user_id, $text, $history)
    {

        /** Parâmetros de entrada */
        $this->draft_user_id = $draft_user_id;
        $this->text = $text;
        $this->history = $history;

        /** Sql para atualização */
        $this->sql = 'UPDATE drafts_users SET text = :text, history = :history WHERE draft_user_id = :draft_user_id';

        /** Preparo o SQL */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':draft_user_id', $this->draft_user_id);
        $this->stmt->bindParam(':text', $this->text);
        $this->stmt->bindParam(':history', $this->history);

        /** Execução do sql */
        return $this->stmt->execute();

    }

    public function delete($draft_user_id)
    {

        /** Parâmetros de entrada */
        $this->draft_user_id = $draft_user_id;

        /** Sql de inserção */
        $this->sql = 'DELETE FROM drafts_users WHERE draft_user_id = :draft_user_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':draft_user_id', $this->draft_user_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function Get(int $draft_user_id)
    {

        /** Parâmetros de entrada */
        $this->draft_user_id = $draft_user_id;

        /** Sql de busca */
        $this->sql = 'SELECT dc.draft_user_id,
                             dc.draft_id,
                             dc.user_id,
                             dc.text,
                             dc.history,
                             d.name,
                             c.nickname,
                             c.email
                      FROM drafts_users dc
                      JOIN drafts d ON dc.draft_id = d.draft_id
                      JOIN users c ON dc.user_id = c.user_id
                      WHERE dc.draft_user_id = :draft_user_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':draft_user_id', $this->draft_user_id);

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