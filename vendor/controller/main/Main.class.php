<?php

/**
 * Classe Main.class.php
 * @filesource
 * @autor        Kenio de Souza
 * @copyright    Copyright 2022 - Softwiki Tecnologia
 * @package      controller
 * @subpackage   main
 * @version      1.0
 */

/** Defino o local onde a classe esta localizada **/
namespace vendor\controller\main;

use stdClass;

class Main
{

    /** Parâmetros da classe */
    private $string = null;
    private $long = null;
    private $data = null;
    private $resultConfig = null;
    private $file = null;
    private $elements  = null;
    private $method    = null;
    private $firstKey  = null;        
    private $secondKey = null; 
    private $hash      = null;     
    private $config    = null;

    /** Controle de Alertas */
    private $type;
    private $title;

    private $path = null;

    /** Construtor da classe */
    public function __construct()
    {
        $this->resultConfig = (object)json_decode(file_get_contents("config.json", false));
    }    
    
    /** Inicializo a sessão */
    public function SessionStart()
    {
        @session_start();
    }

    /** Finalizo a sessão */
    public function SessionDestroy()
    {
        @session_destroy();
    }

    /** Verifico se o usuário esta logado */
    public function checkSession()
    {

        /** Retorno verdadeiro ou falso **/
        if (@(int)$_SESSION['USER_ID'] > 0) {

            return true;

        } else {

            return false;

        }

    }

    /** Antiinjection */
    public function antiInjectionArray($ar)
    {
        /** Verifica se a array foi informada */
        if (is_array($ar)) {
            $str = [];
            foreach ($ar as $value) {
                array_push($str, $this->antiInjection($value));
            }
            return $str;
        } else {
            return $ar;
        }
    }

    /** Antiinjection */
    public function antiInjection($string, string $long = "")
    {

        /** Parâmetros de entrada */
        $this->string = $string;
        $this->long = $long;
        /** Verifico o tipo de entrada */
        if (is_array($this->string)) {
            /** Retorno o texto sem formatação */
            $this->antiInjectionArray($this->string);
        } elseif (strcmp($this->long, "S") === 0) {
            /** Retorno a string sem tratamento */
            return $this->string;
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
            $elements = [" drop ", " select ", " delete ", " update ", " insert ", " alert ", " destroy ", " * ", " database ", " drop ", " union ", " TABLE_NAME ", " 1=1 ", " or 1 ", " exec ", " INFORMATION_SCHEMA ", " like ", " COLUMNS ", " into ", " VALUES ", " from ", " undefined ",];
            /** Transformo as palavras em array */
            $palavras = explode(" ", str_replace(",", "", $this->string));
            /** Percorro todas as palavras localizadas */
            foreach ($palavras as $keyPalavra => $palavra) {
                /** Percorro todos os elementos do SQL Injection */
                foreach ($elements as $keyElement => $element) {
                    /** Verifico se a palavra esta na lista negra */
                    if (strcmp(strtolower($palavra), strtolower($element)) === 0) {
                        /** Realizo a troca da marcação pela palavra qualificada */
                        $this->string = str_replace($palavra, "", $this->string);
                    }
                }
            }
            /** Retorno o texto tratado */
            return $this->string;
        }
    }

    /**
     *@author KEVEN
     *@date 23/09/2022 14:34:14
     *@description Obtenho as configurações do arquivo json
     */
    public function LoadConfig(): object
    {
        /** Guardo o resultado */
        $this->resultConfig = (object)json_decode(file_get_contents("config.json"));
        /** Retorno da informação */
        return (object)$this->resultConfig;
    }

    /**
     *@author Keven
     *@date 28/09/2022 12:25:45
     *@description Obtenho uma cor em hexadecimal de forma aleatória
     */
    public function generateHexCode(): string
    {
        /** Retorno da informação */
        return "#" . substr(str_shuffle("ABCDEF0123456789"), 0, 6);
    }
    
