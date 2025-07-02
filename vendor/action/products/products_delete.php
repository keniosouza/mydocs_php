<?php

/** Importação de classes */
use vendor\model\Products;
use vendor\controller\products\ProductsValidate;

/** Instânciamento de classes */
$products = new Products();
$productsValidate = new ProductsValidate();

    /** Parâmetros de entrada */
    $productsValidate->setProductId(@(int)filter_input(INPUT_POST,'PRODUCT_ID',FILTER_SANITIZE_SPECIAL_CHARS));
    
    /** Verifico a existência de erros */
    if(!empty($productsValidate->getErrors()))
    {
        throw new InvalidArgumentException($productsValidate->getErrors());

    }
    else
    {

        /** Verifico se o usuário foi localizado */
        if ($products->delete($productsValidate->getProductId()))
        {

            /** Result **/
            $result = [
                'code' => 200,
                'title' => 'Sucesso',
                'data' => 'Produto removido com sucesso.',
                'redirect' => 'FOLDER=VIEW&TABLE=PRODUCTS&ACTION=PRODUCTS_DATAGRID'
            ];

        }
        else
        {
                /** Caso existam erro(s), retorna os mesmos **/
                throw new InvalidArgumentException('Não foi possivel remover o produto.');

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

