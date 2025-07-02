<?php

/** Importação de classes */
use vendor\model\DraftsCompanies;
use vendor\controller\drafts_companies\DraftsCompaniesValidate;

/** Instânciamento de classes */
$DraftsCompanies = new DraftsCompanies();
$DraftsCompaniesValidate = new DraftsCompaniesValidate();

/** Parâmetros de entrada - drafts_companies */
$DraftsCompaniesValidate->setDraftCompaniesId(@(int)filter_input(INPUT_POST, 'draft_companies_id', FILTER_SANITIZE_SPECIAL_CHARS));
$DraftsCompaniesValidate->setCompanyId(@(int)filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_SPECIAL_CHARS));
$DraftsCompaniesValidate->setText(@(string)$_POST['text']);

/** Verifico a existência de erros */
if (!empty($DraftsCompaniesValidate->getErrors())) {

    /** Preparo o formulario para retorno **/
    throw new InvalidArgumentException($DraftsCompaniesValidate->getErrors());

} else {

    /** Busco o Registro */
    $resultDraftCompanies = $DraftsCompanies->Get($DraftsCompaniesValidate->getDraftCompaniesId());

    /** Monto o histórico */
    $historyData[0]['title'] = 'Edicao';
    $historyData[0]['description'] = 'Texto alterado no dia';
    $historyData[0]['date'] = date('d-m-Y');
    $historyData[0]['time'] = date('H:i:s');
    $historyData[0]['class'] = 'badge-warning';
    $historyData[0]['user'] = $_SESSION['USER_NAME'];

    /** Verifico se já existe históric */
    if (!empty($resultDraftCompanies->history)) {

        /** Pego o histórico existente */
        $history = json_decode($resultDraftCompanies->history, TRUE);

        /** Unifico os históricos */
        $historyData = array_merge($history, $historyData);
        
    }

    /** Converto para JSON */
    $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

    /** Verifico se o usuário foi localizado */
    if ($DraftsCompanies->SaveText($DraftsCompaniesValidate->getDraftCompaniesId(), $DraftsCompaniesValidate->getText(), $historyData)) {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Produto cadastrado com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=' . $DraftsCompaniesValidate->GetCompanyId(),

        ];

    } else {

        /** Preparo o formulario para retorno **/
        throw new InvalidArgumentException('Não foi possivel salvar o texto');

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
