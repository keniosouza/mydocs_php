<?php

/** Importação de classes */
use vendor\controller\main\Main;
use vendor\model\Configurations;
use vendor\model\DraftsCompanies;
use vendor\controller\drafts_companies\DraftsCompaniesValidate;
use vendor\controller\pdf\PdfGenerate;

/** Controle de mensagens */
$PDFGenerate = new PdfGenerate();

/** Instânciamento de classes */
$Main = new Main();
$Configurations = new Configurations();
$DraftsCompanies = new DraftsCompanies();
$DraftsCompaniesValidate = new DraftsCompaniesValidate();

/** Parâmetros de entrada - drafts_companies */
$DraftsCompaniesValidate->setDraftCompaniesId(@(int)filter_input(INPUT_POST, 'DRAFT_COMPANIES_ID', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($DraftsCompaniesValidate->getErrors()) > 0) {

    /** Preparo o formulario para retorno **/
    throw new InvalidArgumentException($DraftsCompaniesValidate->getErrors());

} else {

    /** Busco a configuração */
    $resultConfiguration = $Configurations->All();

    /** Decodifico as preferencias */
    $resultConfiguration->preferences = (object)json_decode($resultConfiguration->preferences);

    /** Busco o Registro para ser impresso*/
    $resultDraftCompanies = $DraftsCompanies->Get($DraftsCompaniesValidate->getDraftCompaniesId());

    /** Verifico se o registro foi localizado */
    if (@(int)$resultDraftCompanies->draft_companies_id > 0) {

        /** Gero o nome do arquivo */
        $path = $Main->removeAcento($Main->removeMask(str_replace(' ', '_', strtoupper($resultDraftCompanies->nickname . '_' . $resultDraftCompanies->name)))) . '.pdf';

        /** Converte a tag <p> para <div> para evitar bugs de renderização do dompdf */
        $text = str_replace('<p', '<div', $resultDraftCompanies->text);
        $text = str_replace('</p>', '</div>', $text);
        $resultDraftCompanies->text = $text;

        /** Inicio a coleta de dados */
        ob_start();

        /** Inclusão do arquivo desejado */
        require 'vendor/view/pdf/pdf_print.php';

        /** Prego a estrutura do arquivo */
        $html = ob_get_contents();

        /** Removo o arquivo incluido */
        ob_end_clean();

        /** Verifico se o arquivo foi criado */
        if ($PDFGenerate->generate($html, '/document/', $path, $resultConfiguration->preferences->page)) {

            /** Captura dos dados de login */
            $historyData[0]['title'] = 'PDF';
            $historyData[0]['description'] = 'PDF gerado no dia';
            $historyData[0]['date'] = date('d-m-Y');
            $historyData[0]['time'] = date('H:i:s');
            $historyData[0]['class'] = 'badge-success';
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

                    'code' => 733,
                    'title' => $resultDraftCompanies->name . ': ' . $resultDraftCompanies->nickname,
                    'data' => 'document/' . $path,
                    'size' => 'lg',
                    'color_modal' => null,
                    'color_border' => null,
                    'type' => null,
                    'procedure' => null,
                    'time' => null,
                    'document' => true

                ];

            } else {

                /** Preparo o formulario para retorno **/
                throw new InvalidArgumentException('Não foi possivel atualizar o histórico');

            }

        } else {

            /** Preparo o formulario para retorno **/
            throw new InvalidArgumentException('Não foi possivel processar o PDF');

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
