<?php

namespace vendor\controller\file;

class File
{

    /** Parâmetros da Classes */
    private $path = null;
    private $name = null;
    private $base64 = null;
    private $document = null;

    /** Crio o arquivo em disco */
    public function Generate(string $path, string $name, string $base64): bool
    {

        /** Parâmetros de entrada */
        $this->path = $path;
        $this->name = $name;
        $this->base64 = $base64;

        /** Verifico se já existe alguma pasta */
        if (is_dir($this->path)) {

            /** Crio meu arquivo e escrevo dentro dele **/
            $this->document = fopen($this->path . '/' . $this->name, 'a+');

            /** Escrevo dentro do arquivo **/
            fwrite($this->document, base64_decode($this->base64));

            /** Encerro a escrita do arquivo **/
            fclose($this->document);

        } else {

            /** Crio o caminho **/
            mkdir($this->path, 0777, true);

            /** Crio meu arquivo e escrevo dentro dele **/
            $this->document = fopen($this->path . '/' . $this->name, 'a+');

            /** Crio meu arquivo e escrevo dentro dele **/
            fwrite($this->document, base64_decode($this->base64));

            /** Encerro a escrita do arquivo **/
            fclose($this->document);

        }

        /** Verifico se o arquivo foi criado */
        if (is_file($this->path . '/' . $this->name)) {

            return true;

        } else {

            return false;

        }

    }

}