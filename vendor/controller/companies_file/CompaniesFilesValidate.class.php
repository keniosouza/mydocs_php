<?php

/** Defino o local da classe */
namespace vendor\controller\companies_file;

/** Importação de classes */
use \vendor\controller\main\Main;

class CompaniesFilesValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();

    private $company_file_id = null;
    private $company_id = null;
    private $name = null;
    private $path = null;
    private $extension = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setCompanyFileId(int $company_file_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->company_file_id = isset($company_file_id) ? $this->main->antiInjection($company_file_id) : 0;

        /** Verificação dos dados de entrada */
        if ($this->company_file_id < 0)
        {

            /** Adição de elemento */
            array_push($this->errors, array('company_file_id', 'O campo "Empresa Arquivo ID", deve ser válido'));

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
            array_push($this->errors, array('company_id', 'O campo "Empresa ID", deve ser selecionado'));

        }

    }

    public function setPath(string $path) : void
    {

        /** Tratamento dos dados de entrada */
        $this->path = isset($path) ? $this->main->antiInjection($path) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->path))
        {

            /** Adição de elemento */
            array_push($this->errors, array('name', 'O campo "Caminho", deve ser válido'));

        }

    }

    public function setName(string $name) : void
    {

        /** Tratamento dos dados de entrada */
        $this->name = isset($name) ? $this->main->antiInjection($name) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->name))
        {

            /** Adição de elemento */
            array_push($this->errors, array('text', 'O campo "Nome", deve ser válido'));

        }

    }

    public function setExtension(string $extension) : void
    {

        /** Tratamento dos dados de entrada */
        $this->extension = isset($extension) ? $this->main->antiInjection($extension) : null;

        /** Verificação dos dados de entrada */
        if (empty($this->extension))
        {

            /** Adição de elemento */
            array_push($this->errors, array('extension', 'O campo "Extensão", deve ser válido'));

        }

    }

    public function setHistory(array $history) : void
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

    public function getCompanyFileId() : int
    {

        return (int)$this->company_file_id;

    }

    public function getCompanyId() : int
    {

        return (int)$this->company_id;

    }

    public function getName() : string
    {

        return (string)$this->name;

    }

    public function getPath() : string
    {

        return (string)$this->path;

    }

    public function getExtension() : string
    {

        return (string)$this->extension;

    }

    public function getHistory() : array
    {

        return (array)$this->history;

    }

    public function getErrors()
    {

        return $this->errors;

    }

    public function getFullPath()
    {

        /** Retorno da informação */
        return (string)$this->path . '/' . (string)$this->name;

    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }

}
