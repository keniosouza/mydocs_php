<?php

/** Importação de classes */
use vendor\model\Users;
use vendor\controller\users\UsersValidate;

/** Instânciamento de classes */
$users = new Users();
$usersValidate = new UsersValidate();

try
{

    /** Parâmetros de entrada */
    $usersValidate->setUserId(@$_POST['user_id']);

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($usersValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $usersValidate->getErrors(),

        ];

    }
    else
    {

        /** Verifico se o usuário foi localizado */
        if ($users->delete($usersValidate->getUserId()))
        {

            /** Adição de elementos na array */
            array_push($message, array('sucesso', 'País removido com sucesso'));

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID'

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