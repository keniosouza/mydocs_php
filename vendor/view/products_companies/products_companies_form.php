<?php

/** Importação de classes */

use \vendor\model\Products;
use \vendor\controller\companies\CompaniesValidate;

/** Instânciamento de classes */
$Products = new Products();
$CompaniesValidate = new CompaniesValidate();

/** Tratamento da informação */
$CompaniesValidate->setCompanyId(@(int)filter_input(INPUT_POST, 'COMPANY_ID', FILTER_SANITIZE_SPECIAL_CHARS));

?>

<div class="container-center mb-2">
    <div class=" row align-items-center">

        <h5 class="col card-title">

            <i class="fas fa-user"></i>

            <strong>Empresa</strong>

            <i class="fas fa-chevron-right regular"></i>Vincular Produto

        </h5>
        <div class="col text-end">
            <button type="button" class="btn btn-primary btn-sm mb-0" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DETAIL&COMPANY_ID=<?php echo @(int)$CompaniesValidate->getCompanyId() ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                <i class="fas fa-chevron-left me-1"></i>Voltar

            </button>
        </div>
    </div>
</div>

<div class="col-md-12">

    <div class="card shadow-sm animate slideIn">

        <form class="card-body" role="form" id="ProductsCompaniesForm">

            <div class="row">

                <?php

                /** Listagem de Todos os Registros */
                foreach ($Products->all() as $keyResultProducts => $resultProducts) { ?>

                    <div class="col-md-12">

                        <div class="form-group">

                            <div class="custom-control ">

                                <input type="checkbox" id="product_<?php echo $resultProducts->product_id ?>" name="product_id[]" value="<?php echo $resultProducts->product_id ?>" class="custom-control-input">
                                <label class="custom-control-label" for="product_<?php echo $resultProducts->product_id ?>">

                                    <?php echo $resultProducts->name ?>

                                </label>

                            </div>

                        </div>

                    </div>

                <?php } ?>

                <div class="col-md-12 text-end">

                    <button type="button" class="btn btn-success" onclick="sendRequest('ProductsCompaniesForm', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                        <i class="far fa-save me-2"></i>Salvar

                    </button>

                </div>

            </div>

            <input type="hidden" name="company_id" value="<?php echo @(int)$CompaniesValidate->getCompanyId() ?>" />
            <input type="hidden" name="FOLDER" value="ACTION" />
            <input type="hidden" name="TABLE" value="PRODUCTS_COMPANIES" />
            <input type="hidden" name="ACTION" value="PRODUCTS_COMPANIES_SAVE" />

        </form>

    </div>

</div>