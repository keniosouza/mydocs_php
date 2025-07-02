<?php

/** Importação de classes */

use vendor\model\Companies;
use vendor\model\Configurations;
use vendor\model\Drafts;
use vendor\model\DraftsCompanies;
use vendor\model\ProductsCompanies;
use vendor\controller\drafts_companies\DraftsCompaniesValidate;
use vendor\controller\products_companies\ProductsCompaniesValidate;
use vendor\controller\highlighters\HighlightersQualify;

/** Instânciamento de classes */
$Companies = new Companies();
$Configurations = new Configurations();
$Drafts = new Drafts();
$DraftsCompanies = new DraftsCompanies();
$DraftsCompaniesValidate = new DraftsCompaniesValidate();
$ProductsCompaniesValidate = new ProductsCompaniesValidate();
$HighlightersQualify = new HighlightersQualify();
$ProductsCompanies = new ProductsCompanies();

/** Parâmetros de entrada - drafts_companies */
$DraftsCompaniesValidate->setDraftCompaniesId(@(int)filter_input(INPUT_POST, 'draft_companies_id', FILTER_SANITIZE_SPECIAL_CHARS));
$DraftsCompaniesValidate->setCompanyId(@(int)filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_SPECIAL_CHARS));
$DraftsCompaniesValidate->setDraftId(@(int)filter_input(INPUT_POST, 'draft_id', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($DraftsCompaniesValidate->getErrors())) {

    /** Caso existam erro(s), retorna os mesmos **/
    throw new InvalidArgumentException($DraftsCompaniesValidate->getErrors());
} else {

    /** Defino o histórico do registro */
    $historyData[0]['title'] = 'Cadastro';
    $historyData[0]['description'] = 'Texto Vinculado a Empresa';
    $historyData[0]['date'] = date('d-m-Y');
    $historyData[0]['time'] = date('H:i:s');
    $historyData[0]['class'] = 'badge-primary';
    $historyData[0]['user'] = $_SESSION['USER_NAME'];

    /** Converto para JSON */
    $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

    /** Busco o Registro da Minuta */
    if ($DraftsCompaniesValidate->getDraftId() > 0) {

        /** Busco as configurações da empresa */
        $resultConfigurations = $Configurations->All();

        /** Busco o registro da empresa */
        $resultCompanies = $Companies->get($DraftsCompaniesValidate->getCompanyId());

        /** Busco o registro da empresa */
        $resultProductsCompanies = $ProductsCompanies->All($DraftsCompaniesValidate->getCompanyId());

        /** Defino o texto original */
        $DraftsCompaniesValidate->setText($Drafts->get($DraftsCompaniesValidate->getDraftId())->text);

        /** Qualifico os dados da empresa */
        $DraftsCompaniesValidate->setText($HighlightersQualify->Qualify($DraftsCompaniesValidate->getText(), $resultCompanies->company_id, 'companies'));

        /** Qualificação de estados */
        $DraftsCompaniesValidate->setText($HighlightersQualify->Qualify($DraftsCompaniesValidate->getText(), $resultCompanies->state_id, 'states'));

        /** Qualificação de configuração */
        $DraftsCompaniesValidate->setText($HighlightersQualify->Qualify($DraftsCompaniesValidate->getText(), $resultConfigurations->configuration_id, 'configurations'));

        /** Qualificação de cidades */
        $DraftsCompaniesValidate->setText($HighlightersQualify->Qualify($DraftsCompaniesValidate->getText(), $resultCompanies->city_id, 'cities'));

        /** Qualificação fixas */
        $DraftsCompaniesValidate->setText($HighlightersQualify->QualifyFixed($DraftsCompaniesValidate->getText(), $resultProductsCompanies));

        /** Verifico se o usuário foi localizado */
        if ($DraftsCompanies->Save($DraftsCompaniesValidate->getDraftCompaniesId(), $DraftsCompaniesValidate->getDraftId(), $DraftsCompaniesValidate->getCompanyId(), $DraftsCompaniesValidate->getText(), $historyData)) {

            /** Result **/
            $result = [
                'code' => 200,
                'title' => 'Sucesso',
                'data' => 'Registro salvo com sucesso',
                'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=' . $DraftsCompaniesValidate->getCompanyId()

            ];
        } else {

            /** Caso existam erro(s), retorna os mesmos **/
            throw new InvalidArgumentException('Não foi possivel realizar o vinculo');
        }
    } else {

        /** Caso existam erro(s), retorna os mesmos **/
        throw new InvalidArgumentException('Não foi possivel localizar a empresa');
    }
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
