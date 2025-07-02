<?php

/** Importação de classes */
use vendor\controller\main\Main;
use vendor\model\Configurations;
use vendor\model\DraftsUsers;
use vendor\controller\drafts_users\DraftsUsersValidate;
use vendor\controller\pdf\PdfGenerate;

try
{

    /** Controle de mensagens */
    $message = Array();
    $PDFGenerate = new PdfGenerate();

    /** Instânciamento de classes */
    $Main = new Main();
    $Configurations = new Configurations();
    $DraftsUsers = new DraftsUsers();
    $DraftsUsersValidate = new DraftsUsersValidate();

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada - drafts_companies */
    $DraftsUsersValidate->setDraftUserId(@(int)filter_input(INPUT_POST, 'draft_user_id', FILTER_SANITIZE_SPECIAL_CHARS));

    /** Verifico a existência de erros */
    if (count($DraftsUsersValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $DraftsUsersValidate->getErrors(),

        ];

    }
    else
    {

        /** Busco a configuração */
        $resultConfiguration = $Configurations->All();

        /** Decodifico as preferencias */
        $resultConfiguration->preferences = (object)json_decode($resultConfiguration->preferences);

        /** Busco o Registro para ser impresso*/
        $resultDraftsUsers = $DraftsUsers->Get($DraftsUsersValidate->getDraftUserId());

        /** Verifico se o registro foi localizado */
        if (@(int)$resultDraftsUsers->draft_user_id > 0)
        {

            /** Gero o nome do arquivo */
            $path = $Main->removeAcento($Main->removeMask(str_replace(' ', '_', strtoupper($resultDraftsUsers->nickname . '_' . $resultDraftsUsers->name)))) . '.pdf';

            /** Inicio a coleta de dados */
            ob_start();

            /** Inclusão do arquivo desejado */
            require 'vendor/view/pdf/pdf_draft_users_print.php';

            /** Prego a estrutura do arquivo */
            $html = ob_get_contents();

            /** Removo o arquivo incluido */
            ob_end_clean();

            /** Verifico se o arquivo foi criado */
            if ($PDFGenerate->generate($html, '/document/', $path, $resultConfiguration->preferences->page))
            {

                /** Captura dos dados de login */
                $historyData[0]['title'] = 'PDF';
                $historyData[0]['description'] = 'PDF gerado no dia';
                $historyData[0]['date'] = date('d-m-Y');
                $historyData[0]['time'] = date('H:i:s');
                $historyData[0]['class'] = 'badge-success';
                $historyData[0]['user'] = $_SESSION['USER_NAME'];

                /** Verifico se já existe históric */
                if (!empty($resultDraftsUsers->history))
                {

                    /** Pego o histórico existente */
                    $history = json_decode($resultDraftsUsers->history, TRUE);

                    /** Unifico os históricos */
                    $historyData = array_merge($history, $historyData);

                }

                /** Converto para JSON */
                $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

                /** Salvo o histórico de acesso */
                if ($DraftsUsers->SaveHistory($resultDraftsUsers->draf_user_id, $historyData))
                {

                    /** Result **/
                    $result = [

                        'cod' => 2,
                        'title' => utf8_encode($resultDraftsUsers->name),
                        'path' => 'document/' . utf8_encode($path),

                    ];

                }
                else {

                    /** Adição de elementos na array */
                    array_push($message, array('erro', 'Não foi possivel salvar o histórico'));

                    /** Result **/
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
                array_push($message, array('erro', 'Não foi possivel criar o arquivo'));

                /** Result **/
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
            array_push($message, array('erro', 'Não foi possivel localizar o registro'));

            /** Result **/
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