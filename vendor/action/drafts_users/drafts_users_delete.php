<?php

/** Importação de classes */
use vendor\model\DraftsUsers;
use vendor\controller\drafts_users\DraftsUsersValidate;

try
{

    /** Instânciamento de classes */
    $DraftsUsers = new DraftsUsers();
    $DraftsUsersValidate = new DraftsUsersValidate();

    /** Controle de mensagens */
    $message = Array();

    /** Parâmetros de entrada */
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

        /** Busco o registro desejado */
        $resultDraftUsers = $DraftsUsers->Get($DraftsUsersValidate->getDraftUserId());

        /** Verifico se o registro existe */
        if (@(int)$resultDraftUsers->draft_user_id)
        {

            /** Verifico se o usuário foi localizado */
            if ($DraftsUsers->delete($DraftsUsersValidate->getDraftUserId()))
            {

                /** Adição de elementos na array */
                array_push($message, array('sucesso', 'País removido com sucesso'));

                /** Result **/
                $result = [

                    'cod' => 0,
                    'title' => 'Sucesso',
                    'message' => $message,
                    'redirect' => 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE&USER_ID=' . $resultDraftUsers->user_id

                ];

            }
            else
            {

                /** Adição de elementos na array */
                array_push($message, array('erro', 'Não foi possivel remover o registro'));

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