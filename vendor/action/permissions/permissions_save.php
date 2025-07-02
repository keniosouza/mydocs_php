<?php

/** Importação de classes */
use vendor\model\Permissions;
use vendor\controller\Permissions\PermissionsValidate;

/** Instânciamento de classes */
$permissions = new Permissions();
$permissionsValidate = new PermissionsValidate();

try
{

    /** Parâmetros de entrada */
    $permissionsValidate->setPermissionId(@(int)$_POST['permission_id']);
    $permissionsValidate->setName(@(string)$_POST['name']);
    $permissionsValidate->setPermissions(@(string)$_POST['permissions']);
    $permissionsValidate->setDateRegister(date('Y-m-d'));
    $permissionsValidate->setDateUpdate(date('Y-m-d'));

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (count($permissionsValidate->getErrors()) > 0)
    {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $permissionsValidate->getErrors(),

        ];

    }
    else
    {

        /** Verifico se o usuário foi localizado */
        if ($permissions->save($permissionsValidate->getPermissionId(), $permissionsValidate->getName(), $permissionsValidate->getPermissionId(), $permissionsValidate->getDateRegister(), $permissionsValidate->getDateUpdate()))
        {

            /** Adição de elementos na array */
            array_push($message, array('sucesso', 'Empresa cadastrado com sucesso'));

            /** Result **/
            $result = [

                'cod' => 0,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=PERMISSIONS&ACTION=PERMISSIONS_DATAGRID'

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