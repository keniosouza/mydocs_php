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
$message = [];
$history = array();

try {

    /** Parâmetros de entrada */
    $ConfigurationsValidate->setConfigurationId(@(int)filter_input(INPUT_POST, 'configuration_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setNickname(@(string)filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setNameBusiness(@(string)filter_input(INPUT_POST, 'name_business', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setNameFantasy(@(string)filter_input(INPUT_POST, 'name_fantasy', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setCnpj(@(string)filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setSite(@(string)filter_input(INPUT_POST, 'site', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setTelephone(@(string)filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setCellphone(@(string)filter_input(INPUT_POST, 'cellphone', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setEmail(@(string)filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setResponsible(@(string)filter_input(INPUT_POST, 'responsible', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setResponsibleOffice(@(string)filter_input(INPUT_POST, 'responsible_office', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setCep(@(string)filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setStateId(@(int)filter_input(INPUT_POST, 'state_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setCityId(@(int)filter_input(INPUT_POST, 'city_id', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setComplement(@(string)filter_input(INPUT_POST, 'complement', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsValidate->setHistory(@(string)filter_input(INPUT_POST, 'history', FILTER_SANITIZE_SPECIAL_CHARS));

    /** Parâmetros E-mail */
    $ConfigurationsEmailPreferencesValidate->setHost(@(string)filter_input(INPUT_POST, 'host', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsEmailPreferencesValidate->setUsername(@(string)filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsEmailPreferencesValidate->setPort(@(string)filter_input(INPUT_POST, 'port', FILTER_SANITIZE_SPECIAL_CHARS));
    $ConfigurationsEmailPreferencesValidate->setPassword(@(string)filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
    


    /** Verifico o tipo de histórico */
    if ($ConfigurationsValidate->getConfigurationId() > 0) {

        /** Busco o Histórico */
        $resultHistory = json_decode($Configurations->Get($ConfigurationsValidate->getConfigurationId())->history,true);
        if ($resultHistory === null) {
            $resultHistory = [];
        }

        /** Captura dos dados de login */
        $history[0]['title'] = 'Atualização';
        $history[0]['description'] = 'Atualização no registro';
        $history[0]['class'] = 'badge-warning';

        /** Junto as array */
        $history = array_merge($history, $resultHistory);

    } else {

        /** Captura dos dados de login */
        $history[0]['title'] = 'Cadastro';
        $history[0]['description'] = 'Novo registro cadastrado';
        $history[0]['class'] = 'badge-success';

    }

    $history[0]['date'] = date('d-m-Y');
    $history[0]['time'] = date('H:i:s');

    /** Salvo o histórico do registro */
    $ConfigurationsValidate->setHistory($history);

    /** Verifico a existência de erros */
    if (!empty($ConfigurationsValidate->getErrors())) {

        /** Preparo o formulario para retorno **/
        $result = [

            'cod' => 1,
            'title' => 'Atenção',
            'message' => $ConfigurationsValidate->getErrors(),

        ];

    } else {

        /** Verifico se o usuário foi localizado */
        if ($Configurations->Save($ConfigurationsValidate->getConfigurationId(), $ConfigurationsValidate->getNickname(), $ConfigurationsValidate->getNameBusiness(), $ConfigurationsValidate->getNameFantasy(), $ConfigurationsValidate->getCnpj(), $ConfigurationsValidate->getSite(), $ConfigurationsValidate->getTelephone(), $ConfigurationsValidate->getCellphone(), $ConfigurationsValidate->getEmail(), $ConfigurationsValidate->getResponsible(), $ConfigurationsValidate->getResponsibleOffice(), $ConfigurationsValidate->getCep(), $ConfigurationsValidate->getStateId(), $ConfigurationsValidate->getCityId(), $ConfigurationsValidate->getComplement(), json_encode($ConfigurationsValidate->getHistory(), JSON_PRETTY_PRINT)))
        {

            /** Adição de elementos na array */
            array_push($message, array('sucesso', 'Registro salvo com sucesso!'));

            /** Result **/
            $result = [

                'code' => 1,
                'title' => 'Sucesso',
                'message' => $message,
                'redirect' => 'FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID',

            ];

        } else {

            /** Adição de elementos na array */
            array_push($message, array('erro', 'Não foi possivel salvar o registro'));

            /** Result **/
            $result = [

                'code' => 0,
                'title' => 'Atenção',
                'message' => $message,

            ];

        }

    }

/** Verifico a existência de erros Email */
if (!empty($ConfigurationsEmailPreferencesValidate->getErrors())) {

    throw new InvalidArgumentException(implode("
", array_column($ConfigurationsEmailPreferencesValidate->getErrors(), 1)));

} else {

    /** Defino as prefências */
    $preferences['email']['host'] = $ConfigurationsEmailPreferencesValidate->getHost();
    $preferences['email']['username'] = $ConfigurationsEmailPreferencesValidate->getUsername();
    $preferences['email']['port'] = $ConfigurationsEmailPreferencesValidate->getPort();
    $preferences['email']['password'] = $ConfigurationsEmailPreferencesValidate->getPassword();

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

        /** Inicializo as preferências como um array vazio se estiverem vazias */
        $resultConfiguration->preferences = [];

        /** Unifico a configuração atual com a anterior */
        $resultConfiguration->preferences['email'] = $preferences;
    
    }

    /** Verifico se o usuário foi localizado */
    if ($Configurations->SavePreference($ConfigurationsValidate->getConfigurationId(), json_encode($resultConfiguration->preferences, JSON_PRETTY_PRINT)))
    {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'E-mail salvo com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID',

        ];

    } else {

        throw new InvalidArgumentException($ConfigurationsEmailPreferencesValidate->getErrors());

    }

}



    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
catch (Exception $exception)
{

    /** Controle de mensagens */
    $message = array();

    /** Adição de elementos na array */
    array_push($message, array('erro', '<span class="badge badge-primary">Detalhes.:</span> ' . 'código = ' . $exception->getCode() . ' - linha = ' . $exception->getLine() . ' - arquivo = ' . $exception->getFile()));
    array_push($message, array('erro', '<span class="badge badge-primary">Mensagem.:</span> ' . $exception->getMessage()));

    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 1,
        'message' => $message,
        'title' => 'Erro Interno',
        'type' => 'exception',

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}