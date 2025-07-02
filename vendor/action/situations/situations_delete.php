<?php

/** Importação de classes */
use vendor\model\Situations;
use vendor\controller\situations\SituationsValidate;

/** Instânciamento de classes */
$Situations = new Situations();
$SituationsValidate = new SituationsValidate();


/** Parâmetros de entrada */
$SituationsValidate->setSituationId(@(int)filter_input(INPUT_POST, 'SITUATION_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($SituationsValidate->getErrors())) {

    /**Retorno o Erro */
    new InvalidArgumentException($SituationsValidate->getErrors());
} else {

    /** Verifico se o usuário foi localizado */
    if ($Situations->delete($SituationsValidate->getSituationId())) {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Situação removida com sucesso.',
            'redirect' => 'FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DATAGRID'

        ];
    } else {
        /**Retorno o Erro */
        new InvalidArgumentException($SituationsValidate->getErrors()); 
    }
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;