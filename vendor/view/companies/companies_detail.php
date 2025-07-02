<?php

/** Importação de classes */
use \vendor\model\Companies;
use \vendor\controller\companies\CompaniesValidate;
use \vendor\model\DraftsCompanies;
use \vendor\model\ProductsCompanies;
use \vendor\model\CompaniesFiles;

/** Instânciamento de classes */
$companies = new Companies();
$companiesValidate = new CompaniesValidate();
$DraftsCompanies = new DraftsCompanies();
$ProductsCompanies = new ProductsCompanies();
$CompaniesFiles = new CompaniesFiles();

/** Parâmetros de Entrada */
$companiesValidate->setCompanyId(@(int)$_POST['COMPANY_ID']);

/** Operações */
$resultCompanies = $companies->get($companiesValidate->getCompanyId());
$ProductsCompaniesResult = $ProductsCompanies->all($resultCompanies->company_id);
$DraftsCompaniesResult = $DraftsCompanies->all($resultCompanies->company_id);
$CompaniesFilesResult = $CompaniesFiles->All(@(int)$resultCompanies->company_id);

?>

<div class="row align-items-start">

    <h5 class="col card-title">

        <strong>

            <i class="fas fa-building me-1"></i>

            Empresas

        </strong>

        <i class="fas fa-chevron-right regular"></i> Detalhes

    </h5>

    <div class="col text-end">

        <a type="button" class="btn btn-primary btn-sm" onclick="sendRequest('FOLDER=VIEW&TABLE=COMPANIES&ACTION=COMPANIES_DATAGRID', '', true, '', '', '', 'Aguarde...', 'blue', 'circle', 'sm', true)">

            <i class="fas fa-chevron-left me-1"></i>Voltar

        </a>

    </div>

</div>

<div class="col-md-12 animate slideIn">

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">

            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Início</button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="values-tab" data-bs-toggle="tab" data-bs-target="#values-tab-pane" type="button" role="tab" aria-controls="values-tab-pane" aria-selected="false">Mensalidade</button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#products-tab-pane" type="button" role="tab" aria-controls="products-tab-pane" aria-selected="false">Produtos</button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-tab-pane" type="button" role="tab" aria-controls="documents-tab-pane" aria-selected="false">Documentos</button>

        </li>

        <li class="nav-item" role="presentation">

            <button class="nav-link" id="files-tab" data-bs-toggle="tab" data-bs-target="#files-tab-pane" type="button" role="tab" aria-controls="files-tab-pane" aria-selected="false">Arquivos</button>

        </li>

    </ul>

    <!--Painel-->
    <div class="tab-content" id="myTabContent">

        <!--Inicio-->
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div class="card w-100 shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        #<?php echo $resultCompanies->company_id ?> - Ativo - <b><?php echo $resultCompanies->name_business ?></b>
                    </h5>
                    <div class="card-text">
                        <b>Apelido</b>: <?php echo $resultCompanies->nickname ?>
                        <br>
                        <b>Nome Fantasia</b>: <?php echo $resultCompanies->name_fantasy ?>
                        <br>
                        <b>CNS</b>: <?php echo $resultCompanies->cns ?>
                        <br>
                        <b>CNPJ</b>: <?php echo $resultCompanies->cnpj ?>
                        <br>
                        <b>Responsável</b>: <?php echo $resultCompanies->responsible ?> - <?php echo $resultCompanies->responsible_office ?>
                        <br>
                        <b>Telefones</b>: <?php echo $resultCompanies->telefone ?> - <?php echo $resultCompanies->cellfone ?>
                        <br>
                        <b>Email</b>: <?php echo $resultCompanies->email ?>
                        <br>
                        <b>Site</b>: <?php echo $resultCompanies->site ?>
                        <br>
                        <b>Endereço</b>: <?php echo $resultCompanies->complement ?>, <span class="cep"><?php echo $resultCompanies->cep ?></span>
                        <br>
                        <b>Comarca</b>: <?php echo $resultCompanies->district ?>
                    </div>

                </div>

            </div>

        </div>

        <!--Mensalidade-->
        <div class="tab-pane fade" id="values-tab-pane" role="tabpanel" aria-labelledby="values-tab" tabindex="1">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Inicio do Contrato</b>

                            </h6>

                            <h6>

                                <?php echo date('d/m/Y', strtotime(@(string)$resultCompanies->start_contract)) ?>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b> Quantidade de Estações</b>

                            </h6>

                            <h6>

                                <?php echo @(string)$resultCompanies->stations ?>

                            </h6>

                        </div>


                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Valor da Mensalidade</b>

                            </h6>

                            <h6>

                                <input class="remove-border money" name="value_monthly" focus="none" value="<?php echo @(string)$resultCompanies->value_monthly ?> " readonly>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Dia do Vencimento</b>

                            </h6>

                            <h6>

                                <?php echo @(string)$resultCompanies->expiration_day ?>

                            </h6>

                        </div>

                        <div class="col-md">

                            <h6 class="mt-0 mb-0">

                                <b>Primeiro Pagamento</b>

                            </h6>

                            <h6>
                                <?php echo date('d/m/Y', strtotime(@(string)$resultCompanies->first_payment)) ?>

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--Produtos-->
        <div class="tab-pane fade" id="products-tab-pane" role="tabpanel" aria-labelledby="products-tab" tabindex="3"></div>

        <!--Documentos-->
        <div class="tab-pane fade" id="documents-tab-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="4"></div>

        <!--Arquivos-->
        <div class="tab-pane fade" id="files-tab-pane" role="tabpanel" aria-labelledby="files-tab" tabindex="5"></div>

    </div>

    <script type="text/javascript">

        /** Carrego as mascaras */
        loadMask();

        /** Carrego o LiveSearch */
        loadLiveSearch();

        /** Envio de requisições */
        sendRequest('FOLDER=VIEW&TABLE=PRODUCTS_COMPANIES&ACTION=PRODUCTS_COMPANIES_DATAGRID&COMPANY_ID=<?php echo $companiesValidate->getCompanyId() ?>', '', true, '', '', 'products-tab-pane', 'Aguarde...', 'blue', 'circle', 'sm', true);
        sendRequest('FOLDER=VIEW&TABLE=PRODUCTS_COMPANIES&ACTION=PRODUCTS_COMPANIES_DOCUMENTS_DATAGRID&COMPANY_ID=<?php echo $companiesValidate->getCompanyId() ?>', '', true, '', '', 'documents-tab-pane', 'Aguarde...', 'blue', 'circle', 'sm', true);
        sendRequest('FOLDER=VIEW&TABLE=COMPANIES_FILES&ACTION=COMPANIES_FILES_DATAGRID&COMPANY_ID=<?php echo $companiesValidate->getCompanyId() ?>', '', true, '', '', 'files-tab-pane', 'Aguarde...', 'blue', 'circle', 'sm', true);

    </script>

</div>