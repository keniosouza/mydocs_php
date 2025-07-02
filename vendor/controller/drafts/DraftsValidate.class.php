<?php

/** Defino o local da classe */
namespace vendor\controller\Drafts;

/** Importação de classes */
use \vendor\controller\main\Main;

class DraftsValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;
    private $inputs = null;

    private $draft_id = null;
    private $name = null;
    private $text = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setDraftId(int $draft_id) : void
    {

        /** Tratamento dos dados de entrada */
        $this->draft_id = isset($draft_id) ? $this->Main->antiInjection($draft_id) : 0;

        /** Validação da informação */
        if ($this->draft_id < 0) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Minuta ID", deve ser válido');

        }

    }

    public function setName(string $name) : void
    {

        /** Tratamento dos dados de entrada */
        $this->name = isset($name) ? $this->Main->antiInjection($name) : null;

        /** Validação da informação */
        if (empty($this->name)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Nolme", deve ser válido');

        }

    }

    public function setText(string $text) : void
    {

        /** Tratamento dos dados de entrada */
        $this->text = isset($text) ? $this->Main->antiInjection($text, 'S') : null;

        /** Validação da informação */
        if (empty($this->text)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Texto", deve ser válido');

        }

    }

    public function getDraftId() : int
    {

        return (int)$this->draft_id;

    }

    public function getName() : string
    {

        return (string)$this->name;

    }

    public function getText() : string
    {

        return (string)$this->text;

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
        $this->Main = null;

    }

}
