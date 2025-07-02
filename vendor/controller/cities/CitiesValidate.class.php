<?php

/** Defino o local da classe */
namespace vendor\controller\Cities;

/** Importação de classes */
use \vendor\controller\main\Main;

class CitiesValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();

    private $state_id = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setStateId($state_id)
    {

        $this->state_id = isset($state_id) ? $this->main->antiInjection($state_id) : null;

    }

    public function getStateId()
    {

        return $this->state_id;

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
