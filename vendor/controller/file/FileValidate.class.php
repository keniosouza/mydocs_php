<?php

/** Defino o local da classes */
namespace vendor\controller\file;

/** Importação de classess */
use \vendor\controller\main\Main;

class FileValidate
{

    /** Variáveis da classes */
    private $main = null;
    private $errors = array();

    private $name;
    private $base64;
    private $extension;
    private $path;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->main = new Main();

    }

    public function setName(string $name)
    {

        /** Tratamento dos dados de entrada */
        $this->name = isset($name) ? $this->main->antiInjection($name) : null;

        /** Validação dos dados */
        if (empty($this->name)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Nome", deve ser preenchido');

        }

    }

    public function setBase64(string $base64)
    {

        /** Tratamento dos dados de entrada */
        $this->base64 = isset($base64) ? $this->main->antiInjection(str_replace(' ', '+', $base64)) : null;

        /** Validação dos dados */
        if (empty($this->base64)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "base64", deve ser preenchido');

        }

    }

    public function setExtension(string $extension)
    {

        /** Tratamento dos dados de entrada */
        $this->extension = isset($extension) ? $this->main->antiInjection($extension) : null;

        /** Validação dos dados */
        if (empty($this->extension)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "extensão", deve ser preenchido');

        }

    }

    public function setPath(string $path)
    {

        /** Tratamento dos dados de entrada */
        $this->path = isset($path) ? $this->main->antiInjection($path) : null;

        /** Validação dos dados */
        if (empty($this->path)) {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "caminho", deve ser preenchido');

        }

    }

    public function getName(): string
    {

        return (string)$this->name;

    }

    public function getBase64(): string
    {

        return (string)$this->base64;

    }

    public function getExtension(): string
    {

        return (string)$this->extension;

    }

    public function getPath(): string
    {

        return (string)$this->path;

    }


    public function getFullName(): string
    {

        return (string)$this->name . '.' . (string)$this->extension;

    }

    public function getFullPath(): string
    {

        return (string)$this->path . '/' . (string)$this->name . '.' . (string)$this->extension;

    }

    public function getErrors()
    {

        return $this->errors;

    }

    /** Método destrutor */
    public function __destruct()
    {

        /** Instânciamento de classes */
        $this->main = null;

    }

}
