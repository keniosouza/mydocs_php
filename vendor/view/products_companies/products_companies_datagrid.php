<?php
use \vendor\model\Companies;
use \vendor\controller\companies\CompaniesValidate;
use \vendor\model\ProductsCompanies;

/** Instânciamento de classes */
$companies = new Companies();
$companiesValidate = new CompaniesValidate();
$ProductsCompanies = new ProductsCompanies();

/** Parâmetros de Entrada */
$companiesValidate->setCompanyId(@(int)$_POST['COMPANY_ID']);


/** Operações */
$resultCompanies = $companies->get($companiesValidate->getCompanyId());
$ProductsCompaniesResult = $ProductsCompanies->all($resultCompanies->company_id);

?>

<a type="button" onclick="sendRequest('FOLDER=VIEW&TABLE=PRODUCTS_COMPANIES&ACTION=PRODUCTS_COMPANIES_FORM&COMPANY_ID=<?php echo @(int)$resultCompanies->company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)" class="btn btn-primary w-100 my-2">

    <i class="fas fa-plus me-1"></i>Novo

</a>

<?php

/** Verifico se existem registros */
if (count($ProductsCompaniesResult) > 0) { ?>

    <table class="table table-hover bg-white shadow-sm border" id="search_table">

        <thead>

            <tr>

                <th class="text-center">

                    #

                </th>

                <th>

                    Nome

                </th>

                <th class="text-center">

                    Operações

                </th>

            </tr>

        </thead>

        <tbody>

            <?php

            /** Consulta os usuário cadastrados*/
            foreach ($ProductsCompaniesResult as $keyResultProductCompanies => $resultProductCompanies) { ?>

                <tr class="border-top">

                    <td class="text-center">

                        <?php echo $resultProductCompanies->product_company_id; ?>

                    </td>

                    <td>

                        <?php echo $resultProductCompanies->name; ?>

                    </td>

                    <td class="text-center">

                        <button class="btn btn-danger" onclick="sendRequest('FOLDER=ACTION&TABLE=PRODUCTS_COMPANIES&ACTION=PRODUCTS_COMPANIES_DELETE&company_id=<?php echo $resultProductCompanies->company_id ?>&product_company_id=<?php echo $resultProductCompanies->product_company_id ?>', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

                            <i class="fas fa-fire-alt me-1"></i>Remover

                        </button>

                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table>

<?php } else { ?>

    <div class="alert alert-warning border-warning shadow-sm" role="alert">

        <h4 class="alert-heading">

            <strong>

                Ooops!

            </strong>

        </h4>

        <p>

            Não foram localizados registros

        </p>

    </div>

<?php } ?>