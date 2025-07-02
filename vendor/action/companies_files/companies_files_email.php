<?php

/** Importação de classes */
use vendor\controller\main\Main;
use vendor\controller\email\Email;
use vendor\controller\email\EmailValidate;
use vendor\model\Configurations;
use vendor\model\CompaniesFiles;
use vendor\controller\companies_file\CompaniesFilesValidate;

try
{

    /** Controle de mensagens */
    $message = Array();

    /** Instânciamento de classes */
    $Main = new Main();
    $Email = new Email();
    $EmailValidate = new EmailValidate();
    $Configurations = new Configurations();
    $CompaniesFiles = new CompaniesFiles();
    $CompaniesFilesValidate = new CompaniesFilesValidate();

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada - drafts_companies */
    $CompaniesFilesValidate->setCompanyFileId(@(int)filter_input(INPUT_POST, 'company_file_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $EmailValidate->setText(@(string)$_POST['text']);

    /** Verifico a existência de erros */
    if (count($CompaniesFilesValidate->getErrors()) > 0 || count($EmailValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $CompaniesFilesValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco a configuração */
        $resultConfiguration = $Configurations->All();

        /** Decodifico as preferencias */
        $resultConfiguration->preferences = (object)json_decode($resultConfiguration->preferences);

        /** Busco o Registro para ser impresso*/
        $resultCompaniesFiles= $CompaniesFiles->Get($CompaniesFilesValidate->getCompanyFileId());

        /** Verifico se o registro existe */
        if (@(int)$resultCompaniesFiles->company_file_id > 0)
        {

            /** Gero o nome do arquivo */
            $fileName = 'document/' . $resultCompaniesFiles->name . '.pdf';

            /** Inicio a coleta de dados */
            ob_start();

            /** Inclusão do arquivo desejado */
            require 'vendor/view/email/email_document.php';

            /** Prego a estrutura do arquivo */
            $html = ob_get_contents();

            /** Removo o arquivo incluido */
            ob_end_clean();

            /** Verifico se o envio foi bem sucedido */
            $Email->send($html, $resultCompaniesFiles, utf8_encode($resultCompaniesFiles->name), $resultConfiguration->preferences->email, $fileName, $_SESSION['USER_NAME']);

            /** Defino o histórico */
            $historyData[0]['title'] = 'Email';
            $historyData[0]['description'] = 'Documento enviado por email no dia';
            $historyData[0]['date'] = date('d-m-Y');
            $historyData[0]['time'] = date('H:i:s');
            $historyData[0]['class'] = 'badge-danger';
            $historyData[0]['user'] = $_SESSION['USER_NAME'];

            /** Verifico se já existe históric */
            if (!empty($resultCompaniesFiles->history))
            {

                /** Pego o histórico existente */
                $history = json_decode($resultCompaniesFiles->history, TRUE);

                /** Unifico os históricos */
                $historyData = array_merge($history, $historyData);

            }

            /** Converto para JSON */
            $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

            /** Salvo o histórico de acesso */
            if ($CompaniesFiles->SaveHistory($resultCompaniesFiles->company_file_id, $historyData))
            {

                /** Adição de elementos na array */
                array_push($message, array('sucesso', 'Email enviado com sucesso'));

                /** Result **/
                $result = [

                    'cod' => 0,
                    'title' => 'Sucesso',
                    'message' => $message,
                    'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=' . $resultCompaniesFiles->company_id

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