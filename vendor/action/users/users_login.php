<?php

/** Importação de classes */
use \vendor\controller\main\Main;
use \vendor\model\Users;
use \vendor\controller\users\UsersValidate;

/** Instânciamento de classes */
$main = new Main();
$users = new Users();
$usersValidate = new UsersValidate();

/** Parâmetros de entrada */
$usersValidate->setEmail(@$_POST['email']);
$usersValidate->setPassword(@$_POST['password']);

/** Controle de mensagens */
$historyData = array();

/** Verifico a existência de erros */
if (!empty($usersValidate->getErrors())) {

    /** Preparo o formulario para retorno **/
    throw new InvalidArgumentException($usersValidate->getErrors());

} else {

    /** Realizo o acesso */
    $resultUser = $users->access($usersValidate->getEmail());

    /** Verifico se o usuário foi localizado */
    if (@(int)$resultUser->user_id > 0) {

        if ( !password_verify($usersValidate->getPassword(), $resultUser->password) ) {

            /** Captura dos dados de login */
            $historyData[0]['title'] = 'Login';
            $historyData[0]['description'] = 'Acesso Realizado no dia';
            $historyData[0]['date'] = date('d-m-Y');
            $historyData[0]['time'] = date('H:i:s');
            $historyData[0]['ip'] = $_SERVER['REMOTE_ADDR'];
            $historyData[0]['class'] = 'badge-primary';

            /** Verifico se já existe históric */
            if (!empty($resultUser->history)) {

                /** Pego o histórico existente */
                $history = json_decode($resultUser->history, TRUE);

                /** Unifico os históricos */
                $historyData = array_merge($history, $historyData);
            }

            /** Converto para JSON */
            $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

            /** Salvo o histórico de acesso */
            $users->history($resultUser->user_id, $historyData);

            /** Operações */
            $main->SessionStart();

            /** Montagem da sessão */
            $_SESSION['USER_ID'] = $resultUser->user_id;
            $_SESSION['USER_NAME'] = $resultUser->name;

            /** Result **/
            $result = [

                'code' => 202,
                'title' => 'Sucesso',
                'data' => 'Usuário localizado com sucesso!',
                'url' => ''

            ];

        } else {

            /** Preparo o formulario para retorno **/
            throw new InvalidArgumentException('Senhas não conferem, verifique os dados informados!');

        }

    } else {

        /** Preparo o formulario para retorno **/
        throw new InvalidArgumentException('Não foi possivel localizar o usuário');

    }
    
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
