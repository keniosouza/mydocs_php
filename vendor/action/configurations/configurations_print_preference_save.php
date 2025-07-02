<?php

/** Importação de classes */
use vendor\model\Configurations;
use vendor\controller\configurations\ConfigurationsValidate;
use vendor\controller\configurations\ConfigurationsPrintPreferencesValidate;

/** Instânciamento de classes */
$Configurations = new Configurations();
$ConfigurationsValidate = new ConfigurationsValidate();
$ConfigurationsPrintPreferencesValidate = new ConfigurationsPrintPreferencesValidate();

/** Controle de mensagens */
$result = array();
$history = array();
$preferences = array();

/** Parâmetros de entrada */
$ConfigurationsValidate->setConfigurationId(@(int)filter_input(INPUT_POST, 'configuration_id', FILTER_SANITIZE_SPECIAL_CHARS));

/** Paâmetros da Página */
$ConfigurationsPrintPreferencesValidate->setPageOrientation(@(string)filter_input(INPUT_POST, 'orientation', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageHeight(@(string)filter_input(INPUT_POST, 'height', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageWidth(@(string)filter_input(INPUT_POST, 'width', FILTER_SANITIZE_SPECIAL_CHARS));

/** Paâmetros da Area de Impressão */
$ConfigurationsPrintPreferencesValidate->setPageBodyMarginLeft(@(string)filter_input(INPUT_POST, 'body_margin_left', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageBodyMarginRight(@(string)filter_input(INPUT_POST, 'body_margin_right', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageBodyMarginTop(@(string)filter_input(INPUT_POST, 'body_margin_top', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageBodyMarginBottom(@(string)filter_input(INPUT_POST, 'body_margin_bottom', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageHeaderContent(@(string)$_POST['header_content']);

/** Paâmetros do Cabeçalho */
$ConfigurationsPrintPreferencesValidate->setPageHeaderMarginLeft(@(string)filter_input(INPUT_POST, 'header_margin_left', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageHeaderMarginRight(@(string)filter_input(INPUT_POST, 'header_margin_right', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageHeaderMarginTop(@(string)filter_input(INPUT_POST, 'header_margin_top', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageHeaderMarginBottom(@(string)filter_input(INPUT_POST, 'header_margin_bottom', FILTER_SANITIZE_SPECIAL_CHARS));

/** Paâmetros do Rodapé */
$ConfigurationsPrintPreferencesValidate->setPageFooterMarginLeft(@(string)filter_input(INPUT_POST, 'footer_margin_left', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageFooterMarginRight(@(string)filter_input(INPUT_POST, 'footer_margin_right', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageFooterMarginTop(@(string)filter_input(INPUT_POST, 'footer_margin_top', FILTER_SANITIZE_SPECIAL_CHARS));
$ConfigurationsPrintPreferencesValidate->setPageFooterMarginBottom(@(string)filter_input(INPUT_POST, 'footer_margin_bottom', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($ConfigurationsPrintPreferencesValidate->getErrors())) {

    throw new InvalidArgumentException($ConfigurationsPrintPreferencesValidate->getErrors());

} else {

    /** Defino as prefências */
    $preferences['orientation'] = $ConfigurationsPrintPreferencesValidate->getPageOrientation();
    $preferences['height'] = $ConfigurationsPrintPreferencesValidate->getPageHeight();
    $preferences['width'] = $ConfigurationsPrintPreferencesValidate->getPageWidth();

    /** Defino a['page']s prefências */
    $preferences['body']['margin_left'] = $ConfigurationsPrintPreferencesValidate->getPageBodyMarginLeft();
    $preferences['body']['margin_right'] = $ConfigurationsPrintPreferencesValidate->getPageBodyMarginRight();
    $preferences['body']['margin_top'] = $ConfigurationsPrintPreferencesValidate->getPageBodyMarginTop();
    $preferences['body']['margin_bottom'] = $ConfigurationsPrintPreferencesValidate->getPageBodyMarginBottom();

    /** Defino as prefências */
    $preferences['header']['margin_left'] = $ConfigurationsPrintPreferencesValidate->getPageHeaderMarginLeft();
    $preferences['header']['margin_right'] = $ConfigurationsPrintPreferencesValidate->getPageHeaderMarginRight();
    $preferences['header']['margin_top'] = $ConfigurationsPrintPreferencesValidate->getPageHeaderMarginTop();
    $preferences['header']['margin_bottom'] = $ConfigurationsPrintPreferencesValidate->getPageHeaderMarginBottom();
    $preferences['header']['content'] = $ConfigurationsPrintPreferencesValidate->getPageHeaderContent();

    /** Defino as prefências */
    $preferences['footer']['margin_left'] = $ConfigurationsPrintPreferencesValidate->getPageFooterMarginLeft();
    $preferences['footer']['margin_right'] = $ConfigurationsPrintPreferencesValidate->getPageFooterMarginRight();
    $preferences['footer']['margin_top'] = $ConfigurationsPrintPreferencesValidate->getPageFooterMarginTop();
    $preferences['footer']['margin_bottom'] = $ConfigurationsPrintPreferencesValidate->getPageFooterMarginBottom();

    /** Busco as configurações já existentes */
    $resultConfiguration = $Configurations->All();

    /** Verifico se os dados já existem */
    if(!empty($resultConfiguration->preferences))
    {

        /** Obtenho as configurações anteriores */
        $resultConfiguration->preferences = json_decode($resultConfiguration->preferences, true);

        /** Unifico a configuração atual com a anterior */
        $resultConfiguration->preferences['page'] = $preferences;

    }
    else
    {

        /** Guardo as configurações */
        $resultConfiguration->preferences['page'] = $preferences;

    }

    /** Verifico se o usuário foi localizado */
    if ($Configurations->SavePreference($ConfigurationsValidate->getConfigurationId(), json_encode($resultConfiguration->preferences, JSON_PRETTY_PRINT)))
    {

        /** Result **/
        $result = [
            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Registro salvo com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_PRINT_PREFERENCE_DATAGRID',
        ];

    } else {

        throw new InvalidArgumentException($ConfigurationsPrintPreferencesValidate->getErrors());

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
