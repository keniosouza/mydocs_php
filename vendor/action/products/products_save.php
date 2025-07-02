<?php

/** Importação de classes */
use vendor\controller\main\Main;
use vendor\model\Products;
use vendor\controller\products\ProductsValidate;

/** Instânciamento de classes */
$main = new Main();
$products = new Products();
$productsValidate = new ProductsValidate();


    /** Operações */
    $main->SessionStart();

    /** Parâmetros de entrada */
    $productsValidate->setProductId(@(int)$_POST['product_id']);
    $productsValidate->setUserId(@(string)$_SESSION['USER_ID']);
    $productsValidate->setSituationId(@(string)$_POST['situation_id']);
    $productsValidate->setName(@(string)$_POST['name']);
    $productsValidate->setDescription(@(string)$_POST['description']);
    $productsValidate->setDateRegister(@(string)date('Y-m-d'));
    $productsValidate->setDateUpdate(@(string)date('Y-m-d'));

    /** Controle de mensagens */
    $message = Array();

    /** Verifico a existência de erros */
    if (!empty($productsValidate->getErrors()))
    {
        /** Preparo o formulario para retorno **/
        throw new InvalidArgumentException($productsValidate->getErrors());
    }
    else
    {
        /** Verifico se o usuário foi localizado */
        if ($products->save($productsValidate->getProductId(), $productsValidate->getUserId(), $productsValidate->getSituationId(), $productsValidate->getName(), $productsValidate->getDescription(), $productsValidate->getDateRegister(), $productsValidate->getDateUpdate()))
        {
            /** Result **/
            $result = [
                'code' => 200,
                'title' => 'Sucesso',
                'data' => 'Produto cadastrado com sucesso',
                'redirect' => 'FOLDER=VIEW&TABLE=PRODUCTS&ACTION=PRODUCTS_DATAGRID'
            ];
        }
        else
        {
            /** Caso existam erro(s), retorna os mesmos **/
            throw new InvalidArgumentException('Não foi possivel salvar o produto.');

        }

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
