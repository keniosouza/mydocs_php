<?php

/** Defino o local da classes */
namespace vendor\controller\configurations;

/** Importação de classes */
use vendor\controller\main\Main;

class ConfigurationsEmailPreferencesValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();

    private $host = null;
    private $username = null;
    private $port = null;
    private $password = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setHost(string $host)
    {

        $this->host = isset($host) ? $this->Main->antiInjection($host) : null;

        if (empty($this->host)) {

            array_push($this->errors, array('host', 'O campo "Host", deve ser preenchido'));

        }

    }

    public function setUsername(string $username)
    {

        $this->username = isset($username) ? $this->Main->antiInjection($username) : null;

        if (empty($this->username)) {

            array_push($this->errors, array('username', 'O campo "Usuário", deve ser preenchido'));

        }

    }

    public function setPort(string $port)
    {

        $this->port = isset($port) ? $this->Main->antiInjection($port) : null;

        if (empty($this->port)) {

            array_push($this->errors, array('port', 'O campo "Porta", deve ser preenchido'));

        }

    }

    public function setPassword(string $password)
    {

        $this->password = isset($password) ? $this->Main->antiInjection($password) : null;

        if (empty($this->password)) {

            array_push($this->errors, array('password', 'O campo "Senha", deve ser preenchido'));

        }

    }

    public function getHost(): string
    {

        return (string)$this->host;

    }

    public function getUsername(): string
    {

        return (string)$this->username;

    }

    public function getPort(): string
    {

        return (string)$this->port;

    }

    public function getPassword(): string
    {

        return (string)$this->password;

    }

    public function getErrors()
    {

        return $this->errors;

    }

}