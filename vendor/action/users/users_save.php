<?php

/** Importação de classes */
use vendor\model\Users;
use vendor\controller\users\UsersValidate;

/** Instânciamento de classes */
$Users = new Users();
$UsersValidate = new UsersValidate();

/** Parâmetros de entrada */
$UsersValidate->setUserId(@(int)filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setSituationId(@(int)filter_input(INPUT_POST, 'situation_id', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setPermissionId(@(string)filter_input(INPUT_POST, 'permission_id', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setNickname(@(string)filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setName(@(string)filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setDateBirth(@(string)filter_input(INPUT_POST, 'date_birth', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setOffice(@(string)filter_input(INPUT_POST, 'office', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setCtps(@(string)filter_input(INPUT_POST, 'ctps', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setCtpSerie(@(string)filter_input(INPUT_POST, 'ctps_serie', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setPis(@(string)filter_input(INPUT_POST, 'pis', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setDateAdmission(@(string)$_POST['date_admission']);
$UsersValidate->setEmail(@(string)filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
$UsersValidate->setPassword(@(string)filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($UsersValidate->getErrors())) {

    /** Caso existam erro(s), retorna os mesmos **/
    throw new InvalidArgumentException($UsersValidate->getErrors());

} else {

    /** Verifico se devo alterar a senha */
    if ($UsersValidate->getUserId() > 0 && empty($UsersValidate->getPassword())) {

        /** Busco a senha existente */
        $UsersValidate->setPassword($Users->get($UsersValidate->getUserId())->password);

    } else {

        /** Criptografo a senha */
        $UsersValidate->setPassword($Main->encryptData($UsersValidate->getPassword()));
    }

    /** Verifico se o usuário foi localizado */
    if ($Users->save($UsersValidate->getUserId(), $UsersValidate->getSituationId(), $UsersValidate->getPermissionId(), $UsersValidate->getNickname(), $UsersValidate->getName(), $UsersValidate->getDateBirth(), $UsersValidate->getOffice(), $UsersValidate->getCtps(), $UsersValidate->getCtpSerie(), $UsersValidate->getPis(), $UsersValidate->getDateAdmission(), $UsersValidate->getEmail(), $UsersValidate->getPassword(), json_encode($UsersValidate->getHistory(), JSON_PRETTY_PRINT))) {

        /** Result **/
        // $result = [

        //     'code' => 200,
        //     'title' => 'Sucesso',
        //     'data' => 'Registro salvo com sucesso',
        //     'redirect' => 'FOLDER=VIEW&TABLE=USERS&ACTION=USERS_DATAGRID',

        // ];

    } else {

        /** Caso existam erro(s), retorna os mesmos **/
        throw new InvalidArgumentException('Não foi possivel salvar o registro');

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
