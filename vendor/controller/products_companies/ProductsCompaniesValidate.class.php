<?php

/** Defino o local da classe */
namespace vendor\controller\products_companies;

/** Importação de classes */
use \vendor\controller\main\Main;

class ProductsCompaniesValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();

    private $product_company_id = null;
    private $product_id = null;
    private $company_id = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setProductCompanyId(int $product_company_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->product_company_id = isset($product_company_id) ? $this->main->antiInjection($product_company_id) : 0;

        /** Verificação dos dados de entrada */
        if ($this->$product_company_id < 0)
        {

            /** Adição de elemento */
            array_push($this->errors, array('product_company_id', 'O campo "Minuta Empresa ID", deve ser válido'));

        }

    }

    public function setProductId(int $product_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->product_id = isset($product_id) ? $this->main->antiInjection($product_id) : null;

        /** Verificação dos dados de entrada */
        if ($this->product_id <= 0)
        {

            /** Adição de elemento */
            array_push($this->errors, array('name', 'O campo "Minuta", deve ser selecionado'));

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
            array_push($this->errors, array('name', 'O campo "Empresa", deve ser válido'));

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

    public function getProductCompanyId() : int
    {

        return (int)$this->product_company_id;

    }

    public function getProductId() : int
    {

        return (int)$this->product_id;

    }

    public function getCompanyId() : int
    {

        return (int)$this->company_id;

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
