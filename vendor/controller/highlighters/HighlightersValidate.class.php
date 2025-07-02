<?php

/** Defino o local da classe */
namespace vendor\controller\highlighters;

/** Importação de classes */
use \vendor\controller\main\Main;

class HighlightersValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();
    private $info = null;

    private $highlighter_id = null;
    private $name = null;
    private $text = array();
    private $group = null;
    private $history = array();
    private $preferences = array(); 

    private $table = null;
    private $column = null;
    private $primaryKey = null;

    private $mask = null;
    private $uppercase = null;
    private $lowercase = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setHighlighterId(int $highlighter_id) : void
    {


        /** Tratamento da informação */
        $this->highlighter_id = isset($highlighter_id) ? $this->main->antiInjection($highlighter_id) : null;

        /** Validação da informação */
        if ($this->highlighter_id < 0){

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Marcação ID", deve ser preenchido');

        }

    }

    public function setName(string $name) : void
    {

        /** Tratamento da informação */
        $this->name = isset($name) ? $this->main->antiInjection($name) : null;
        $this->name = str_replace(' ', '_', strtoupper($this->name));

        /** Validação da informação */
        if (empty($this->name)){

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Nome", deve ser preenchido');

        }


    }

    public function setText(string $text) : void
    {

        /** Tratamento da informação */
        $this->text = isset($text) ? $this->main->antiInjection($text, 'S') : null;

        /** Validação da informação */
        if (empty($this->text)){

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Texto", deve ser preenchido');

        }

    }

    public function setGroup(string $group) : void
    {

        /** Tratamento da informação */
        $this->group = isset($group) ? $this->main->antiInjection($group) : null;

        /** Validação da informação */
        if (empty($this->group)){

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Grupo", deve ser preenchido');

        }

    }

    public function setTable(string $table) : void
    {

        /** Tratamento da informação */
        $this->table = isset($table) ? $this->main->antiInjection($table) : null;

    }

    public function setColumn(string $column) : void
    {

        /** Tratamento da informação */
        $this->column = isset($column) ? $this->main->antiInjection($column) : null;

    }

    public function setPrimaryKey(string $primaryKey) : void
    {

        /** Tratamento da informação */
        $this->primaryKey = isset($primaryKey) ? $this->main->antiInjection($primaryKey) : null;

    }

    public function setMask(string $mask) : void
    {

        /** Tratamento da informação */
        $this->mask = isset($mask) ? $this->main->antiInjection($mask) : null;

    }

    public function setUppercase(bool $uppercase) : void
    {

        /** Tratamento da informação */
        $this->uppercase = isset($uppercase) ? $this->main->antiInjection($uppercase) : null;

        /** Verifico se vai usar a formatação */
        if ($this->uppercase){

            /** Adição de elemento */
            $this->uppercase = '<span style="text-transform: uppercase;">#</span>';

        }

    }

    public function setLowercase(bool $lowercase) : void
    {

        /** Tratamento da informação */
        $this->lowercase = isset($lowercase) ? $this->main->antiInjection($lowercase) : null;

        /** Verifico se vai usar a formatação */
        if ($this->lowercase){

            /** Adição de elemento */
            $this->lowercase = '<span style="text-transform: lowercase;">#</span>';

        }

    }

    public function setHistory(array $history) : void
    {

        $this->history = isset($history) ? $this->main->antiInjection($history) : null;

    }
    public function setPreferences(string $preferences)
    {

        /** Tratamento da informação */
        $this->preferences = isset($preferences) ? $this->main->antiInjection($preferences, 'S') : null;

        /** Validação da informação */
        if (empty($this->preferences)){

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Texto", deve ser preenchido');

        }

    }    

    public function getHighlighterId()
    {

        return $this->highlighter_id;

    }

    public function getName()
    {

        return $this->name;

    }

    public function getText()
    {

        return $this->text;

    }

    public function getGroup()
    {

        return $this->group;

    }

    public function getTable() : string
    {

        return (string)$this->table;

    }

    public function getColumn() : string
    {

        return (string)$this->column;

    }

    public function getPrimaryKey() : string
    {

        return (string)$this->primaryKey;

    }

    public function getMask() : string
    {

        return (string)$this->mask;

    }

    public function getUppercase() : string
    {

        return (string)$this->uppercase;

    }

    public function getLowercase() : string
    {

        return (string)$this->lowercase;

    }

    public function getHistory() : array
    {

        return (array)$this->history;

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

    public function getPreferences()
    {
        return $this->preferences;
    }

    /** Método Destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }


    /**
     * Set the value of preferences
     *
     * @return  self
     */ 

}
