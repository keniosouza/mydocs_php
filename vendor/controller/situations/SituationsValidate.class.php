<?php

/** Defino o local da classe */
namespace vendor\controller\situations;

/** Importação de classes */
use \vendor\controller\main\Main;

class SituationsValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();

    private $situation_id = null;
    private $name = null;
    private $history = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setSituationId(int $situation_id) : void
    {

        $this->situation_id = isset($situation_id) ? $this->main->antiInjection($situation_id) : null;

    }

    public function setName($name)
    {

        $this->name = isset($name) ? $this->main->antiInjection($name) : null;

    }

    public function setHistory($history)
    {

        $this->history = isset($history) ? $this->main->antiInjection($history) : null;

    }

    public function getSituationId() : int
    {

        return (int)$this->situation_id;

    }

    public function getName()
    {

        return $this->name;

    }

    public function getHistory()
    {

        return $this->history;

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
