<?php

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class Main
{

    private $string = null;
    private $long = null;
    private $data = null;
    private $elements = null;
    private $usuario_publico_id = null;

    private $path = null;
    private $file = null;

    /** Finalizo a sessão */
    public function SessionStart()
    {

        session_start();

    }

    /** Finalizo a sessão */
    public function SessionDestroy()
    {

        session_destroy();

    }

    /** Função para carregar as informações */
    public function LoadConfig()
    {

        /** Carrego o arquivo de configuração */
        return (object)json_decode(file_get_contents('config.json'));

    }

    /** Verifico se o usuário esta logado */
    public function checkSession()
    {

        /** Salvo minha variavel **/
        $this->usuario_publico_id = @(string)$_SESSION['USER_ID'];

        /** Retorno verdadeiro ou falso **/
        if (!empty(trim($this->usuario_publico_id))) {

            return true;

        } else {

            return false;

        }

    }

    /** Tratamento de Strings */
    public function antiInjection($string, string $long = '')
    {

        /** Parâmetros de entrada */
        $this->string = $string;
        $this->long = $long;

        /** Verifico o tipo de entrada */
        if (is_array($this->string)) {

            /** Retorno o texto sem formatação */
            return $this->string;

        } elseif (strcmp($this->long, 'S') === 0) {

            /** Retorno a string sem tratamento */
            return utf8_decode($this->string);

        } else {

            /** Remoção de espaçamentos */
            $this->string = trim($this->string);

            /** Remoção de tags PHP e HTML */
            $this->string = strip_tags($this->string);

            /** Adição de barras invertidas */
            $this->string = addslashes($this->string);

            /** Evita ataque XSS */
            $this->string = htmlspecialchars($this->string);

            /** Elementos do SQL Injection */
            $elements = array(
                'drop',
                'select',
                'delete',
                'update',
                'insert',
                'alert',
                'destroy',
                '*',
                'database',
                'drop',
                'union',
                'TABLE_NAME',
                '1=1',
                'or 1',
                'exec',
                'INFORMATION_SCHEMA',
                'like',
                'COLUMNS',
                'into',
                'VALUES',
                'from',
                'undefined'
            );

            /** Transformo as palavras em array */
            $palavras = explode(' ', str_replace(',', '', $this->string));

            /** Percorro todas as palavras localizadas */
            foreach ($palavras as $keyPalavra => $palavra) {

                /** Percorro todos os elementos do SQL Injection */
                foreach ($elements as $keyElement => $element) {

                    /** Verifico se a palavra esta na lista negra */
                    if (strcmp(strtolower($palavra), strtolower($element)) === 0) {

                        /** Realizo a troca da marcação pela palavra qualificada */
                        $this->string = str_replace($palavra, '', $this->string);

                    }

                }

            }

            /** Retorno o texto tratado */
            return utf8_decode($this->string);

        }

    }

    /** Função para gerar arquivos em disco */
    public function generateFile(string $path, string $file, array $data): bool
    {

        /** Parâmetros de entrada */
        $this->path = $path;
        $this->file = $file;
        $this->data = $data;

        /** Verifico se o diretório existe */
        if (!is_dir($this->path)) {

            /** Crio o diretório */
            mkdir($this->path, 0755, true);

        }

        /** Crio o Arquivo Para Escrita */
        $path = fopen($this->path . $this->file, 'w+');

        /** Escrevo Dentro do Arquivo */
        fwrite($path, json_encode($this->data, JSON_PRETTY_PRINT));

        /** Encerro a Escrita do Arquivo */
        fclose($path);

        /** Verifico se o arquivo foi criado */
        if (file_exists($this->path . $this->file)) {

            return true;

        } else {

            return false;

        }

    }

    /**Cria mascara para CPF/CNPJ */
    function createMask($val, $mask) {

        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
            

    /** Removedor de mascaras */
    public function removeMask($string)
    {

        /** Elementos para serem removidos da String */
        $this->elements = ['(', ')', '.',',', '-', '/'];

        /** Parâmetros de entrada */
        $this->string = $string;

        /** Remoção dos elementos */
        $this->string = str_replace($this->elements, '', $this->string);

        return $this->string;

    }

    public function CentimeterToPoint($centimeter)
    {

        return $centimeter * 28.34645669;

    }


    public function removeAcento($string)
    {

        /** Parâmetros de entrada */
        $this->string = $string;

        $caracteres_sem_acento = array(
            'Š' => 'S',
            'š' => 's',
            'Ð' => 'Dj',
            '' => 'Z',
            '' => 'z',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ń' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ń' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'ƒ' => 'f',
            'ă' => 'a',
            'î' => 'i',
            'â' => 'a',
            'ș' => 's',
            'ț' => 't',
            'Ă' => 'A',
            'Î' => 'I',
            'Â' => 'A',
            'Ș' => 'S',
            'Ț' => 'T',
        );

        $this->string = preg_replace("/[^a-zA-Z0-9-_]/", "", strtr($this->string, $caracteres_sem_acento));

        return $this->string;

    }

    function extensiveNumber($valor, $maiusculas = false, $moeda = false, $np = false)
    {

        // verifica se tem virgula decimal
        if (strpos($valor, ",") > 0) {
            // retira o ponto de milhar, se tiver
            $valor = str_replace(".", "", $valor);

            // troca a virgula decimal por ponto decimal
            $valor = str_replace(",", ".", $valor);
        }

        if (!$moeda) {
            $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("", "", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
        } else {
            $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
        }

        $c = array(
            "",
            "cem",
            "duzentos",
            "trezentos",
            "quatrocentos",
            "quinhentos",
            "seiscentos",
            "setecentos",
            "oitocentos",
            "novecentos"
        );
        $d = array(
            "",
            "dez",
            "vinte",
            "trinta",
            "quarenta",
            "cinquenta",
            "sessenta",
            "setenta",
            "oitenta",
            "noventa"
        );
        $d10 = array(
            "dez",
            "onze",
            "doze",
            "treze",
            "quatorze",
            "quinze",
            "dezesseis",
            "dezesete",
            "dezoito",
            "dezenove"
        );

        if (!$moeda) // se for usado apenas para numerais
        {
            if ($np) {
                $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
            } else {
                $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
            }
        } else {
            $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
        }
        $z = 0;

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for ($i = 0; $i < count($inteiro); $i++) {
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++) {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }
        $rt = null;
        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                    $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000") {
                $z++;
            } elseif ($z > 0) {
                $z--;
            }
            if (($t == 1) && ($z > 0) && ($inteiro[0] > 0)) {
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            }
            if ($r) {
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                        ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
            }
        }

        if (!$maiusculas) {
            return ($rt ? $rt : "zero");
        } else {
            return (ucwords($rt) ? ucwords($rt) : "Zero");
        }

    }
}