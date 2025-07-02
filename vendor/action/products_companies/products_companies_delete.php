<?php

/** Importação de classes */
use vendor\model\ProductsCompanies;
use vendor\controller\products_companies\ProductsCompaniesValidate;

/** Instânciamento de classes */
$ProductsCompanies = new ProductsCompanies();
$ProductsCompaniesValidate = new ProductsCompaniesValidate();

/** Parâmetros de entrada */
$ProductsCompaniesValidate->setCompanyId(@(int)filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_SPECIAL_CHARS));
$ProductsCompaniesValidate->setProductCompanyId(@(int)filter_input(INPUT_POST, 'product_company_id', FILTER_SANITIZE_SPECIAL_CHARS));

/** Verifico a existência de erros */
if (!empty($ProductsCompaniesValidate->getErrors())) {

    /** Preparo o formulario para retorno **/
    throw new InvalidArgumentException($ProductsCompaniesValidate->getErrors());

} else {

    /** Busco o registro desejado */
    $resultProductCompany = $ProductsCompanies->Get($ProductsCompaniesValidate->getProductCompanyId());

    /** Verifico se o registro existe */
    if (@(int)$resultProductCompany->product_company_id) {

        /** Verifico se o usuário foi localizado */
        if ($ProductsCompanies->delete($ProductsCompaniesValidate->getProductCompanyId())) {

            /** Result **/
            $result = [

                'code' => 200,
                'title' => 'Sucesso',
                'data' => 'Produto cadastrado com sucesso',
                'target'=> 'products-tab-pane',
                'redirect' => 'FOLDER=VIEW&TABLE=PRODUCTS_COMPANIES&ACTION=PRODUCTS_COMPANIES_DATAGRID&COMPANY_ID='. $ProductsCompaniesValidate->getCompanyId()
                
            ];

        } else {

            /** Caso existam erro(s), retorna os mesmos **/
            throw new InvalidArgumentException('Não foi possivel remover o vínculo.');

        }

    } else {

        /** Caso existam erro(s), retorna os mesmos **/
        throw new InvalidArgumentException('Não foi possivel localizar o vínculo.');

    }

}

/** Envio **/
echo json_encode($result);

/** Paro o procedimento **/
exit;
