<?php

/** Ativo a exibição de erros */
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/autoload_.php');
require_once('./vendor/model/wideImage/WideImage.php');
require_once('./vendor/model/dompdf/autoload.php');
require_once('./vendor/model/phpmailer/autoload.php');

/** Importação de classes */
use \vendor\controller\main\Main;
use \vendor\controller\routers\RouterValidate;
use \vendor\controller\routers\RouterMinifier;

$Main = null;
$resultConfig = null;

try {

    /** Instânciamento de classes */
    $Main = new Main();
    $RouterValidate = new RouterValidate();
    $RouterMinifier = new RouterMinifier();

    /** Parâmetros de Entrada */
    $RouterValidate->setTable(@(string)filter_input(INPUT_POST, 'TABLE', FILTER_SANITIZE_SPECIAL_CHARS));
    $RouterValidate->setAction(@(string)filter_input(INPUT_POST, 'ACTION', FILTER_SANITIZE_SPECIAL_CHARS));
    $RouterValidate->setFolder(@(string)filter_input(INPUT_POST, 'FOLDER', FILTER_SANITIZE_SPECIAL_CHARS));

    /** Informo a aplicação para carregar as configurações correspondentes */
    $resultConfig = $Main->LoadConfig();

    /** Inicializa a sessão atual */
    $Main->SessionStart();

    /** Constroles */
    $authenticate    = null;
    $resultException = null;
    $resultValidate  = null;
    $resultRequest   = null;

    /** Verifico se o usuário esta autenticado */
    if (@(int)$_SESSION['USER_ID'] > 0) {

        /** Guardos os dados */
        $text = $_REQUEST;

        /** Executo os dados de entrada */
        include './vendor/action/trails/trails_save.php';
        
    }

    /** Verifico a existência de erros */
    if (!empty($RouterValidate->getErrors())) {

        /** Mensagem de erro */
        throw new Exception($RouterValidate->getErrors());

    } else {

        /** Verifico se o arquivo de ação existe */
        if (is_file($RouterValidate->getFullPath())) {

            /** Inicio a coleta de dados */
            ob_start();

            /** Inclusão do arquivo desejado */
            @include_once $RouterValidate->getFullPath();

            /** Prego a estrutura do arquivo */
            $data = ob_get_contents();

            /** Removo o arquivo incluido */
            ob_end_clean();

            /** Result **/
            $result = array(

                'code' => 100,
                'data' => $RouterMinifier->execute($data)

            );

        } else {

            /** Mensagem de erro */
            throw new Exception('Erro :: Não há arquivo para ação informada.');

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

} catch (Exception $exception) {

    /** Verifico se o usuário esta autenticado */
    if (@(int)$_SESSION['USER_ID'] > 0) {

        /** Escrevo a mensagem de requisição */
        $_POST['exception'] = $exception->getFile() . '; Linha: ' . $exception->getLine() . '; Código: ' . $exception->getCode() . '; Mensagem: ' . $exception->getMessage();

        /** Guardos os dados */
        $text = $_POST;

        /** Executo os dados de entrada */
        include './vendor/action/trails/trails_save.php';

    }

    /** Verifico o ambiente que a aplicação esta */
    if ($resultConfig->application->main->environment == 'development') {

        /** Tratamento da mensagem de erro */
        $resultException = '<strong>Arquivo:</strong> ' . $exception->getFile() . '; <strong>Linha:</strong> ' . $exception->getLine() . '; <strong>Código:</strong> ' . $exception->getCode();

    }

    /** Caso existam validações a serem apresentadas, informo */
    $resultValidate = $Main->generateAlertHtml('warning', 'Atenção', ($exception->getMessage() !== null ? $exception->getMessage() : null));

    /** Verifico o ambiente que a aplicação esta */
    if ($resultConfig->application->main->environment == 'development') {

        /** Obtenho a lista de objetos enviados pela rede */
        $resultRequest = $Main->generateAlertHtml('danger', 'Dados Enviados', $Main->generateList($_POST));
        
    }

    /** Removo o arquivo incluido */
    ob_end_clean();

    /** Preparo o formulario para retorno **/
    $result = [

        'code' => 0,
        'title' => 'Atenção',
        'data' => $resultException . $resultValidate . $resultRequest,
        'size' => 'lg',
        'color_modal' => null,
        'color_border' => 'warning',
        'type' => 'alert',
        'procedure' => null,
        'time' => null,
        'authenticate' => $authenticate

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
    
} catch (Error $error) {

    /** Verifico se o usuário esta autenticado */
    if (@(int)$_SESSION['USER_ID'] > 0) {

        /** Escrevo a mensagem de requisição */
        $_POST['error'] = $error->getFile() . '; Linha: ' . $error->getLine() . '; Código: ' . $error->getCode() . '; Mensagem: ' . $error->getMessage();

        /** Guardos os dados */
        $text = $_POST;

        /** Executo os dados de entrada */
        include './vendor/action/trails/trails_save.php';

    }

    /** Verifico o ambiente que a aplicação esta */
    if ($resultConfig->application->main->environment == 'development') {

        /** Tratamento da mensagem de erro */
        $resultException = '<strong>Arquivo:</strong> ' . $error->getFile() . '; <strong>Linha:</strong> ' . $error->getLine() . '; <strong>Código:</strong> ' . $error->getCode();

    }

    /** Caso existam validações a serem apresentadas, informo */
    $resultValidate = $Main->generateAlertHtml('danger', 'Atenção', ($error->getMessage() !== null ? $error->getMessage() : ''));

    /** Verifico o ambiente que a aplicação esta */
    if ($resultConfig->application->main->environment == 'development') {

        /** Obtenho a lista de objetos enviados pela rede */
        $resultRequest = $Main->generateAlertHtml('danger', 'Dados Enviados', $Main->generateList($_POST));
        
    }

    /** Removo o arquivo incluido */
    ob_end_clean();

    /** Preparo o formulario para retorno **/
    $result = [

        'code' => 0,
        'title' => 'Atenção',
        'data' => $resultException . $resultValidate . $resultRequest,
        'size' => 'lg',
        'color_modal' => null,
        'color_border' => 'danger',
        'type' => 'error',
        'procedure' => null,
        'time' => null,
        'authenticate' => $authenticate

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
