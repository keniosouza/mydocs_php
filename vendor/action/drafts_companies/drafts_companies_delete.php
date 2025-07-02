<?php

/** Importação de classes */
use vendor\model\DraftsCompanies;
use vendor\controller\drafts_companies\DraftsCompaniesValidate;

/** Instânciamento de classes */
$DraftsCompanies = new DraftsCompanies();
$DraftsCompaniesValidate = new DraftsCompaniesValidate();

/** Parâmetros de entrada */
$DraftsCompaniesValidate->setDraftCompaniesId(@(int)filter_input(INPUT_POST, 'DRAFT_COMPANY_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($DraftsCompaniesValidate->getErrors())) {

    /** Preparo o formulario para retorno **/
    throw new InvalidArgumentException($DraftsCompaniesValidate->getErrors());

} else {

    /** Busco o registro desejado */
    $resultDraftCompanies = $DraftsCompanies->Get($DraftsCompaniesValidate->getDraftCompaniesId());

    /** Verifico se o registro existe */
    if (@(int)$resultDraftCompanies->draft_companies_id) {

        /** Verifico se o usuário foi localizado */
        if ($DraftsCompanies->delete($DraftsCompaniesValidate->getDraftCompaniesId())) {

            /** Result **/
            $result = [

                'code' => 200,
                'title' => 'Sucesso',
                'data' => 'Registro removido com sucesso',
                'target' => 'documents-tab-pane',
                'redirect' => 'FOLDER=VIEW&TABLE=PRODUCTS_COMPANIES&ACTION=PRODUCTS_COMPANIES_DOCUMENTS_DATAGRID&COMPANY_ID=' . $resultDraftCompanies->company_id

            ];

        } else {

            /** Preparo o formulario para retorno **/
            throw new InvalidArgumentException('Não foi possivel remover o registro');

        }

    } else {

        /** Preparo o formulario para retorno **/
        throw new InvalidArgumentException('Não foi possivel localizar o registro');

    }
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
