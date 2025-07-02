<?php

/** Importação de classes */
use vendor\model\Configurations;
use vendor\controller\configurations\ConfigurationsValidate;
use vendor\controller\configurations\ConfigurationsEmailPreferencesValidate;

/** Instânciamento de classes */
$Configurations = new Configurations();
$ConfigurationsValidate = new ConfigurationsValidate();
$ConfigurationsEmailPreferencesValidate = new ConfigurationsEmailPreferencesValidate();

/** Controle de mensagens */
$result = array();
$history = array();
$preferences = array();


    /** Parâmetros de entrada */
    $ConfigurationsValidate->setConfigurationId(@(int)filter_input(INPUT_POST, 'configuration_id', FILTER_SANITIZE_SPECIAL_CHARS));

    /** Parâmetros da Página */
    $ConfigurationsEmailPreferencesValidate->setHost(@(string)filter_input(INPUT_POST, 'host', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsEmailPreferencesValidate->setUsername(@(string)filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsEmailPreferencesValidate->setPort(@(string)filter_input(INPUT_POST, 'port', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsEmailPreferencesValidate->setPassword(@(string)filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));

    /** Verifico a existência de erros */
    if (!empty($ConfigurationsEmailPreferencesValidate->getErrors())) {

        throw new InvalidArgumentException($ConfigurationsEmailPreferencesValidate->getErrors());

    } else {

        /** Defino as prefências */
        $preferences['host'] = $ConfigurationsEmailPreferencesValidate->getHost();
        $preferences['username'] = $ConfigurationsEmailPreferencesValidate->getUsername();
        $preferences['port'] = $ConfigurationsEmailPreferencesValidate->getPort();
        $preferences['password'] = $ConfigurationsEmailPreferencesValidate->getPassword();

        /** Busco as configurações já existentes */
        $resultConfiguration = $Configurations->All();

        /** Verifico se os dados já existem */
        if (!empty($resultConfiguration->preferences))
        {
          
            /** Decodifico as preferências existentes */
            $resultConfiguration->preferences = json_decode($resultConfiguration->preferences, true);

            /** Unifico a configuração atual com a anterior */
            $resultConfiguration->preferences['email'] = $preferences;

        }
        else
        {             

            /** Unifico a configuração atual com a anterior */
            $resultConfiguration->preferences['email'] = $preferences;
        
        }

        print_r($resultConfiguration->preferences);
        exit;

        /** Verifico se o usuário foi localizado */
        if ($Configurations->SavePreference($ConfigurationsValidate->getConfigurationId(), json_encode($resultConfiguration->preferences, JSON_PRETTY_PRINT)))
        {

            /** Result **/
            $result = [

                'code' => 200,
                'title' => 'Sucesso',
                'data' => 'E-mail salvo com sucesso',
                'redirect' => 'FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_EMAIL_PREFERENCE_DATAGRID',

            ];

        } else {

            throw new InvalidArgumentException($ConfigurationsEmailPreferencesValidate->getErrors());

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;