<?php

/** Importação de classes */
use vendor\controller\main\Main;
use vendor\controller\email\Email;
use vendor\controller\email\EmailValidate;
use vendor\model\Configurations;
use vendor\model\UsersFiles;
use vendor\controller\users_files\UsersFilesValidate;

try
{

    /** Controle de mensagens */
    $message = Array();

    /** Instânciamento de classes */
    $Main = new Main();
    $Email = new Email();
    $EmailValidate = new EmailValidate();
    $Configurations = new Configurations();
    $UsersFiles = new UsersFiles();
    $UsersFilesValidate = new UsersFilesValidate();

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada - drafts_companies */
    $UsersFilesValidate->setUserFileId(@(int)filter_input(INPUT_POST, 'user_file_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $EmailValidate->setText(@(string)$_POST['text']);

    /** Verifico a existência de erros */
    if (count($UsersFilesValidate->getErrors()) > 0 || count($EmailValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $UsersFilesValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco a configuração */
        $resultConfiguration = $Configurations->All();

        /** Decodifico as preferencias */
        $resultConfiguration->preferences = (object)json_decode($resultConfiguration->preferences);

        /** Busco o Registro para ser impresso*/
        $resultUsersFiles = $UsersFiles->Get($UsersFilesValidate->getUserFileId());

        /** Verifico se o registro existe */
        if (@(int)$resultUsersFiles->user_file_id > 0)
        {

            /** Gero o nome do arquivo */
            $fileName = 'document/' . $resultUsersFiles->name . '.pdf';

            /** Inicio a coleta de dados */
            ob_start();

            /** Inclusão do arquivo desejado */
            require 'vendor/view/email/email_document.php';

            /** Prego a estrutura do arquivo */
            $html = ob_get_contents();

            /** Removo o arquivo incluido */
            ob_end_clean();

            /** Verifico se o envio foi bem sucedido */
            $Email->send($html, $resultUsersFiles, utf8_encode($resultUsersFiles->name), $resultConfiguration->preferences->email, $fileName, $_SESSION['USER_NAME']);

            /** Defino o histórico */
            $historyData[0]['title'] = 'Email';
            $historyData[0]['description'] = 'Documento enviado por email no dia';
            $historyData[0]['date'] = date('d-m-Y');
            $historyData[0]['time'] = date('H:i:s');
            $historyData[0]['class'] = 'badge-danger';
            $historyData[0]['user'] = $_SESSION['USER_NAME'];

            /** Verifico se já existe históric */
            if (!empty($resultUsersFiles->history))
            {

                /** Pego o histórico existente */
                $history = json_decode($resultUsersFiles->history, TRUE);

                /** Unifico os históricos */
                $historyData = array_merge($history, $historyData);

            }

            /** Converto para JSON */
            $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

            /** Salvo o histórico de acesso */
            if ($UsersFiles->SaveHistory($resultUsersFiles->user_file_id, $historyData))
            {

                /** Adição de elementos na array */
                array_push($message, array('sucesso', 'Email enviado com sucesso'));

                /** Result **/
                $result = [

                    'cod' => 0,
                    'title' => 'Sucesso',
                    'message' => $message,
                    'redirect' => 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=' . $resultUsersFiles->user_id

                ];

            }
            else
            {

                /** Adição de elementos na array */
                array_push($message, array('erro', 'Não foi possivel salvar o histórico'));

                /** Preparo o formulario para retorno **/
                $result = [

                    'cod' => 1,
                    'title' => 'Atenção',
                    'message' => $message,

                ];

            }

        }
        else
        {

            /** Adição de elementos na array */
            array_push($message, array('erro', 'Não foi possivel localizar a empresa'));

            /** Preparo o formulario para retorno **/
            $result = [

                'cod' => 1,
                'title' => 'Atenção',
                'message' => $message,

            ];

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
catch (Exception $exception)
{

    /** Controle de mensagens */
    $message = array();

    /** Adição de elementos na array */
    array_push($message, array('erro', '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile()));
    array_push($message, array('erro', '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage()));

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 1,
        'message' => $message,
        'title' => 'Erro Interno',
        'type' => 'exception',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}