<?php

/** Defino o local da classe */
namespace vendor\controller\Products;

/** Importação de classes */
use \vendor\controller\main\Main;

class ProductsValidate
{

    /** Variaveis da classe */
    private $main = null;
    private $errors = array();
    private $info = null;

    private $product_id = null;
    private $user_id = null;
    private $situation_id = null;
    private $name = null;
    private $description = null;
    private $date_register = null;
    private $date_update = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setProductId($product_id)
    {

        $this->product_id = isset($product_id) ? $this->main->antiInjection($product_id) : null;

    }

    public function setUserId($user_id)
    {

        $this->user_id = isset($user_id) ? $this->main->antiInjection($user_id) : null;

    }

    public function setSituationId($situation_id)
    {

        $this->situation_id = isset($situation_id) ? $this->main->antiInjection($situation_id) : null;

    }

    public function setName($name)
    {

        $this->name = isset($name) ? $this->main->antiInjection($name) : null;

    }

    public function setDescription($description)
    {

        $this->description = isset($description) ? $this->main->antiInjection($description) : null;

    }

    public function setDateRegister($date_register)
    {

        $this->date_register = isset($date_register) ? $this->main->antiInjection($date_register) : null;

    }

    public function setDateUpdate($date_update)
    {

        $this->date_update = isset($date_update) ? $this->main->antiInjection($date_update) : null;

    }

    public function getProductId()
    {

        return $this->product_id;

    }

    public function getUserId()
    {

        return $this->user_id;

    }

    public function getSituationId()
    {

        return $this->situation_id;

    }

    public function getName()
    {

        return $this->name;

    }

    public function getDescription()
    {

        return $this->description;

    }

    public function getDateRegister()
    {

        return $this->date_register;

    }

    public function getDateUpdate()
    {

        return $this->date_update;

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
