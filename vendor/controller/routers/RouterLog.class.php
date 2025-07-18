<?php

/** Defino o local da classes */
namespace vendor\controller\Routers;

/** Imnportação de classes */
use vendor\controller\main\Main;

class RouterLog
{
    /** Parâmetros da classes */
    private $Main = null;
    private $userId = null;
    private $post = null;
    private $data = null;
    private $date = null;
    private $hour = null;
    private $file = null;

    public function __construct()
    {
        $this->data = file_exists('requests.json') ? (array)json_decode(file_get_contents('requests.json', false), true) : array();
    }

    /**
    public function save(int $userId, array $post): void
    {

        /** Parâmetros de entrada */
        $this->userId = $userId;
        $this->post = $post;
        $this->date = (string)date('Y-m-d');
        $this->hour = (string)date('H:i:s');

        /** Obtenho o histórico anterior */
        $this->data = file_exists('requests.json') ? (array)json_decode(file_get_contents('requests.json'), true) : array();

        /** Guardo os dados desejados */
        $this->data[(int)$this->userId][(string)$this->date][(string)$this->hour] = $this->post;

        /** Gero o arquivo desejado */
        $this->Main->writeFile('requests.json', 'w+', json_encode($this->data, JSON_PRETTY_PRINT));

    }

}
