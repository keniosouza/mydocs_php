<?php

/** Importação de classes */
use vendor\model\Drafts;
use vendor\controller\drafts\DraftsValidate;

/** Instânciamento de classes */
$Drafts = new Drafts();
$DraftsValidate = new DraftsValidate();

/** Parâmetros de entrada */
$DraftsValidate->setDraftId(@(int)filter_input(INPUT_POST, 'draft_id', FILTER_SANITIZE_SPECIAL_CHARS));
$DraftsValidate->setName(@(string)filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
$DraftsValidate->setText(@(string)$_POST['text']);

/** Verifico a existência de erros */
if (!empty($DraftsValidate->getErrors()))
{

    /** Caso existam erro(s), retorna os mesmos **/
    throw new InvalidArgumentException($DraftsValidate->getErrors());

}
else
{

    /** Verifico se o usuário foi localizado */
    if ($Drafts->Save($DraftsValidate->getDraftId(), $DraftsValidate->getName(), $DraftsValidate->getText()))
    {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Registro salvo com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=DRAFTS&ACTION=DRAFTS_DATAGRID',

        ];

    }
    else
    {

        /** Caso existam erro(s), retorna os mesmos **/
        throw new InvalidArgumentException('Não foi possivel salvar o registro');

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;