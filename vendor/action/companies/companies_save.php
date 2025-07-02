<?php

/** Importação de classes */
use vendor\model\Companies;
use vendor\controller\companies\CompaniesValidate;

/** Instânciamento de classes */
$companies = new Companies();
$companiesValidate = new CompaniesValidate();

/** Parâmetros de entrada */
$companiesValidate->setCompanyId(@(int)$_POST['company_id']);
$companiesValidate->setSituationId(@(int)$_POST['situation_id']);
$companiesValidate->setNickname(@(string)$_POST['nickname']);
$companiesValidate->setNameBusiness(@(string)$_POST['name_business']);
$companiesValidate->setNameFantasy(@(string)$_POST['name_fantasy']);
$companiesValidate->setCnpj(@(string)$_POST['cnpj']);
$companiesValidate->setCns(@(string)$_POST['cns']);
$companiesValidate->setSite(@(string)$_POST['site']);
$companiesValidate->setTelephone(@(string)$_POST['telephone']);
$companiesValidate->setCellphone(@(string)$_POST['cellphone']);
$companiesValidate->setEmail(@(string)$_POST['email']);
$companiesValidate->setPassword(@(string)$_POST['password']);
$companiesValidate->setResponsible(@(string)$_POST['responsible']);
$companiesValidate->setResponsibleOffice(@(string)$_POST['responsible_office']);
$companiesValidate->setCep(@(string)$_POST['cep']);
$companiesValidate->setStateId(@(string)$_POST['state_id']);
$companiesValidate->setCityId(@(string)$_POST['city_id']);
$companiesValidate->setDistrict(@(string)$_POST['district']);
$companiesValidate->setComplement(@(string)$_POST['complement']);
$companiesValidate->setExpirationDay(@(int)$_POST['expiration_day']);
$companiesValidate->setValueMonthly(@(string)$_POST['value_monthly']);
$companiesValidate->setStations(@(int)$_POST['stations']);
$companiesValidate->setStartContract(@(string)$_POST['start_contract']);
$companiesValidate->setFirstPayment(@(string)$_POST['first_payment']);
$companiesValidate->setHistory(@(string)$_POST['history']);
$companiesValidate->setDateRegister(date('Y-m-d'));
$companiesValidate->setDateUpdate(date('Y-m-d'));

/** Verifico a existência de erros */
if (!empty($companiesValidate->getErrors())) {

    throw new InvalidArgumentException($companiesValidate->getErrors());

} else {

    /** Verifico se o usuário foi localizado */
    if ($companies->save($companiesValidate->getCompanyId(), $companiesValidate->getSituationId(), $companiesValidate->getNickname(), $companiesValidate->getNameBusiness(), $companiesValidate->getNameFantasy(), $companiesValidate->getCnpj(), $companiesValidate->getCns(), $companiesValidate->getSite(), $companiesValidate->getTelephone(), $companiesValidate->getCellphone(), $companiesValidate->getEmail(), $companiesValidate->getPassword(), $companiesValidate->getResponsible(), $companiesValidate->getResponsibleOffice(), $companiesValidate->getCep(), $companiesValidate->getStateId(), $companiesValidate->getCityId(), $companiesValidate->getDistrict(), $companiesValidate->getComplement(), $companiesValidate->getExpirationDay(), $companiesValidate->getValueMonthly(), $companiesValidate->getStations(), $companiesValidate->getStartContract(), $companiesValidate->getFirstPayment(), $companiesValidate->getHistory(), $companiesValidate->getDateRegister(), $companiesValidate->getDateUpdate())) {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Empresa cadastrado com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DATAGRID'

        ];

    } else {

        throw new InvalidArgumentException('Não foi possivel salvar o registro');

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