    /**
     *@author Keven
     *@date 28/09/2022 12:25:45
     *@description Obtenho o numero e a sua unidade de medida formatada
     */
    public function humanFileSize($size, $precision = 2)
    {
        /** Parâmetros da classe */
        $units = ["B", "kB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];
        $step = 1024;
        $i = 0;
        /** Conversão dos valores */
        while ($size / $step > 0.9) {
            $size = $size / $step;
            $i++;
        }
        /** Retorno de informação */
        return round($size, $precision) . $units[$i];
    }

    /**
     *@author Keven
     *@date 28/09/2022 12:25:45
     *@description Obtenho um alerta html formatado
     */
    public function generateAlertHtml(?string $type, ?string $title, ?string $data): string
    {

        /** Parâmetros de entrada */
        $this->type = (string)$type;
        $this->title = (string)$title;
        $this->data = (string)$data;
        /** estrutura HTML */
        $html = '<div class="alert alert-' . $this->type . ' animate slideIn" role="alert">';
        $html .= '  <h4 class="alert-heading">' . $this->title . "</h4>";
        $html .= "  <p>" . $this->data . "</p>";
        $html .= "</div>";
        /** Retorno de informação */
        return $html;
        
    }

    /**
     *@author Keven
     *@date 28/09/2022 12:25:45
     *@description Obtenho uma lista de informações a partir de uma array fornecida
     */
    public function generateList(?array $data): string
    {
        /** Parâmetros de entrada */
        $this->data = (array)$data;
        /** Início da lista */
        $result = "<ul>";
        /** Listagem dos Itens */
        foreach ($this->data as $keyData => $resultData) {
            /** Verifico se é exceção */
            if ($keyData !== "exception") {
                /** Item da Lista */
                $result .= "<li><b>[" . $keyData . "]</b> = " . $resultData . "</dt>";
            }
        }
        /** Encerro a Lista */
        $result .= "</ul>";
        /** Retorno de informação */
        return $result;
    }

    /**
     *@author Keven
     *@date 28/09/2022 12:25:45
     *@description Obtenho o tamanho total da pasta informada
     *@link https://stackoverflow.com/questions/16208351/folder-size-with-php
     */
    function folderRemove($dir)
    {
        /** Identifico os arquivos e pastas */
        $files = array_diff(scandir($dir), [".", ".."]);
        /** Percorro todos os registros */
        foreach ($files as $file) {
            /** Remoção do arquivo */
            is_dir("$dir/$file") ? $this->folderRemove("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    /**
     *@author Keven
     *@date 10/11/2022 15:17:45
     *@description Retorno mensagem de boas vindas formatada
     */
    function getAmPm(): string
    {
        /** Verifico o horário de execução */
        switch (date("a")) {
                /** Período da manhã */
            case "am":
                /** Defino a frase */
                $this->data = "Bom dia";
                break;
                /** Período da manhã */
            case "pm":
                /** Defino a frase */
                $this->data = "Boa tarde";
                break;
                /** Período da manhã */
            default:
                /** Defino a frase */
                $this->data = "Olá";
                break;
        }
        return $this->data;
    }

    /**
     *@author Keven
     *@date 11/11/2022 15:12:45
     *@description Criação de Arquivos
     */
    function writeFile(string $dir, string $mode, string $data) : bool
    {

        /** Armazena a conexão com o arquivo e o tipo de ação. */
        $this->file = fopen($dir, $mode);

        /** Escrita no arquivo */
        fwrite($this->file, $data);

        /** Encerro o arquivo */
        return fclose($this->file);

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

    function CreateMask($val, $mask) {
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
        $this->elements = ['(', ')', '.', ',', ' ', '-', '/'];

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

    /** Retorna o metodo de criptografia */
    private function getMethod()
    {

        return $this->method;
    }

    /** Retorna a primeira chave de criptografia */
    private function getFirstKey()
    {

        return $this->firstKey;
    } 
    
    //** Retorna a segunda chave de criptografia */
    private function getSecondKey()
    {

        return $this->secondKey;
    }      

    /** Retorna a string descriptografada */
    public function decryptData(string $data) : string
    {

        /** Parametro de entrada */
        $this->data = $data;

        /** Verifica se a string a se descriptografada foi informada */
        if(!empty($this->data)){

            return $this->securedDecrypt($this->getFirstKey(), $this->getMethod(), $this->data);

        }else{

            return $this->data;
        }
        
    }

    /** Retorna a string criptografada */
    public function encryptData(string $data) : string
    {

        /** Parametro de entrada */
        $this->data = $data;

        /** Verifica se a string a se criptografada foi informada */
        if(!empty($this->data)){

            return $this->securedEncrypt($this->getFirstKey(), $this->getSecondKey(), $this->getMethod(), $this->data);

        }else{

            return $this->data;
        }
        
    }
	
    /** Criptografa uma string */
    public function securedEncrypt($first_key, $second_key, $method, $str)
    {
        /** String a ser criptografada */ 
        $data =  $str;
          
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
            
        $first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
                
        $output = base64_encode($iv.$second_encrypted.$first_encrypted);   
        
        return $output;       
    }
    
   /** Descriptografa uma string */ 
    public function securedDecrypt($first_key, $method, $input)
    {
        /** String a ser descriptografada */         
        $mix = base64_decode($input);
             
        $iv_length = openssl_cipher_iv_length($method);
                
        $iv = substr($mix,0,$iv_length);
        $first_encrypted = substr($mix,$iv_length+64);
        
        /** Descriptografa string */
        $output = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
        
        return $output;
    }  
    
    /** Gera um password hash */
    public function passwordHash($password){

        /** Parametros de entradas */
        $this->password = $password;

        /** Verifica se a senha foi informada */
        if($this->password){

            $hash = PASSWORD_DEFAULT;/** Padrão de criptogrfia */
            $cost = array("cost"=>10);/** Nível de criptografia */  

            /** Gera o hash da senha */
            return password_hash($this->password, $hash, $cost);
            
        }

    }	    

    public function __destruct()
    {
        /** Limpo os parâmetros */
        $this->string = null;
        $this->long = null;
        $this->data = null;
        $this->resultConfig = null;
        $this->file = null;
        $this->elements = null;
        $this->type = null;
        $this->title = null;
        $this->path = null;
    }
}
