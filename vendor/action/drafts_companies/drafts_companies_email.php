<?php

/** Importação de classes */
use vendor\controller\email\Email;
use vendor\controller\email\EmailValidate;
use vendor\model\Configurations;
use vendor\model\DraftsCompanies;
use vendor\controller\drafts_companies\DraftsCompaniesValidate;

/** Instânciamento de classes */
$Email = new Email();
$EmailValidate = new EmailValidate();
$Configurations = new Configurations();
$DraftsCompanies = new DraftsCompanies();
$DraftsCompaniesValidate = new DraftsCompaniesValidate();

/** Parâmetros de entrada - drafts_companies */
$DraftsCompaniesValidate->setDraftCompaniesId(@(int)filter_input(INPUT_POST, 'draft_companies_id', FILTER_SANITIZE_SPECIAL_CHARS));
$EmailValidate->setText(@(string)$_POST['text']);

/** Verifico a existência de erros */
if (!empty($DraftsCompaniesValidate->getErrors()) || !empty($EmailValidate->getErrors())) {

    /** Preparo o formulario para retorno **/
    throw new InvalidArgumentException($DraftsCompaniesValidate->getErrors() . $EmailValidate->getErrors());

} else {

    /** Busco a configuração */
    $resultConfiguration = $Configurations->All();

    /** Decodifico as preferencias */
    $resultConfiguration->preferences = (object)json_decode($resultConfiguration->preferences);

    /** Busco o Registro para ser impresso*/
    $resultDraftCompanies = $DraftsCompanies->Get($DraftsCompaniesValidate->getDraftCompaniesId());

    /** Verifico se o registro existe */
    if (@(int)$resultDraftCompanies->draft_companies_id > 0) {

        /** Gero o nome do arquivo */
        $fileName = 'document/' . $Main->removeAcento($Main->removeMask(str_replace(' ', '_', strtoupper($resultDraftCompanies->nickname . '_' . $resultDraftCompanies->name)))) . '.pdf';

        /** Inicio a coleta de dados */
        ob_start();

        /** Inclusão do arquivo desejado */
        require 'vendor/view/email/email_document.php';

        /** Prego a estrutura do arquivo */
        $html = ob_get_contents();

        /** Removo o arquivo incluido */
        ob_end_clean();

        /** Verifico se o envio foi bem sucedido */
        $Email->send($html, $resultDraftCompanies, $resultDraftCompanies->name, $resultConfiguration->preferences->email, $fileName, $_SESSION['USER_NAME']);

        /** Defino o histórico */
        $historyData[0]['title'] = 'Email';
        $historyData[0]['description'] = 'Documento enviado por email no dia';
        $historyData[0]['date'] = date('d-m-Y');
        $historyData[0]['time'] = date('H:i:s');
        $historyData[0]['class'] = 'badge-danger';
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

        /** Salvo o histórico de acesso */
        if ($DraftsCompanies->SaveHistory($resultDraftCompanies->draft_companies_id, $historyData)) {

            /** Result **/
            $result = [

                'code' => 200,
                'title' => 'Sucesso',
                'data' => 'Email enviado com sucesso',
                'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DATAGRID&COMPANY_ID=' . $resultDraftCompanies->company_id,

            ];

        } else {

            /** Preparo o formulario para retorno **/
            throw new InvalidArgumentException('Não foi possivel salvar o histórico');

        }

    } else {

        /** Preparo o formulario para retorno **/
        throw new InvalidArgumentException('Não foi possivel localizar a empresa');

    }
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
