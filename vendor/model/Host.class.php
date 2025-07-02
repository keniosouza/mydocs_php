<?php

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

/** Importação de classes */
use vendor\controller\main\Main;

class Host
{
    /** Parâmetros da Classe */
    private $Main;
    private $Config;

    /** Contrutor da Classe */
    public function __construct()
    {
        /** Instânciamento de classes */
        $this->Main = new Main();

        /** Operações */
        $this->Config = $this->Main->LoadConfig('main');

    }

    /** Pego a localização do banco de dados **/
    public function getDsn()
    {

        return 'mysql:port=3306;dbname=' . (string)$this->Config->database->name;
        
    }

    /** Pego o usuário de acesso **/
    public function getUser()
    {
        return (string)$this->Config->database->user;
    }

    /** Pego a senha de acesso **/
    public function getPassword()
    {
        return (string)$this->Config->database->password;
    }

    /** Pego o charset de acesso **/
    public function getCharset()
    {
        return (string)$this->Config->database->charset;
    }

    /** Contrutor da Classe */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->Main = null;

    }

}
