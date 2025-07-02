<?php

/** Defino o local da classes */
namespace vendor\controller\configurations;

/** Importação de classes */
use vendor\controller\main\Main;

class ConfigurationsPrintPreferencesValidate
{

    /** Parâmetros da classes */
    private $Main = null;
    private $errors = array();
    private $info = null;

    private $pageOrientation = null;
    private $pageHeight = null;
    private $pageWidth = null;

    private $pageBodyMarginLeft = null;
    private $pageBodyMarginRight = null;
    private $pageBodyMarginTop = null;
    private $pageBodyMarginBottom = null;

    private $pageHeaderMarginLeft = null;
    private $pageHeaderMarginRight = null;
    private $pageHeaderMarginTop = null;
    private $pageHeaderMarginBottom = null;
    private $pageHeaderContent = null;

    private $pageFooterMarginLeft = null;
    private $pageFooterMarginRight = null;
    private $pageFooterMarginTop = null;
    private $pageFooterMarginBottom = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Main = new Main();

    }

    public function setPageOrientation(string $pageOrientation)
    {

        $this->pageOrientation = isset($pageOrientation) ? $this->Main->antiInjection($pageOrientation) : null;

        if (empty($this->pageOrientation))
        {

            array_push($this->errors,'O campo "Orientação", deve ser preenchido');

        }

    }

    public function setPageHeight(string $pageHeight)
    {

        $this->pageHeight = isset($pageHeight) ? $this->Main->antiInjection($pageHeight) : null;

        if (empty($this->pageHeight))
        {

            array_push($this->errors,'O campo "Altura", deve ser preenchido');

        }

    }

    public function setPageWidth(string $pageWidth)
    {

        $this->pageWidth = isset($pageWidth) ? $this->Main->antiInjection($pageWidth) : null;

        if (empty($this->pageWidth))
        {

            array_push($this->errors, 'O campo "Largura", deve ser preenchido');

        }

    }

    public function setPageBodyMarginLeft(string $pageBodyMarginLeft)
    {

        $this->pageBodyMarginLeft = isset($pageBodyMarginLeft) ? $this->Main->antiInjection($pageBodyMarginLeft) : null;

        if (empty($this->pageBodyMarginLeft))
        {

            array_push($this->errors, 'O campo "Margem Esquerda", deve ser preenchido');

        }

    }

    public function setPageBodyMarginRight(string $pageBodyMarginRight)
    {

        $this->pageBodyMarginRight = isset($pageBodyMarginRight) ? $this->Main->antiInjection($pageBodyMarginRight) : null;

        if (empty($this->pageBodyMarginRight))
        {

            array_push($this->errors, 'O campo "Margem Direita", deve ser preenchido');

        }

    }

    public function setPageBodyMarginTop(string $pageBodyMarginTop)
    {

        $this->pageBodyMarginTop = isset($pageBodyMarginTop) ? $this->Main->antiInjection($pageBodyMarginTop) : null;

        if (empty($this->pageBodyMarginTop))
        {

            array_push($this->errors,  'O campo "Margem Superior", deve ser preenchido');

        }

    }

    public function setPageBodyMarginBottom(string $pageBodyMarginBottom)
    {

        $this->pageBodyMarginBottom = isset($pageBodyMarginBottom) ? $this->Main->antiInjection($pageBodyMarginBottom) : null;

        if (empty($this->pageBodyMarginBottom))
        {

            array_push($this->errors, 'O campo "Margem Inferior", deve ser preenchido');

        }

    }

    public function setPageHeaderMarginLeft(string $pageHeaderMarginLeft)
    {

        $this->pageHeaderMarginLeft = isset($pageHeaderMarginLeft) ? $this->Main->antiInjection($pageHeaderMarginLeft) : null;

        if (empty($this->pageHeaderMarginLeft))
        {

            array_push($this->errors, 'O campo "Margem Esquerda", deve ser preenchido');

        }

    }

    public function setPageHeaderMarginRight(string $pageHeaderMarginRight)
    {

        $this->pageHeaderMarginRight = isset($pageHeaderMarginRight) ? $this->Main->antiInjection($pageHeaderMarginRight) : null;

        if (empty($this->pageHeaderMarginRight))
        {

            array_push($this->errors, 'O campo "Margem Direita", deve ser preenchido');

        }

    }

    public function setPageHeaderMarginTop(string $pageHeaderMarginTop)
    {

        $this->pageHeaderMarginTop = isset($pageHeaderMarginTop) ? $this->Main->antiInjection($pageHeaderMarginTop) : null;

        if (empty($this->pageHeaderMarginTop))
        {

            array_push($this->errors, 'O campo "Margem Superior", deve ser preenchido');

        }

    }

    public function setPageHeaderMarginBottom(string $pageHeaderMarginBottom)
    {

        $this->pageHeaderMarginBottom = isset($pageHeaderMarginBottom) ? $this->Main->antiInjection($pageHeaderMarginBottom) : null;

        if (empty($this->pageHeaderMarginBottom))
        {

            array_push($this->errors, 'O campo "Margem Inferior", deve ser preenchido');

        }

    }

    public function setPageHeaderContent(string $pageHeaderContent)
    {

        $this->pageHeaderContent = isset($pageHeaderContent) ? $this->Main->antiInjection($pageHeaderContent, 'S') : null;

        if (empty($this->pageHeaderContent))
        {

            array_push($this->errors,'O campo "Conteúdo", deve ser preenchido');

        }

    }

    public function setPageFooterMarginLeft(string $pageFooterMarginLeft)
    {

        $this->pageFooterMarginLeft = isset($pageFooterMarginLeft) ? $this->Main->antiInjection($pageFooterMarginLeft) : null;

        if (empty($this->pageFooterMarginLeft))
        {

            array_push($this->errors, 'O campo "Margem Esquerda", deve ser preenchido');

        }

    }

    public function setPageFooterMarginRight(string $pageFooterMarginRight)
    {

        $this->pageFooterMarginRight = isset($pageFooterMarginRight) ? $this->Main->antiInjection($pageFooterMarginRight) : null;

        if (empty($this->pageFooterMarginRight))
        {

            array_push($this->errors, 'O campo "Margem Direita", deve ser preenchido');

        }

    }

    public function setPageFooterMarginTop(string $pageFooterMarginTop)
    {

        $this->pageFooterMarginTop = isset($pageFooterMarginTop) ? $this->Main->antiInjection($pageFooterMarginTop) : null;

        if (empty($this->pageFooterMarginTop))
        {

            array_push($this->errors, 'O campo "Margem Superior", deve ser preenchido');

        }

    }

    public function setPageFooterMarginBottom(string $pageFooterMarginBottom)
    {

        $this->pageFooterMarginBottom = isset($pageFooterMarginBottom) ? $this->Main->antiInjection($pageFooterMarginBottom) : null;

        if (empty($this->pageFooterMarginBottom))
        {

            array_push($this->errors,'O campo "Margem Inferior", deve ser preenchido');

        }

    }

    public function getPageOrientation() : string
    {

        return (string)$this->pageOrientation;

    }

    public function getPageWidth() : string
    {

        return (string)$this->pageWidth;

    }

    public function getPageHeight() : string
    {

        return (string)$this->pageHeight;

    }

    public function getPageBodyMarginLeft() : string
    {

        return (string)$this->pageBodyMarginLeft;

    }

    public function getPageBodyMarginRight() : string
    {

        return (string)$this->pageBodyMarginRight;

    }

    public function getPageBodyMarginTop() : string
    {

        return (string)$this->pageBodyMarginTop;

    }

    public function getPageBodyMarginBottom() : string
    {

        return (string)$this->pageBodyMarginBottom;

    }

    public function getPageHeaderMarginLeft() : string
    {

        return (string)$this->pageHeaderMarginLeft;

    }

    public function getPageHeaderMarginRight() : string
    {

        return (string)$this->pageHeaderMarginRight;

    }

    public function getPageHeaderMarginTop() : string
    {

        return (string)$this->pageHeaderMarginTop;

    }

    public function getPageHeaderMarginBottom() : string
    {

        return (string)$this->pageHeaderMarginBottom;

    }

    public function getPageHeaderContent() : string
    {

        return (string)base64_encode($this->pageHeaderContent);

    }

    public function getPageFooterMarginLeft() : string
    {

        return (string)$this->pageFooterMarginLeft;

    }

    public function getPageFooterMarginRight() : string
    {

        return (string)$this->pageFooterMarginRight;

    }

    public function getPageFooterMarginTop() : string
    {

        return (string)$this->pageFooterMarginTop;

    }

    public function getPageFooterMarginBottom() : string
    {

        return (string)$this->pageFooterMarginBottom;

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

}