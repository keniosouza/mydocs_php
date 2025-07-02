<?php

/** Defino o local da classes */
namespace vendor\controller\Routers;

class RouterMinifier
{
    /** Parâmetros da classes */
    private $code = null;
    private $search = null;
    private $replace = null;

    public function execute(string $code): string
    {
        /** Parâmetros de entrada */
        $this->code = $code;

        /** Parametros de Busca */
        $this->search = array(

            // Remove whitespaces after tags
            '/\>[^\S ]+/s',

            // Remove whitespaces before tags
            '/[^\S ]+\</s',

            // Remove multiple whitespace sequences
            '/(\s)+/s',

            // Removes comments
            '/<!--(.|\s)*?-->/'
        );

        /** Parâmetros de troca */
        $this->replace = array('>', '<', '\\1');

        /** Realizo a compressão */
        $this->code = preg_replace($this->search, $this->replace, $this->code);

        /** Retorno a string comprimida */
        return $this->code;
    }
}
