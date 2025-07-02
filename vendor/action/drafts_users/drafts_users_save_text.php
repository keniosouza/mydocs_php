<?php

/** Importação de classes */
use vendor\controller\main\Main;
use vendor\model\DraftsUsers;
use vendor\controller\drafts_users\DraftsUsersValidate;

try
{

    /** Controle de mensagens */
    $message = Array();

    /** Instânciamento de classes */
    $Main = new Main();
    $DraftsUsers = new DraftsUsers();
    $DraftsUsersValidate = new DraftsUsersValidate();

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada - drafts_companies */
    $DraftsUsersValidate->setDraftUserId(@(int)filter_input(INPUT_POST, 'draft_user_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $DraftsUsersValidate->setUserId(@(int)filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $DraftsUsersValidate->setText(base64_encode(@(string)$_POST['text']));

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

        /** Busco o Registro */
        $resultDraftsUsers = $DraftsUsers->Get($DraftsUsersValidate->getDraftUserId());

        /** Monto o histórico */
        $historyData[0]['title'] = 'Edicao';
        $historyData[0]['description'] = 'Texto alterado no dia';
        $historyData[0]['date'] = date('d-m-Y');
        $historyData[0]['time'] = date('H:i:s');
        $historyData[0]['class'] = 'badge-warning';
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

        /** Verifico se o usuário foi localizado */
        if ($DraftsUsers->SaveText($DraftsUsersValidate->getDraftUserId(), $DraftsUsersValidate->getText(), $historyData))
        {

            /** Adição de elementos na array */
            array_push($message, array('sucesso', 'Usuário cadastrado com sucesso'));

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=' . $DraftsUsersValidate->getUserId()

            ];

        }
        else
        {

            /** Adição de elementos na array */
            array_push($message, array('erro', 'Não foi possivel salvar o registro'));

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