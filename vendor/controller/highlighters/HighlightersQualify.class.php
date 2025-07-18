<?php

/** Defino o local da classe */
namespace vendor\controller\highlighters;

/** Importação de classes */
use \vendor\model\Geral;
use \vendor\model\Highlighters;
use \vendor\controller\main\Main;

class HighlightersQualify
{

    /** Variaveis da classe */
    private $Geral = null;
    private $Main = null;
    private $Highlighters = null;

    private $string = null;
    private $stringHighlighters = array();
    private $data = null;

    private $primaryKeyValue = null;
    private $table = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Geral = new Geral();
        $this->Main = new Main();
        $this->Highlighters = new Highlighters();
    }

    /** Extraio as marcações do texto */
    private function getHighlighters(string $string): array
    {

        /** Parâmetros de entrada */
        $this->string = $string;

        /** Busco as marcações para substituição */
        preg_match_all("#\[[\w\s']+\]#i", $this->string, $palavras);

        /** Busco todas as marcações informadas */
        foreach ((array)$palavras[0] as $key => $result) {

            /** Busco a marcação localizada no texto */
            $highlighterResult = $this->Highlighters->GetByName($result);

            /** Verifico qual grupo devo guardar a marcação */
            if($highlighterResult > 0 )
            {

                /** Guardos as maracações por grupo */
                $this->stringHighlighters[$highlighterResult->group][$key] = $highlighterResult;

            }
            else
            {

                /** Guardos as maracações por grupo */
                $this->stringHighlighters['fixed'][$key] = $result;

            }

        }

        /** Retorno a sequencia */
        return (array)$this->stringHighlighters;
    }

    /** Qualificação de texto */
    public function Qualify(string $string, int $primaryKeyValue, string $table): string
    {

        /** Parâmetros de entrada */
        $this->string = $string;
        $this->primaryKeyValue = $primaryKeyValue;
        $this->table = $table;

        /** Percorro todas as palavras localizadas */
        foreach ($this->getHighlighters($this->string) as $keyHighlighter => $resultHighlighter) {

            /** Qualifico as marcações por grupo */
            foreach ($resultHighlighter as $key => $highlighter) {

                /** Verifico se é um objeto para dar continuidade */
                if (!is_object($highlighter)) {
                    continue;
                }

                /** Decodifico a estrutra do texto */
                if (is_string($highlighter->text)) {
                    $highlighter->text = (object)json_decode($highlighter->text);
                }

                /** Decodifico a estrutra das preferências */
                if (is_string($highlighter->preferences)) {
                    $highlighter->preferences = (object)json_decode($highlighter->preferences);
                }

                /** Verifico se a marcação foi localizada */
                if (@(int)$highlighter->highlighter_id > 0 && $highlighter->text->table === $this->table) {

                    /** Busco a marcação */
                    $result = @(string)$this->Geral->Get($highlighter->text->table, $highlighter->text->primary_key, $highlighter->text->column, $this->primaryKeyValue);

                    /** Formato o texto */
                    $result = $this->QualifyPreferences($result, $highlighter->preferences);

                    /** Preenchimento da marcação */
                    $this->string = str_replace($highlighter->name, $result, $this->string);
                }
            }
        }

        /** Retorno da informação */
        return (string)$this->string;
    }

    /** Qualificação de texto */
    private function QualifyPreferences(string $string, object $preferences): string
    {

        /** Realizo a qualificação de texto */
        foreach ($preferences->text as $keyResult => $result) {

            /** Verifico se devo realizar a qualificação */
            if (!empty($result)) {

                /** Substituição da inofmração */
                $string = str_replace('#', $string, $result);
            }
        }

        /** Realizo Qualificação de Máscaras */
        foreach ($preferences->mask as $keyResult => $result) {

            /** Verifico se devo realizar a qualificação */
            if (!empty($result)) {

                /** Removo máscaras existentes */
                $string = $this->Main->removeMask($string);

                /** Crio a máscara desejada */
                $string = $this->Main->CreateMask($string, $result);
            }
        }

        /** Retorno da informação */
        return (string)$string;
    }

    public function QualifyFixed(string $string, array $data): string
    {
        
        /** Parâmetros de entrada */
        $this->string = $string;
        $this->data = $data;

        /** Percorro todas as palavras localizadas */
        foreach ($this->getHighlighters($this->string)['fixed'] as $keyWord => $word) {

             /** Verifico a palavra */
             switch ($word) {

                case '[SISTEMAS_EMPRESA]':

                    $resultFormatted = null;

                    foreach ($this->data as $KeyData => $result) {

                        if (count($this->data) - 1 > $KeyData) {

                            /** Busco a marcação */
                            $resultFormatted = $result->name . ', ' . $resultFormatted;
                        } else {

                            /** Busco a marcação */
                            $resultFormatted = substr($resultFormatted, 0, -2);
                        }
                    }

                    /** Preenchimento da marcação */
                    $this->string = str_replace($word, $resultFormatted, $this->string);

                    break;


                case '[DIA_ATUAL]':

                    /** Busco a marcação */
                    $result = date("d");

                    /** Preenchimento da marcação */
                    $this->string = str_replace($word, $result, $this->string);

                    break;

                case '[MES_ATUAL]':

                    /** Busco a marcação */
                    $result = date("m");

                    /** Preenchimento da marcação */
                    $this->string = str_replace($word, $result, $this->string);

                    break;

                case '[ANO_ATUAL]':

                    /** Busco a marcação */
                    $result = date("Y");

                    /** Preenchimento da marcação */
                    $this->string = str_replace($word, $result, $this->string);

                    break;

                case '[DIA_ATUAL_EXTENSO]':

                    

                    /** Busco a marcação */
                    $result = strtoupper($this->Main->extensiveNumber($valor = date("d")));

                    /** Preenchimento da marcação */
                    $this->string = str_replace($word, $result, $this->string);

                    break;

                case '[MES_ATUAL_EXTENSO]':
                    
                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');

                    /** Busco a marcação */
                    $result = strtolower(strftime(" %B "));

                    /** Preenchimento da marcação */
                    $this->string = str_replace($word, $result, $this->string);

                    break;

                case '[ANO_ATUAL_EXTENSO]':

                    /** Busco a marcação */
                    $result = strtoupper($this->Main->extensiveNumber($valor = date("Y")));

                    /** Preenchimento da marcação */
                    $this->string = str_replace($word, $result, $this->string);

                    break;
            }

        }

        /** Retorno da informação */
        return (string)$this->string;
    }
}
