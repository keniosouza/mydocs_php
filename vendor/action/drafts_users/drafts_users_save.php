<?php

/** Importação de classes */
use vendor\controller\main\Main;
use vendor\model\Users;
use vendor\model\Configurations;
use vendor\model\Drafts;
use vendor\model\DraftsUsers;
use vendor\controller\drafts_users\DraftsUsersValidate;
use vendor\controller\highlighters\HighlightersQualify;

try
{

    /** Controle de mensagens */
    $message = Array();

    /** Instânciamento de classes */
    $Main = new Main();
    $Users = new Users();
    $Configurations = new Configurations();
    $Drafts = new Drafts();
    $DraftsUsers = new DraftsUsers();
    $DraftsUsersValidate = new DraftsUsersValidate();
    $HighlightersQualify = new HighlightersQualify();

    /** Operações */
    $Main->SessionStart();

    /** Parâmetros de entrada - drafts_companies */
    $DraftsUsersValidate->setDraftUserId(@(int)filter_input(INPUT_POST, 'draft_user_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $DraftsUsersValidate->setDraftId(@(int)filter_input(INPUT_POST, 'draft_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $DraftsUsersValidate->setUserId(@(int)filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS));

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

        /** Defino o histórico do registro */
        $historyData[0]['title'] = 'Cadastro';
        $historyData[0]['description'] = 'Texto Vinculado ao Usuário';
        $historyData[0]['date'] = date('d-m-Y');
        $historyData[0]['time'] = date('H:i:s');
        $historyData[0]['class'] = 'badge-primary';
        $historyData[0]['user'] = $_SESSION['USER_NAME'];

        /** Converto para JSON */
        $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

        /** Busco o Registro da Minuta */
        if ($DraftsUsersValidate->getDraftId() > 0)
        {

            /** Busco as configurações da empresa */
            $resultConfigurations = $Configurations->All();

            /** Busco o registro da empresa */
            $resultUsers = $Users->get($DraftsUsersValidate->getUserId());

            /** Qualifico os dados da empresa */
            $DraftsUsersValidate->setText($HighlightersQualify->Qualify($Drafts->get($DraftsUsersValidate->getDraftId())->text, $resultUsers->user_id, 'users'));

            /** Qualificação de configuração */
            $DraftsUsersValidate->setText($HighlightersQualify->Qualify($DraftsUsersValidate->getText(), $resultConfigurations->configuration_id, 'configurations'));

            /** Verifico se o usuário foi localizado */
            if ($DraftsUsers->Save($DraftsUsersValidate->getDraftUserId(), $DraftsUsersValidate->getDraftId(), $DraftsUsersValidate->getUserId(), $DraftsUsersValidate->getText(), $historyData))
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
        else
        {

            /** Adição de elementos na array */
            array_push($message, array('erro', 'Não foi possivel localizara a minuta'));

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