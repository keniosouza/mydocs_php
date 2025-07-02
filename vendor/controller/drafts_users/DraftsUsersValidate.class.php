<?php

/** Defino o local da classe */
namespace vendor\controller\drafts_users;

/** Importação de classes */
use \vendor\controller\main\Main;

class DraftsUsersValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();

    private $draft_user_id = null;
    private $draft_id = null;
    private $user_id = null;
    private $text = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setDraftUserId(int $draft_user_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->draft_user_id = isset($draft_user_id) ? $this->main->antiInjection($draft_user_id) : 0;

        /** Verificação dos dados de entrada */
        if ($this->draft_user_id < 0)
        {

            /** Adição de elemento */
            array_push($this->errors, array('draft_user_id', 'O campo "Minuta Usuário ID", deve ser válido'));

        }

    }

    public function setDraftId(int $draft_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->draft_id = isset($draft_id) ? $this->main->antiInjection($draft_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->draft_id <= 0)
        {

            /** Adição de elemento */
            array_push($this->errors, array('name', 'O campo "Minuta", deve ser selecionado'));

        }

    }

    public function setUserId(int $user_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->user_id = isset($user_id) ? $this->main->antiInjection($user_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->user_id <= 0)
        {

            /** Adição de elemento */
            array_push($this->errors, array('name', 'O campo "Usuário", deve ser válido'));

        }

    }

    public function setText(string $text) : void
    {

        /** Tratamento dos dados de entrada */
        $this->text = isset($text) ? $this->main->antiInjection($text) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->text))
        {

            /** Adição de elemento */
            array_push($this->errors, array('text', 'O campo "Texto", deve ser válido'));

        }

    }

    public function setHistory(string $history) : void
    {

        /** Tratamento dos dados de entrada */
        $this->history = isset($history) ? $this->main->antiInjection($history) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->history))
        {

            /** Adição de elemento */
            array_push($this->errors, array('text', 'O campo "Histórico", deve ser válido'));

        }

    }

    public function getDraftUserId() : int
    {

        return (int)$this->draft_user_id;

    }

    public function getDraftId() : int
    {

        return (int)$this->draft_id;

    }

    public function getUserId() : int
    {

        return (int)$this->user_id;

    }

    public function getText() : string
    {

        return (string)$this->text;

    }

    public function getHistory() : string
    {

        return (string)$this->history;

    }

    public function getErrors()
    {

        return $this->errors;

    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }

}
