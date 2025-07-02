<?php

/** Verifico se o usuário esta logado */
if ($Main->checkSession()) {

    /** Exclusão da sessão */
    $Main->SessionDestroy();

    /** Result **/
    $result = [

        'code' => 202,
        'title' => 'Sucesso',
        'data' => 'Usuário localizado com sucesso!',
        'url' => ''

    ];

} else {

    /** Caso existam erro(s), retorna os mesmos **/
    throw new InvalidArgumentException('Não foi possivel encerrar a sessão');

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
