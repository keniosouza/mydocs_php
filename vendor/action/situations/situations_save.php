<?php

/** Importação de classes */

use vendor\model\Situations;
use vendor\controller\situations\SituationsValidate;

/** Instânciamento de classes */
$Situations = new Situations();
$SituationsValidate = new SituationsValidate();



/** Parâmetros de entrada */
$SituationsValidate->setSituationId(@(int)filter_input(INPUT_POST, 'situation_id', FILTER_SANITIZE_SPECIAL_CHARS));
$SituationsValidate->setName(@(string)filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));


/** Verifico a existência de erros */
if (!empty($SituationsValidate->getErrors())) {
    new InvalidArgumentException($SituationsValidate->getErrors());
} else {

    /** Defino o histórico do registro */
    $historyData[0]['title'] = 'Cadastro';
    $historyData[0]['description'] = 'Texto Vinculado a Empresa';
    $historyData[0]['date'] = date('d-m-Y');
    $historyData[0]['time'] = date('H:i:s');
    $historyData[0]['class'] = 'badge-primary';

    /** Defino o histórico */
    $SituationsValidate->setHistory($historyData);

    /** Verifico se o usuário foi localizado */
    if ($Situations->save($SituationsValidate->getSituationId(), $SituationsValidate->getName(), json_encode($SituationsValidate->getHistory(), JSON_PRETTY_PRINT))) {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' =>'Situação cadastrada com sucesso.',
            'redirect' => 'FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DATAGRID'

        ];
    } else {
        new InvalidArgumentException($SituationsValidate->getErrors());
    }
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
