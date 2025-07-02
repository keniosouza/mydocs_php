<?php

/** Importação de classes */
use vendor\model\Drafts;
use vendor\controller\drafts\DraftsValidate;

/** Instânciamento de classes */
$Drafts = new Drafts();
$DraftsValidate = new DraftsValidate();

/** Parâmetros de entrada */
$DraftsValidate->setDraftId(@(int)filter_input(INPUT_POST, 'DRAFT_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($DraftsValidate->getErrors()))
{

    /** Caso existam erro(s), retorna os mesmos **/
    throw new InvalidArgumentException($DraftsValidate->getErrors());

}
else
{

    /** Verifico se o usuário foi localizado */
    if ($Drafts->delete($DraftsValidate->getDraftId()))
    {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Registro removido com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=DRAFTS&ACTION=DRAFTS_DATAGRID',

        ];

    }
    else
    {

        /** Caso existam erro(s), retorna os mesmos **/
        throw new InvalidArgumentException('Não foi possivel remover o registro');

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;