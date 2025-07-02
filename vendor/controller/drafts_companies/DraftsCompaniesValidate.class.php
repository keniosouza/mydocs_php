<?php

/** Defino o local da classe */
namespace vendor\controller\drafts_companies;

/** Importação de classes */
use \vendor\controller\main\Main;

class DraftsCompaniesValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();
    private $info = null;

    private $draft_companies_id = null;
    private $draft_id = null;
    private $company_id = null;
    private $text = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setDraftCompaniesId(int $draft_companies_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->draft_companies_id = isset($draft_companies_id) ? $this->main->antiInjection($draft_companies_id) : 0;

        /** Verificação dos dados de entrada */
        if ($this->draft_companies_id < 0)
        {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Minuta Empresa ID", deve ser válido');

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
            array_push($this->errors, 'O campo "Minuta", deve ser selecionado');

        }

    }

    public function setCompanyId(int $company_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->company_id = isset($company_id) ? $this->main->antiInjection($company_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->company_id <= 0)
        {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Empresa", deve ser válido');

        }

    }

    public function setText(string $text) : void
    {

        /** Tratamento dos dados de entrada */
        $this->text = isset($text) ? $this->main->antiInjection($text, 'S') : null;

        /** Verificação dos dados de entrada */
        if (empty($this->text))
        {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Texto", deve ser válido');

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
            array_push($this->errors, 'O campo "Histórico", deve ser válido');

        }

    }

    public function getDraftCompaniesId() : int
    {

        return (int)$this->draft_companies_id;

    }

    public function getDraftId() : int
    {

        return (int)$this->draft_id;

    }

    public function getCompanyId() : int
    {

        return (int)$this->company_id;

    }

    public function getText() : string
    {

        return (string)$this->text;

    }

    public function getHistory() : string
    {

        return (string)$this->history;

    }

    public function getErrors(): string
    {

        /** Verifico se deve informar os erros */
        if (count($this->errors)) {

            /** Verifica a quantidade de erros para informar a legenda */
            $this->info = count($this->errors) > 1 ? 'Os seguintes erros foram encontrados:' : 'O seguinte erro foi encontrado:';

            /** Lista os erros  */
            foreach ($this->errors as $keyError => $error) {

                /** Monto a mensagem de erro */
                $this->info .= '</br>' . ($keyError + 1) . ' - ' . $error;

            }

            /** Retorno os erros encontrados */
            return (string)$this->info;

        } else {

            return false;

        }

    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }

}
