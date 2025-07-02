<?php

/** Defino o local da classe */
namespace vendor\controller\trails;

/** Importação de classes */
use \vendor\controller\main\Main;

class TrailsValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();
    private $info = null;

    private $trail_id = null;
    private $user_id = null;
    private $text = null;
    private $date_register = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();
    }

    public function setTrailId(int $trail_id): void
    {

        $this->trail_id = isset($trail_id) ? $this->main->antiInjection($trail_id) : null;
    }

    public function setUserId(int $user_id): void
    {

        $this->user_id = isset($user_id) ? $this->main->antiInjection($user_id) : null;
    }

    public function setText(string $text): void
    {

        $this->text = isset($text) ? $this->main->antiInjection($text, 'S') : null;
    }

    public function setDateRegister(string $date_register): void
    {

        $this->date_register = isset($date_register) ? $this->main->antiInjection($date_register) : null;
    }

    public function getTrailId(): int
    {

        return $this->trail_id;
    }

    public function getUserId(): int
    {

        return $this->user_id;
    }

    public function getText(): string
    {

        return $this->text;
    }

    public function getDateRegister(): string
    {

        return $this->date_register;
    }

    public function getErrors()
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
