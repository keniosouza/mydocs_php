<?php

/** Importação de classes */

use \vendor\model\Products;
use \vendor\controller\products\ProductsValidate;

/** Instânciamento de classes */
$products = new Products();
$productsValidate = new ProductsValidate();

/** Tratamento dos dados de entrada */
$productsValidate->setProductId(@(int)$_POST['PRODUCT_ID']);

/** Busca de registro */
$resultProduct = $products->get($productsValidate->getProductId());

?>

<div class="row">

    <div class="container-center mb-2">
        <div class="row align-items-center">
            <h5 class="col card-title">

                <strong>

                    <i class="fas fa-box me-1"></i>

                    Produtos

                </strong>

                <i class="fas fa-chevron-right regular"></i>Edição
            </h5>
            <div class="col text-end">
                <a type="button" class="btn btn-primary btn-sm mb-1" onclick="sendRequest('FOLDER=VIEW&TABLE=PRODUCTS&ACTION=PRODUCTS_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                    <i class="fas fa-chevron-left me-1"></i>Voltar

                </a>
            </div>


        </div>
    </div>

    <div class="col-md-12 animate slideIn">

        <div class="card shadow-sm">

            <form class="card-body" role="form" id="formUsers">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="name">

                                <b>Nome</b>

                            </label>

                            <input type="text" id="name" class="form-control" name="name" value="<?php echo @(string)$resultProduct->name ?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="description">

                                <b>Descrição</b>

                            </label>

                            <input type="text" id="description" class="form-control" name="description" value="<?php echo @(string)$resultProduct->description ?>">

                        </div>

                    </div>

                    <div class="col-md-12 text-end">

                        <button type="button" class="btn btn-success mt-1" onclick="sendRequest('formUsers', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                            <i class="far fa-save me-1"></i>Salvar
                        </button>

                    </div>

                </div>

                <input type="hidden" name="product_id" value="<?php echo @(int)$resultProduct->product_id ?>" />
                <input type="hidden" name="situation_id" value="1" />
                <input type="hidden" name="FOLDER" value="ACTION" />
                <input type="hidden" name="TABLE" value="PRODUCTS" />
                <input type="hidden" name="ACTION" value="PRODUCTS_SAVE" />

            </form>

        </div>

    </div>

</div>