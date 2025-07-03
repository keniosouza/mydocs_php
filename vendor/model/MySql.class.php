<?php

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

use PDO;

class MySql
{
    
    /** Declaro as variaveis que irei utilizar na classe **/
    public static $pdo;

    /** Método para conectar ao banco de dados **/
    public static function connect()
    {
        /**
         * Instânciamento de classe
         * Pelo fato de estarem no mesmo lugar ambas as classes, não é necessário informar o 'use'
         */
        $host = new Host();

        if (!isset(self::$pdo)) {

            /** Inicio a conexão com o banco de dados **/
            self::$pdo = new PDO('mysql://mysql:sun147oi@api_mysql:3306/mydocs');

            /** Habilito a listagem de erros ao executar o sql **/
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }

        /** Retorno minha conexão **/
        return self::$pdo;

    }

}
