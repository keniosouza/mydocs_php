<?php

/** Defino o local da classe */
namespace vendor\controller\email;

/** Importação de classes */
use \vendor\controller\main\Main;

class EmailValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();
    private $info = null;

    private $text = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setText(string $text): void
    {

        /** Tratamento dos dados de entrada */
        $this->text = isset($text) ? $this->main->antiInjection($text, 'S') : null;

        /** Verificação dos dados de entrada */
        if (empty($this->text)) {

            /** Adição de elemento */
            array_push($this->errors, 'O campo "Texto", deve ser válido');

        }

    }

    public function getText(): string
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
        $this->main = null;

    }

}
