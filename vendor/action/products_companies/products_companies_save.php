<?php

/** Importação de classes */
use vendor\model\ProductsCompanies;
use vendor\controller\products_companies\ProductsCompaniesValidate;

/** Instânciamento de classes */
$ProductsCompanies = new ProductsCompanies();
$ProductsCompaniesValidate = new ProductsCompaniesValidate();

/** Parâmetros de entrada - drafts_companies */
foreach( $_POST['product_id'] as $valor ){
$ProductsCompaniesValidate->setProductCompanyId(@(int)filter_input(INPUT_POST, 'product_company_id', FILTER_SANITIZE_SPECIAL_CHARS));
$ProductsCompaniesValidate->setCompanyId(@(int)filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_SPECIAL_CHARS));
$ProductsCompaniesValidate->setProductId($valor);


/** Verifico a existência de erros */
if (!empty($ProductsCompaniesValidate->getErrors()))
{

    /** Preparo o formulario para retorno **/
    throw new InvalidArgumentException($ProductsCompaniesValidate->getErrors());

}
else
{

    /** Defino o histórico do registro */
    $historyData = array();
    $historyData[0]['title'] = 'Cadastro';
    $historyData[0]['description'] = 'Produto Vinculado a Empresa';
    $historyData[0]['date'] = date('d-m-Y');
    $historyData[0]['time'] = date('H:i:s');
    $historyData[0]['class'] = 'badge-primary';

    /** Converto para JSON */
    $historyData = json_encode($historyData, JSON_PRETTY_PRINT);

    /** Verifico se o usuário foi localizado */
    if ($ProductsCompanies->Save($ProductsCompaniesValidate->getProductCompanyId(), $ProductsCompaniesValidate->getProductId(), $ProductsCompaniesValidate->getCompanyId(), $historyData))
    {

        /** Result **/
        $result = [

            'code' => 200,
            'title' => 'Sucesso',
            'data' => 'Produto cadastrado com sucesso',
            'redirect' => 'FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=' . $ProductsCompaniesValidate->getCompanyId()
            
        ];

    }
    else
    {

        /** Caso existam erro(s), retorna os mesmos **/
        throw new InvalidArgumentException('Não foi possivel realizar o vínculo.');

    }
}
}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;